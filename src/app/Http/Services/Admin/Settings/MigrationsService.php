<?php

namespace App\Http\Services\Admin\Settings;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class MigrationsService
{
    /**
     * Get all migrations and compare source files with database records.
     *
     * @return Collection
     */
    public function getMigrationsComparison(): Collection
    {
        // 1. Get database recorded migrations
        $dbMigrations = DB::table('migrations')->get()->keyBy('migration');

        // 2. Get migration files from database/migrations
        $migrationPath = database_path('migrations');
        $files = File::isDirectory($migrationPath) ? File::files($migrationPath) : [];

        $fileMap = collect($files)->keyBy(fn ($f) => $f->getFilenameWithoutExtension());

        // Union of all migration names from files and database
        $allMigrationNames = $fileMap->keys()->merge($dbMigrations->keys())->unique()->sort();

        $results = collect();

        foreach ($allMigrationNames as $name) {
            $file = $fileMap->get($name);
            $dbRecord = $dbMigrations->get($name);

            $isRan = $dbRecord !== null;
            $batch = $isRan ? $dbRecord->batch : null;
            $fileExists = $file !== null;

            $status = match (true) {
                $isRan && $fileExists => 'RAN',
                $isRan && !$fileExists => 'RAN_DB_ONLY',
                !$isRan && $fileExists => 'PENDING',
                default => 'UNKNOWN',
            };

            $results->push([
                'name' => $name,
                'file' => $file ? $file->getFilename() : "{$name}.php",
                'file_exists' => $fileExists,
                'batch' => $batch,
                'status' => $status,
                'is_ran' => $isRan,
                'modified_at' => $file ? Carbon::createFromTimestamp($file->getMTime())->format('d M Y H:i:s') : '-',
            ]);
        }

        return $results->values();
    }

    /**
     * Get migration statistics.
     *
     * @return array
     */
    public function getMigrationStats(): array
    {
        $comparison = $this->getMigrationsComparison();
        $total = $comparison->count();
        $ran = $comparison->where('is_ran', true)->count();
        $pending = $total - $ran;

        return [
            'total' => $total,
            'ran' => $ran,
            'pending' => $pending,
            'status' => $pending === 0 ? 'SYNCHRONIZED' : 'PENDING_MIGRATIONS',
        ];
    }

    /**
     * Get DataTables collection for migrations comparison.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMigrationsForDataTable()
    {
        $migrations = $this->getMigrationsComparison();

        return DataTables::of($migrations)
            ->addIndexColumn()
            ->addColumn('migration_name', function ($row) {
                $fileIcon = $row['file_exists'] ? '<i class="ti ti-code text-primary text-base"></i>' : '<i class="ti ti-database text-warning text-base"></i>';
                return '<div class="flex items-center gap-2">
                    ' . $fileIcon . '
                    <div>
                        <span class="font-bold text-gray-800 font-mono text-xs">' . e($row['name']) . '</span>
                        ' . (!$row['file_exists'] ? '<div class="text-[10px] text-warning font-semibold">Hanya tercatat di database (File tidak ditemukan)</div>' : '') . '
                    </div>
                </div>';
            })
            ->addColumn('batch_badge', function ($row) {
                if ($row['is_ran']) {
                    return '<span class="inline-flex items-center py-0.5 px-2.5 rounded-full text-xs font-semibold bg-primary/10 text-primary border border-primary/20">Batch ' . $row['batch'] . '</span>';
                }
                return '<span class="text-xs text-gray-400">-</span>';
            })
            ->addColumn('status_badge', function ($row) {
                if ($row['status'] === 'RAN') {
                    return '<span class="inline-flex items-center py-1 px-2.5 rounded-full text-xs font-semibold bg-success/10 text-success border border-success/20"><i class="ti ti-check mr-1"></i> Sudah Dijalankan</span>';
                }
                if ($row['status'] === 'RAN_DB_ONLY') {
                    return '<span class="inline-flex items-center py-1 px-2.5 rounded-full text-xs font-semibold bg-warning/10 text-warning border border-warning/20"><i class="ti ti-database mr-1"></i> DB Only</span>';
                }
                return '<span class="inline-flex items-center py-1 px-2.5 rounded-full text-xs font-semibold bg-danger/10 text-danger border border-danger/20 animate-pulse"><i class="ti ti-alert-triangle mr-1"></i> Belum Dijalankan</span>';
            })
            ->addColumn('aksi', function ($row) {
                if (!auth()->user()->can('settings-migrations.update')) {
                    return '<span class="text-xs text-gray-400">-</span>';
                }

                if (!$row['is_ran'] && $row['file_exists']) {
                    return '<button type="button" class="btn-run-single-migration btn bg-primary border border-primary text-white hover:bg-primary-hover py-1 px-2.5 rounded text-xs inline-flex items-center gap-1"
                        data-migration="' . e($row['name']) . '"
                        data-file="' . e($row['file']) . '"
                        data-command="php artisan migrate --path=database/migrations/' . e($row['file']) . '">
                        <i class="ti ti-player-play text-xs"></i> Jalankan Migrasi Ini
                    </button>';
                }

                return '<span class="text-xs text-gray-400"><i class="ti ti-check text-success mr-1"></i> Selesai</span>';
            })
            ->rawColumns(['migration_name', 'batch_badge', 'status_badge', 'aksi'])
            ->make(true);
    }

    /**
     * Run all pending migrations.
     *
     * @param string $password
     * @return \Illuminate\Http\RedirectResponse
     */
    public function runMigrations(string $password)
    {
        if (!Hash::check($password, auth()->user()->password)) {
            return redirect()->back()->withErrors(['error' => 'Password konfirmasi salah. Operasi dibatalkan demi keamanan.']);
        }

        try {
            Artisan::call('migrate', ['--force' => true]);
            $output = trim(Artisan::output());

            return redirect()->back()->with('success', 'Migrasi berhasil dijalankan. ' . ($output ? '(' . $output . ')' : ''));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menjalankan migrasi. Error: ' . $e->getMessage()]);
        }
    }

    /**
     * Run a single migration file.
     *
     * @param string $migrationName
     * @param string $password
     * @return \Illuminate\Http\RedirectResponse
     */
    public function runSingleMigration(string $migrationName, string $password)
    {
        if (!Hash::check($password, auth()->user()->password)) {
            return redirect()->back()->withErrors(['error' => 'Password konfirmasi salah. Operasi dibatalkan demi keamanan.']);
        }

        // Validate migration name format to prevent path traversal or arbitrary args
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $migrationName)) {
            return redirect()->back()->withErrors(['error' => 'Nama migration tidak valid.']);
        }

        $migrationFile = "database/migrations/{$migrationName}.php";
        if (!File::exists(base_path($migrationFile))) {
            return redirect()->back()->withErrors(['error' => 'File migrasi tidak ditemukan di direktori project.']);
        }

        try {
            Artisan::call('migrate', [
                '--path' => $migrationFile,
                '--force' => true,
            ]);
            $output = trim(Artisan::output());

            return redirect()->back()->with('success', "Migrasi {$migrationName} berhasil dijalankan. " . ($output ? '(' . $output . ')' : ''));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => "Gagal menjalankan migrasi {$migrationName}. Error: " . $e->getMessage()]);
        }
    }

    /**
     * Run migrate:fresh.
     *
     * @param string $password
     * @param bool $withSeed
     * @return \Illuminate\Http\RedirectResponse
     */
    public function runMigrateFresh(string $password, bool $withSeed = true)
    {
        if (!Hash::check($password, auth()->user()->password)) {
            return redirect()->back()->withErrors(['error' => 'Password konfirmasi salah. Operasi dibatalkan demi keamanan.']);
        }

        try {
            $params = ['--force' => true];
            if ($withSeed) {
                $params['--seed'] = true;
            }

            Artisan::call('migrate:fresh', $params);
            $output = trim(Artisan::output());

            return redirect()->back()->with('success', 'Database berhasil di-reset (Migrate Fresh). ' . ($output ? '(' . $output . ')' : ''));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menjalankan migrate fresh. Error: ' . $e->getMessage()]);
        }
    }
}
