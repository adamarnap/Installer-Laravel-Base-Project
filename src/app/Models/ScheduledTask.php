<?php

namespace App\Models;

use App\Enums\Settings\SchedulerNotificationEnum;
use App\Enums\Settings\SchedulerStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScheduledTask extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'scheduled_tasks';

    protected $guarded = ['id'];

    protected $casts = [
        'type' => SchedulerTypeEnum::class,
        'notification_channel' => SchedulerNotificationEnum::class,
        'last_status' => SchedulerStatusEnum::class,
        'is_active' => 'boolean',
        'without_overlapping' => 'boolean',
        'run_in_background' => 'boolean',
        'last_run_at' => 'datetime',
        'last_duration_seconds' => 'float',
    ];

    /*
     * =========================================================
     * Relationships
     * =========================================================
     */

    /**
     * Relationship to creator user.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * Relationship to scheduler logs.
     */
    public function logs(): HasMany
    {
        return $this->hasMany(SchedulerLog::class, 'scheduled_task_id', 'id');
    }

    /*
     * =========================================================
     * Accessors & Mutators
     * =========================================================
     */

    /**
     * Get human readable schedule interval.
     */
    public function getReadableIntervalAttribute(): string
    {
        $map = [
            '* * * * *' => 'Setiap Menit',
            '*/5 * * * *' => 'Setiap 5 Menit',
            '*/10 * * * *' => 'Setiap 10 Menit',
            '*/15 * * * *' => 'Setiap 15 Menit',
            '*/30 * * * *' => 'Setiap 30 Menit',
            '0 * * * *' => 'Setiap Jam (Hourly)',
            '0 0 * * *' => 'Setiap Hari Pukul 00:00 (Daily)',
            '0 1 * * *' => 'Setiap Hari Pukul 01:00',
            '0 0 * * 0' => 'Setiap Minggu (Weekly)',
            '0 0 1 * *' => 'Setiap Bulan Tanggal 1 (Monthly)',
        ];

        return $map[$this->expression] ?? 'Custom (' . $this->expression . ')';
    }
}
