<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Schema;
use App\Models\ScheduledTask;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// 1. Scheduler Heartbeat Monitor (Runs every minute)
Schedule::call(function () {
    Cache::put('scheduler_heartbeat', now()->toIso8601String(), 600);
})->everyMinute()->name('scheduler:heartbeat')->description('Scheduler Heartbeat Monitor');

// 2. Daily Maintenance Job
Schedule::command('queue:prune-failed --hours=48')->daily()->name('daily:queue-prune')->description('Prune failed queue jobs older than 48 hours');

// 3. Weekly Maintenance Job
Schedule::command('cache:clear')->weekly()->name('weekly:cache-cleanup')->description('Weekly application cache cleanup');

// 4. Register Dynamic Database Scheduled Tasks
try {
    if (Schema::hasTable('scheduled_tasks')) {
        $activeTasks = ScheduledTask::where('is_active', true)->get();

        foreach ($activeTasks as $task) {
            $event = Schedule::command($task->command);
            $event->cron($task->expression);

            if ($task->without_overlapping) {
                $event->withoutOverlapping();
            }

            if ($task->run_in_background) {
                $event->runInBackground();
            }

            if (!empty($task->name)) {
                $event->name($task->name);
            }

            if (!empty($task->description)) {
                $event->description($task->description);
            }
        }
    }
} catch (\Throwable $e) {
    // Graceful fallback during bootstrapping or migrations
}