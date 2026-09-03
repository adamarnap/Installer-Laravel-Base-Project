<?php

use App\Enums\Settings\SchedulerNotificationEnum;
use App\Enums\Settings\SchedulerStatusEnum;
use App\Enums\Settings\SchedulerTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('scheduled_tasks')) {
            Schema::create('scheduled_tasks', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('command');
                $table->enum('type', SchedulerTypeEnum::values())->default(SchedulerTypeEnum::ARTISAN->value);
                $table->string('expression')->default('* * * * *');
                $table->text('description')->nullable();
                $table->boolean('is_active')->default(true);
                $table->boolean('without_overlapping')->default(false);
                $table->boolean('run_in_background')->default(false);
                $table->enum('notification_channel', SchedulerNotificationEnum::values())->default(SchedulerNotificationEnum::NONE->value);
                $table->string('notification_recipient')->nullable();
                $table->timestamp('last_run_at')->nullable();
                $table->enum('last_status', SchedulerStatusEnum::values())->nullable();
                $table->float('last_duration_seconds')->nullable();
                $table->unsignedBigInteger('created_by')->nullable();
                $table->unsignedBigInteger('updated_by')->nullable();
                $table->unsignedBigInteger('deleted_by')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (!Schema::hasTable('scheduler_logs')) {
            Schema::create('scheduler_logs', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('scheduled_task_id')->nullable()->index();
                $table->string('task_name');
                $table->string('command');
                $table->enum('status', SchedulerStatusEnum::values())->default(SchedulerStatusEnum::SUCCESS->value);
                $table->longText('output')->nullable();
                $table->text('error_message')->nullable();
                $table->float('duration_seconds')->default(0);
                $table->timestamp('executed_at');
                $table->unsignedBigInteger('created_by')->nullable();
                $table->unsignedBigInteger('updated_by')->nullable();
                $table->unsignedBigInteger('deleted_by')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scheduler_logs');
        Schema::dropIfExists('scheduled_tasks');
    }
};
