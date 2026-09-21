<?php

namespace App\Traits;

use Illuminate\Support\Facades\Schema;

trait TracksUserActions
{
    protected static array $userTrackingColumns = [];

    protected static function bootTracksUserActions(): void
    {
        static::creating(function ($model) {
            if ($model->hasUserTrackingColumn('created_by')) {
                $model->created_by = auth()->id();
            }
        });

        static::updating(function ($model) {
            if ($model->hasUserTrackingColumn('updated_by')) {
                $model->updated_by = auth()->id();
            }
        });

        static::deleting(function ($model) {
            if (! $model->hasUserTrackingColumn('deleted_by')) {
                return;
            }

            $model->deleted_by = auth()->id();
            $model->saveQuietly();
        });
    }

    protected function hasUserTrackingColumn(string $column): bool
    {
        $table = $this->getTable();

        if (! array_key_exists($table, static::$userTrackingColumns)) {
            if (! Schema::hasTable($table)) {
                static::$userTrackingColumns[$table] = [
                    'created_by' => false,
                    'updated_by' => false,
                    'deleted_by' => false,
                ];

                return false;
            }

            static::$userTrackingColumns[$table] = [
                'created_by' => Schema::hasColumn($table, 'created_by'),
                'updated_by' => Schema::hasColumn($table, 'updated_by'),
                'deleted_by' => Schema::hasColumn($table, 'deleted_by'),
            ];
        }

        return static::$userTrackingColumns[$table][$column] ?? false;
    }
}