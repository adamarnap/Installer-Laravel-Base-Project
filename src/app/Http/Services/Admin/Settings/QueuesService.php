<?php

namespace App\Http\Services\Admin\Settings;

use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Yajra\DataTables\Facades\DataTables;

class QueuesService
{
    /**
     * Get queue configuration and overview statistics.
     *
     * @return array
     */
    public function getQueueStats(): array
    {
        $driver = config('queue.default');
        $hasJobsTable = Schema::hasTable('jobs');
        $hasFailedJobsTable = Schema::hasTable('failed_jobs');

        $pendingCount = $hasJobsTable ? DB::table('jobs')->count() : 0;
        $failedCount = $hasFailedJobsTable ? DB::table('failed_jobs')->count() : 0;

        return [
            'driver' => $driver,
            'pending_count' => $pendingCount,
            'failed_count' => $failedCount,
            'has_jobs_table' => $hasJobsTable,
            'has_failed_jobs_table' => $hasFailedJobsTable,
        ];
    }

    /**
     * Get pending jobs DataTables.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPendingJobsForDataTable()
    {
        if (!Schema::hasTable('jobs')) {
            return DataTables::of(collect())->make(true);
        }

        $jobs = DB::table('jobs')->orderBy('id', 'desc');

        return DataTables::of($jobs)
            ->addIndexColumn()
            ->addColumn('job_name', function ($row) {
                $payload = json_decode($row->payload, true);
                $displayName = $payload['displayName'] ?? ($payload['job'] ?? 'Unknown Job');
                return '<div class="font-mono text-xs font-semibold text-gray-800 break-all">' . e($displayName) . '</div>';
            })
            ->addColumn('queue_badge', function ($row) {
                return '<span class="inline-flex items-center py-0.5 px-2 rounded-full text-xs font-semibold bg-primary/10 text-primary border border-primary/20">' . e($row->queue) . '</span>';
            })
            ->addColumn('attempts_badge', function ($row) {
                return '<span class="text-xs font-semibold text-gray-700">' . $row->attempts . '</span>';
            })
            ->addColumn('reserved_at_formatted', function ($row) {
                return $row->reserved_at ? Carbon::createFromTimestamp($row->reserved_at)->format('d M Y H:i:s') : '<span class="text-xs text-gray-400">Idle</span>';
            })
            ->addColumn('created_at_formatted', function ($row) {
                return Carbon::createFromTimestamp($row->created_at)->format('d M Y H:i:s');
            })
            ->rawColumns(['job_name', 'queue_badge', 'attempts_badge', 'reserved_at_formatted'])
            ->make(true);
    }

    /**
     * Get failed jobs DataTables.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFailedJobsForDataTable()
    {
        if (!Schema::hasTable('failed_jobs')) {
            return DataTables::of(collect())->make(true);
        }

        $failedJobs = DB::table('failed_jobs')->orderBy('id', 'desc');

        return DataTables::of($failedJobs)
            ->addIndexColumn()
            ->addColumn('job_name', function ($row) {
                $payload = json_decode($row->payload, true);
                $displayName = $payload['displayName'] ?? ($payload['job'] ?? 'Unknown Job');
                return '<div class="font-mono text-xs font-semibold text-gray-800 break-all">' . e($displayName) . '</div>';
            })
            ->addColumn('queue_badge', function ($row) {
                return '<span class="inline-flex items-center py-0.5 px-2 rounded-full text-xs font-semibold bg-danger/10 text-danger border border-danger/20">' . e($row->queue) . '</span>';
            })
            ->addColumn('exception_view', function ($row) {
                $firstLine = strtok($row->exception, "\n");
                $short = mb_strimwidth($firstLine ?: 'No exception message', 0, 90, '...');
                return '<button type="button" class="btn-exception-detail text-left text-xs font-mono text-danger hover:underline cursor-pointer"
                    data-id="' . $row->id . '"
                    data-uuid="' . e($row->uuid) . '"
                    data-exception="' . e($row->exception) . '"
                    data-payload="' . e($row->payload) . '">
                    ' . e($short) . '
                </button>';
            })
            ->addColumn('failed_at_formatted', function ($row) {
                return Carbon::parse($row->failed_at)->format('d M Y H:i:s');
            })
            ->addColumn('aksi', function ($row) {
                $wrapperStart = '<div class="flex items-center justify-center gap-1.5">';
                $btnRetry = '';
                $btnForget = '';

                $user = auth()->user();
                $canUpdate = !$user || $user->hasRole(\App\Enums\RoleEnum::DEVELOPER->value) || $user->hasRole(\App\Enums\RoleEnum::SUPERADMIN->value) || $user->can('settings-queues.update');
                $canDelete = !$user || $user->hasRole(\App\Enums\RoleEnum::DEVELOPER->value) || $user->hasRole(\App\Enums\RoleEnum::SUPERADMIN->value) || $user->can('settings-queues.delete');

                if ($canUpdate) {
                    $btnRetry = '<form action="' . route('settings.queues.retry', $row->id) . '" method="POST" class="inline">
                        ' . csrf_field() . '
                        <button type="submit" title="Retry Job" class="btn size-7 bg-primary hover:bg-primary-hover rounded text-white inline-flex items-center justify-center cursor-pointer shadow-sm">
                            <i class="iconify tabler--rotate-clockwise text-base"></i>
                        </button>
                    </form>';
                }

                if ($canDelete) {
                    $btnForget = '<button type="button" title="Hapus Failed Job"
                        data-id="' . $row->id . '"
                        data-url-action="' . route('settings.queues.forget', $row->id) . '"
                        class="btn-forget-job btn size-7 bg-danger hover:bg-danger-hover rounded text-white inline-flex items-center justify-center cursor-pointer shadow-sm">
                            <i class="iconify tabler--trash text-base"></i>
                        </button>';
                }

                $wrapperBottom = '</div>';

                return $wrapperStart . $btnRetry . $btnForget . $wrapperBottom;
            })
            ->rawColumns(['job_name', 'queue_badge', 'exception_view', 'aksi'])
            ->make(true);
    }

    /**
     * Retry a specific failed job.
     *
     * @param string|int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function retryJob($id)
    {
        try {
            Artisan::call('queue:retry', ['id' => [(string) $id]]);
            $output = trim(Artisan::output());

            return redirect()->back()->with('success', 'Job berhasil dicoba kembali (Retried). ' . ($output ? '(' . $output . ')' : ''));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal me-retry job. Error: ' . $e->getMessage()]);
        }
    }

    /**
     * Retry all failed jobs.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function retryAllFailedJobs()
    {
        try {
            Artisan::call('queue:retry', ['id' => ['all']]);
            $output = trim(Artisan::output());

            return redirect()->back()->with('success', 'Seluruh failed job berhasil dicoba kembali (Retry All). ' . ($output ? '(' . $output . ')' : ''));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal me-retry seluruh failed job. Error: ' . $e->getMessage()]);
        }
    }

    /**
     * Delete/Forget a specific failed job.
     *
     * @param string|int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forgetJob($id)
    {
        try {
            Artisan::call('queue:forget', ['id' => (string) $id]);
            return redirect()->back()->with('success', 'Failed job berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menghapus failed job. Error: ' . $e->getMessage()]);
        }
    }

    /**
     * Flush all failed jobs.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function flushFailedJobs()
    {
        try {
            Artisan::call('queue:flush');
            return redirect()->back()->with('success', 'Seluruh failed job berhasil dibersihkan (Flushed).');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal membersihkan failed job. Error: ' . $e->getMessage()]);
        }
    }

    /**
     * Clear all pending jobs from a queue.
     *
     * @param string|null $queue
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clearQueue(?string $queue = null)
    {
        try {
            $params = ['--force' => true];
            if ($queue) {
                $params['--queue'] = $queue;
            }

            Artisan::call('queue:clear', $params);
            $output = trim(Artisan::output());

            return redirect()->back()->with('success', 'Antrean queue berhasil dibersihkan. ' . ($output ? '(' . $output . ')' : ''));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal membersihkan antrean queue. Error: ' . $e->getMessage()]);
        }
    }
}
