<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SchedulerLog extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'scheduler_logs';

    protected $guarded = ['id'];

    protected $casts = [
        'status' => SchedulerStatusEnum::class,
        'executed_at' => 'datetime',
        'duration_seconds' => 'float',
    ];

    /*
     * =========================================================
     * Relationships
     * =========================================================
     */

    /**
     * Relationship to scheduled task.
     */
    public function scheduledTask(): BelongsTo
    {
        return $this->belongsTo(ScheduledTask::class, 'scheduled_task_id', 'id');
    }

    /**
     * Relationship to user who triggered.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
