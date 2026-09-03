<?php

namespace App\Http\Services\Admin\Settings;

use App\Enums\Settings\SchedulerNotificationEnum;
use App\Enums\Settings\SchedulerStatusEnum;
use App\Enums\Settings\SchedulerTypeEnum;
use App\Models\ScheduledTask;
use App\Models\SchedulerLog;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Yajra\DataTables\Facades\DataTables;

class SchedulersService
{
    public function __construct(protected Schedule $schedule)
    {
    }

    /**
     * Parse cron expression to human readable format.
     *
     * @param string $expression
     * @return string
     */
    public function getReadableInterval(string $expression): string
    {
        $map = [
            '* * * * *' => 'Setiap Menit (Every Minute)',
            '*/5 * * * *' => 'Setiap 5 Menit (Every 5 Minutes)',
            '*/10 * * * *' => 'Setiap 10 Menit (Every 10 Minutes)',
            '*/15 * * * *' => 'Setiap 15 Menit (Every 15 Minutes)',
            '*/30 * * * *' => 'Setiap 30 Menit (Every 30 Minutes)',
            '0 * * * *' => 'Setiap Jam (Hourly)',
            '0 0 * * *' => 'Setiap Hari Pukul 00:00 (Daily at Midnight)',
            '0 1 * * *' => 'Setiap Hari Pukul 01:00 (Daily at 01:00)',
            '0 0 * * 0' => 'Setiap Minggu Pukul 00:00 (Weekly on Sunday)',
            '0 0 1 * *' => 'Setiap Bulan Tanggal 1 (Monthly)',
        ];

        return $map[$expression] ?? 'Custom: ' . $expression;
    }

    /**
     * Clean artisan command string for display and execution.
     *
     * @param string|null $rawCommand
     * @return string
     */
    protected function cleanCommand(?string $rawCommand): string
    {
        if (empty($rawCommand)) {
            return 'Callback / Closure Task';
        }

        if (preg_match("/'artisan'\s+(.+)/", $rawCommand, $matches)) {
            return trim($matches[1], "'\" ");
        }

        return $rawCommand;
    }

    /**
     * Get scheduler monitoring heartbeat status.
     *
     * @return array
     */
    public function getMonitoringStatus(): array
    {
        $heartbeat = Cache::get('scheduler_heartbeat');
        $isHealthy = false;
        $formatted = 'Belum pernah mengirim heartbeat';

        if ($heartbeat) {
            try {
                $time = Carbon::parse($heartbeat);
                $diffMinutes = $time->diffInMinutes(now());
                $isHealthy = $diffMinutes <= 5;
                $formatted = $time->format('d M Y H:i:s') . ' (' . $time->diffForHumans() . ')';
            } catch (\Throwable $e) {
                $isHealthy = false;
            }
        }

        return [
            'is_healthy' => $isHealthy,
            'status' => $isHealthy ? 'HEALTHY' : 'UNHEALTHY',
            'status_label' => $isHealthy ? 'Scheduler Berjalan Normal' : 'Scheduler Tidak Berjalan / Bermasalah',
            'last_heartbeat' => $formatted,
        ];
    }

    /**
     * Get overview statistics.
     *
     * @return array
     */
    public function getSchedulerStats(): array
    {
        $monitoring = $this->getMonitoringStatus();
        $dbTasksCount = Schema::hasTable('scheduled_tasks') ? ScheduledTask::count() : 0;
        $activeDbTasksCount = Schema::hasTable('scheduled_tasks') ? ScheduledTask::where('is_active', true)->count() : 0;
        $kernelTasksCount = count($this->schedule->events());
        $failedLogsCount = Schema::hasTable('scheduler_logs') ? SchedulerLog::where('status', SchedulerStatusEnum::FAILED->value)->count() : 0;

        return [
            'heartbeat_status' => $monitoring['is_healthy'] ? 'RUNNING' : 'STOPPED',
            'is_healthy' => $monitoring['is_healthy'],
            'status_label' => $monitoring['status_label'],
            'last_heartbeat' => $monitoring['last_heartbeat'],
            'total_tasks' => $dbTasksCount + $kernelTasksCount,
            'active_tasks' => $activeDbTasksCount + $kernelTasksCount,
            'db_tasks_count' => $dbTasksCount,
            'kernel_tasks_count' => $kernelTasksCount,
            'failed_logs_count' => $failedLogsCount,
        ];
    }

    /**
     * Get all registered scheduled tasks (both Kernel & Database).
     *
     * @return Collection
     */
    public function getScheduledTasks(): Collection
    {
        $tasks = collect();

        // 1. Kernel / Console Registered Tasks
        $events = $this->schedule->events();
        foreach ($events as $index => $event) {
            $rawCommand = $event->command;
            $cleanCmd = $this->cleanCommand($rawCommand);
            $expression = $event->expression;
            $readable = $this->getReadableInterval($expression);

            $nextRun = null;
            try {
                $nextRun = $event->nextRunDate()->format('d M Y H:i:s');
            } catch (\Throwable $e) {
                $nextRun = '-';
            }

            $name = $event->description ?: ($cleanCmd !== 'Callback / Closure Task' ? $cleanCmd : 'Anonymous Schedule Event');

            $tasks->push([
                'id' => $index,
                'source' => 'kernel',
                'db_id' => null,
                'name' => $name,
                'command' => $cleanCmd,
                'type' => $cleanCmd === 'Callback / Closure Task' ? 'closure' : 'artisan',
                'type_label' => $cleanCmd === 'Callback / Closure Task' ? 'Closure / Callback' : 'Artisan Command',
                'description' => $name,
                'expression' => $expression,
                'readable_interval' => $readable,
                'is_active' => true,
                'without_overlapping' => (bool) $event->withoutOverlapping,
                'run_in_background' => (bool) $event->runInBackground,
                'next_run' => $nextRun,
                'last_run_at' => null,
                'last_status' => null,
                'can_edit' => false,
            ]);
        }

        // 2. Database Tasks
        if (Schema::hasTable('scheduled_tasks')) {
            $dbTasks = ScheduledTask::orderBy('id', 'desc')->get();

            foreach ($dbTasks as $task) {
                $tasks->push([
                    'id' => $task->id,
                    'source' => 'db',
                    'db_id' => $task->id,
                    'name' => $task->name,
                    'command' => $task->command,
                    'type' => $task->type?->value ?? 'artisan',
                    'type_label' => $task->type?->label() ?? 'Artisan Command',
                    'description' => $task->description ?: '-',
                    'expression' => $task->expression,
                    'readable_interval' => $task->readable_interval,
                    'is_active' => (bool) $task->is_active,
                    'without_overlapping' => (bool) $task->without_overlapping,
                    'run_in_background' => (bool) $task->run_in_background,
                    'next_run' => '-',
                    'last_run_at' => $task->last_run_at ? $task->last_run_at->format('d M Y H:i:s') : '-',
                    'last_status' => $task->last_status?->value,
                    'last_duration' => $task->last_duration_seconds ? $task->last_duration_seconds . 's' : null,
                    'can_edit' => true,
                ]);
            }
        }

        return $tasks;
    }

    /**
     * Get DataTables collection for scheduled tasks.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSchedulersForDataTable()
    {
        $tasks = $this->getScheduledTasks();

        return DataTables::of($tasks)
            ->addIndexColumn()
            ->addColumn('task_name_view', function ($row) {
                $sourceBadge = $row['source'] === 'db'
                    ? '<span class="inline-flex items-center py-0.5 px-2 rounded-full text-[10px] font-bold bg-primary/10 text-primary border border-primary/20">Custom UI</span>'
                    : '<span class="inline-flex items-center py-0.5 px-2 rounded-full text-[10px] font-bold bg-gray-100 text-gray-700 border border-gray-200">System Kernel</span>';

                return '<div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <i class="ti ti-clock-cog text-primary text-base"></i>
                        <span class="font-bold text-gray-800 text-sm">' . e($row['name']) . '</span>
                        ' . $sourceBadge . '
                    </div>
                    <div class="text-xs text-gray-500 font-mono">' . e($row['command']) . '</div>
                </div>';
            })
            ->addColumn('interval_view', function ($row) {
                return '<div>
                    <span class="inline-flex items-center py-0.5 px-2 rounded-full text-xs font-mono font-semibold bg-gray-100 text-gray-800 border border-gray-200">' . e($row['expression']) . '</span>
                    <div class="text-xs text-gray-500 mt-0.5">' . e($row['readable_interval']) . '</div>
                </div>';
            })
            ->addColumn('status_badge', function ($row) {
                if (!$row['is_active']) {
                    return '<span class="px-[8px] py-[3px] inline-block bg-gray-100 dark:bg-[#15203c] text-gray-600 rounded-sm font-medium text-xs">Nonaktif</span>';
                }

                if (!empty($row['last_status'])) {
                    if ($row['last_status'] === 'SUCCESS') {
                        return '<span class="px-[8px] py-[3px] inline-block bg-success-100 dark:bg-[#15203c] text-success-600 rounded-sm font-medium text-xs">Sukses ' . ($row['last_duration'] ? "({$row['last_duration']})" : '') . '</span>';
                    }
                    return '<span class="px-[8px] py-[3px] inline-block bg-danger-100 dark:bg-[#15203c] text-danger-600 rounded-sm font-medium text-xs">Gagal</span>';
                }

                return '<span class="px-[8px] py-[3px] inline-block bg-primary-50 dark:bg-[#15203c] text-primary-500 rounded-sm font-medium text-xs">Aktif</span>';
            })
            ->addColumn('aksi', function ($row) {
                $wrapperStart = '<div class="flex items-center gap-[9px] justify-center">';
                $btnRun = '';
                $btnEdit = '';
                $btnDelete = '';

                if (auth()->user()->can('settings-schedulers.update')) {
                    $btnRun = '<button type="button" class="btn-run-task text-primary-500 leading-none custom-tooltip" id="customTooltip" data-text="Jalankan Task"
                        data-source="' . e($row['source']) . '"
                        data-id="' . e($row['id']) . '"
                        data-name="' . e($row['name']) . '"
                        data-command="' . e($row['command']) . '">
                            <i class="material-symbols-outlined !text-md">play_arrow</i>
                        </button>';
                }

                if ($row['can_edit'] && auth()->user()->can('settings-schedulers.update')) {
                    $btnEdit = '<button type="button" class="btn-edit-task text-warning-500 dark:text-warning-400 leading-none custom-tooltip" id="customTooltip" data-text="Edit Task"
                        data-id="' . e($row['db_id']) . '">
                            <i class="material-symbols-outlined !text-md">edit</i>
                        </button>';
                }

                if ($row['can_edit'] && auth()->user()->can('settings-schedulers.delete')) {
                    $btnDelete = '<button type="button" class="btn-delete-task text-danger-500 leading-none custom-tooltip" id="customTooltip" data-text="Hapus Task"
                        data-id="' . e($row['db_id']) . '"
                        data-name="' . e($row['name']) . '">
                            <i class="material-symbols-outlined !text-md">delete</i>
                        </button>';
                }

                $wrapperBottom = '</div>';

                return $wrapperStart . $btnRun . ' ' . $btnEdit . ' ' . $btnDelete . $wrapperBottom;
            })
            ->rawColumns(['task_name_view', 'interval_view', 'status_badge', 'aksi'])
            ->make(true);
    }

    /**
     * Get DataTables collection for scheduler execution history logs.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSchedulerLogsForDataTable()
    {
        if (!Schema::hasTable('scheduler_logs')) {
            return DataTables::of(collect())->make(true);
        }

        $logs = SchedulerLog::orderBy('id', 'desc');

        return DataTables::of($logs)
            ->addIndexColumn()
            ->addColumn('task_name_view', function ($row) {
                return '<div>
                    <div class="font-bold text-gray-800 text-sm">' . e($row->task_name) . '</div>
                    <div class="text-xs text-gray-500 font-mono">' . e($row->command) . '</div>
                </div>';
            })
            ->addColumn('status_badge', function ($row) {
                if ($row->status === SchedulerStatusEnum::SUCCESS) {
                    return '<span class="px-[8px] py-[3px] inline-block bg-success-100 dark:bg-[#15203c] text-success-600 rounded-sm font-medium text-xs">Sukses</span>';
                }
                return '<span class="px-[8px] py-[3px] inline-block bg-danger-100 dark:bg-[#15203c] text-danger-600 rounded-sm font-medium text-xs">Gagal</span>';
            })
            ->addColumn('duration_formatted', fn ($row) => $row->duration_seconds . ' detik')
            ->addColumn('executed_at_formatted', fn ($row) => $row->executed_at->format('d M Y H:i:s'))
            ->addColumn('aksi', function ($row) {
                return '<div class="flex items-center justify-center"><button type="button" class="btn-log-detail text-primary-500 leading-none custom-tooltip" id="customTooltip" data-text="Lihat Detail"
                    data-name="' . e($row->task_name) . '"
                    data-command="' . e($row->command) . '"
                    data-status="' . e($row->status->value) . '"
                    data-duration="' . e($row->duration_seconds) . 's"
                    data-time="' . e($row->executed_at->format('d M Y H:i:s')) . '"
                    data-output="' . e($row->output) . '"
                    data-error="' . e($row->error_message) . '">
                    <i class="material-symbols-outlined !text-md">visibility</i>
                </button></div>';
            })
            ->rawColumns(['task_name_view', 'status_badge', 'aksi'])
            ->make(true);
    }

    /**
     * Store a new custom scheduled task.
     *
     * @param array $data
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeTask(array $data)
    {
        DB::beginTransaction();
        try {
            ScheduledTask::create([
                'name' => $data['name'],
                'command' => $data['command'],
                'type' => $data['type'] ?? SchedulerTypeEnum::ARTISAN->value,
                'expression' => $data['expression'],
                'description' => $data['description'] ?? null,
                'is_active' => isset($data['is_active']) ? (bool) $data['is_active'] : true,
                'without_overlapping' => isset($data['without_overlapping']) ? (bool) $data['without_overlapping'] : false,
                'run_in_background' => isset($data['run_in_background']) ? (bool) $data['run_in_background'] : false,
                'notification_channel' => $data['notification_channel'] ?? SchedulerNotificationEnum::NONE->value,
                'notification_recipient' => $data['notification_recipient'] ?? null,
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Task scheduler baru berhasil ditambahkan.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal menambahkan task scheduler. Error: ' . $e->getMessage()]);
        }
    }

    /**
     * Get task details by ID.
     *
     * @param int $id
     * @return ScheduledTask
     */
    public function getTaskById(int $id): ScheduledTask
    {
        return ScheduledTask::findOrFail($id);
    }

    /**
     * Update an existing scheduled task.
     *
     * @param int $id
     * @param array $data
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateTask(int $id, array $data)
    {
        DB::beginTransaction();
        try {
            $task = ScheduledTask::findOrFail($id);

            $task->update([
                'name' => $data['name'],
                'command' => $data['command'],
                'type' => $data['type'] ?? $task->type,
                'expression' => $data['expression'],
                'description' => $data['description'] ?? null,
                'is_active' => isset($data['is_active']) ? (bool) $data['is_active'] : false,
                'without_overlapping' => isset($data['without_overlapping']) ? (bool) $data['without_overlapping'] : false,
                'run_in_background' => isset($data['run_in_background']) ? (bool) $data['run_in_background'] : false,
                'notification_channel' => $data['notification_channel'] ?? SchedulerNotificationEnum::NONE->value,
                'notification_recipient' => $data['notification_recipient'] ?? null,
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Task scheduler berhasil diperbarui.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal memperbarui task scheduler. Error: ' . $e->getMessage()]);
        }
    }

    /**
     * Delete a scheduled task.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteTask(int $id)
    {
        DB::beginTransaction();
        try {
            $task = ScheduledTask::findOrFail($id);
            $task->delete();

            DB::commit();

            return redirect()->back()->with('success', 'Task scheduler berhasil dihapus.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Gagal menghapus task scheduler. Error: ' . $e->getMessage()]);
        }
    }

    /**
     * Run a scheduled task immediately (kernel or db).
     *
     * @param int $identifier
     * @param string $source
     * @return \Illuminate\Http\RedirectResponse
     */
    public function runTask(int $identifier, string $source = 'kernel')
    {
        $taskName = 'Unknown Task';
        $command = '';
        $scheduledTaskId = null;
        $notificationChannel = null;
        $notificationRecipient = null;

        if ($source === 'db') {
            $dbTask = ScheduledTask::find($identifier);
            if (!$dbTask) {
                return redirect()->back()->withErrors(['error' => 'Task scheduler database tidak ditemukan.']);
            }
            $taskName = $dbTask->name;
            $command = $dbTask->command;
            $scheduledTaskId = $dbTask->id;
            $notificationChannel = $dbTask->notification_channel?->value;
            $notificationRecipient = $dbTask->notification_recipient;
        } else {
            $events = $this->schedule->events();
            $event = $events[$identifier] ?? null;
            if (!$event) {
                return redirect()->back()->withErrors(['error' => 'Task scheduler kernel tidak ditemukan.']);
            }
            $command = $this->cleanCommand($event->command);
            $taskName = $event->description ?: $command;
        }

        $startTime = microtime(true);
        $output = '';
        $errorMessage = null;
        $status = SchedulerStatusEnum::SUCCESS;

        try {
            if ($command === 'Callback / Closure Task' && isset($event)) {
                $event->run(app());
                $output = 'Closure executed successfully';
            } else {
                Artisan::call($command);
                $output = trim(Artisan::output());
            }
        } catch (\Throwable $e) {
            $status = SchedulerStatusEnum::FAILED;
            $errorMessage = $e->getMessage();
        }

        $duration = round(microtime(true) - $startTime, 3);

        // Record execution log
        try {
            if (Schema::hasTable('scheduler_logs')) {
                SchedulerLog::create([
                    'scheduled_task_id' => $scheduledTaskId,
                    'task_name' => $taskName,
                    'command' => $command,
                    'status' => $status,
                    'output' => $output,
                    'error_message' => $errorMessage,
                    'duration_seconds' => $duration,
                    'executed_at' => now(),
                ]);
            }

            if ($scheduledTaskId && $dbTask) {
                $dbTask->update([
                    'last_run_at' => now(),
                    'last_status' => $status,
                    'last_duration_seconds' => $duration,
                ]);
            }
        } catch (\Throwable $e) {
            Log::error('Failed to write scheduler execution log: ' . $e->getMessage());
        }

        // Send failure notification if applicable
        if ($status === SchedulerStatusEnum::FAILED) {
            $this->sendFailureNotification($taskName, $command, $errorMessage, $notificationChannel, $notificationRecipient);
            return redirect()->back()->withErrors(['error' => "Eksekusi task '{$taskName}' GAGAL ({$duration}s). Error: {$errorMessage}"]);
        }

        return redirect()->back()->with('success', "Task '{$taskName}' berhasil dijalankan dalam {$duration} detik. " . ($output ? "({$output})" : ''));
    }

    /**
     * Send notification on task failure safely.
     *
     * @param string $taskName
     * @param string $command
     * @param string $errorMessage
     * @param string|null $channel
     * @param string|null $recipient
     * @return void
     */
    protected function sendFailureNotification(string $taskName, string $command, string $errorMessage, ?string $channel = null, ?string $recipient = null): void
    {
        try {
            if ($channel === 'email' && !empty($recipient)) {
                Mail::raw("Pemberitahuan Kegagalan Task Scheduler:\n\nTask: {$taskName}\nCommand: {$command}\nWaktu: " . now()->format('d M Y H:i:s') . "\nError: {$errorMessage}", function ($message) use ($recipient, $taskName) {
                    $message->to($recipient)->subject("[ALERT] Kegagalan Scheduler: {$taskName}");
                });
            } elseif ($channel === 'slack' && !empty($recipient)) {
                Http::post($recipient, [
                    'text' => ":rotating_light: *Kegagalan Task Scheduler!*\n*Task:* {$taskName}\n*Command:* `{$command}`\n*Error:* ```{$errorMessage}```",
                ]);
            }
        } catch (\Throwable $e) {
            Log::warning("Failed to send scheduler failure notification: " . $e->getMessage());
        }
    }
}

