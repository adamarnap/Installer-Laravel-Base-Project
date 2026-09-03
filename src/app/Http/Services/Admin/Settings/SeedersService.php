<?php

namespace App\Http\Services\Admin\Settings;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class SeedersService
{
    /**
     * Get all available seeders from database/seeders directory.
     *
     * @return Collection
     */
    public function getAvailableSeeders(): Collection
    {
        $seedersPath = database_path('seeders');
        if (!File::isDirectory($seedersPath)) {
            return collect();
        }

        $files = File::files($seedersPath);
        $seeders = collect();

        foreach ($files as $file) {
            $className = $file->getFilenameWithoutExtension();
            $extension = $file->getExtension();

            if ($extension !== 'php') {
                continue;
            }

            // Descriptions for known seeders
            $description = match ($className) {
                'DatabaseSeeder' => 'Main Seeder (menjalankan seluruh sequence seeder utama aplikasi)',
                'NavigationSeeder' => 'Data menu navigasi admin dan landing page',
                'PreferenceSeeder' => 'Data konfigurasi preferensi dan pengaturan sistem',
                'UserSeeder' => 'Data akun pengguna awal, role, dan hak akses permissions',
                default => 'Custom Seeder aplikasi',
            };

            $seeders->push([
                'class' => $className,
                'full_class' => "Database\\Seeders\\{$className}",
                'file' => $file->getFilename(),
                'description' => $description,
                'modified_at' => Carbon::createFromTimestamp($file->getMTime())->format('d M Y H:i:s'),
            ]);
        }

        return $seeders->sortBy('class')->values();
    }

    /**
     * Get DataTables collection for seeders list.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSeedersForDataTable()
    {
        $seeders = $this->getAvailableSeeders();

        return DataTables::of($seeders)
            ->addIndexColumn()
            ->addColumn('class_name', function ($row) {
                return '<div class="flex items-center gap-2">
                    <i class="iconify tabler--database-import text-primary text-base"></i>
                    <div>
                        <span class="font-bold text-gray-800 font-mono text-sm">' . e($row['class']) . '</span>
                        <div class="text-xs text-gray-400 font-mono">' . e($row['file']) . '</div>
                    </div>
                </div>';
            })
            ->addColumn('aksi', function ($row) {
                if (!auth()->user()->can('settings-seeders.update')) {
                    return '<span class="text-xs text-gray-400">Tidak ada akses</span>';
                }

                return '<button type="button" class="btn-run-seeder btn bg-primary border border-primary text-white hover:bg-primary-hover py-1.5 px-3 rounded text-xs inline-flex items-center gap-1.5 shadow-sm"
                    data-class="' . e($row['class']) . '"
                    data-name="' . e($row['class']) . '">
                    <i class="iconify tabler--player-play text-sm"></i> Jalankan Seeder
                </button>';
            })
            ->rawColumns(['class_name', 'aksi'])
            ->make(true);
    }

    /**
     * Run a specific seeder class safely after verifying password and class validity.
     *
     * @param string $seederClass
     * @param string $password
     * @return \Illuminate\Http\RedirectResponse
     */
    public function runSeeder(string $seederClass, string $password)
    {
        // 1. Password verification
        if (!Hash::check($password, auth()->user()->password)) {
            return redirect()->back()->withErrors(['error' => 'Password konfirmasi salah. Eksekusi seeder dibatalkan.']);
        }

        // 2. Class resolution & verification
        $targetClass = null;

        // Clean input
        $cleanClass = trim($seederClass, '\\ ');

        if (class_exists($cleanClass) && is_subclass_of($cleanClass, \Illuminate\Database\Seeder::class)) {
            $targetClass = $cleanClass;
        } elseif (class_exists("Database\\Seeders\\{$cleanClass}") && is_subclass_of("Database\\Seeders\\{$cleanClass}", \Illuminate\Database\Seeder::class)) {
            $targetClass = "Database\\Seeders\\{$cleanClass}";
        }

        if (!$targetClass) {
            return redirect()->back()->withErrors(['error' => "Class seeder '{$seederClass}' tidak valid atau bukan turunan dari Illuminate\\Database\\Seeder."]);
        }

        try {
            Artisan::call('db:seed', [
                '--class' => $targetClass,
                '--force' => true,
            ]);

            $output = trim(Artisan::output());

            return redirect()->back()->with('success', "Seeder '{$targetClass}' berhasil dijalankan. " . ($output ? '(' . $output . ')' : ''));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => "Gagal menjalankan seeder '{$targetClass}'. Error: " . $e->getMessage()]);
        }
    }
}
