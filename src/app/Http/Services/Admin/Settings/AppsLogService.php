<?php

namespace App\Http\Services\Admin\Settings;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class AppsLogService
{
    /**
     * Get all configured and standard log directory paths.
     *
     * @return array
     */
    protected function getLogDirectories(): array
    {
        $directories = [storage_path('logs')];
        $channels = config('logging.channels', []);

        foreach ($channels as $channel) {
            if (isset($channel['path']) && is_string($channel['path'])) {
                $dir = dirname($channel['path']);
                if (File::isDirectory($dir) && !in_array($dir, $directories, true)) {
                    $directories[] = $dir;
                }
            }
        }

        return array_values(array_filter($directories, fn ($dir) => File::isDirectory($dir)));
    }

    /**
     * Validate and sanitize the log file path across allowed directories.
     *
     * @param string $filename
     * @return string|null
     */
    protected function getSafeFilePath(string $filename): ?string
    {
        // Prevent directory traversal attacks
        if (str_contains($filename, '..') || str_contains($filename, "\0")) {
            return null;
        }

        $safeName = ltrim($filename, '/\\');
        if (!str_ends_with($safeName, '.log')) {
            return null;
        }

        foreach ($this->getLogDirectories() as $dir) {
            $fullPath = realpath($dir . DIRECTORY_SEPARATOR . $safeName);
            $realDir = realpath($dir);

            if ($fullPath && $realDir && str_starts_with($fullPath, $realDir) && File::isFile($fullPath)) {
                return $fullPath;
            }

            // Also check by simple basename if single name provided
            $basePath = realpath($dir . DIRECTORY_SEPARATOR . basename($safeName));
            if ($basePath && $realDir && str_starts_with($basePath, $realDir) && File::isFile($basePath)) {
                return $basePath;
            }
        }

        return null;
    }

    /**
     * Format bytes to human readable format.
     *
     * @param int $bytes
     * @param int $precision
     * @return string
     */
    protected function formatBytes(int $bytes, int $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    /**
     * Get all log files from storage/logs and configured log channels.
     *
     * @return Collection
     */
    public function getLogFiles(): Collection
    {
        $logFiles = collect();
        $directories = $this->getLogDirectories();

        foreach ($directories as $dir) {
            if (!File::isDirectory($dir)) {
                continue;
            }

            $files = File::allFiles($dir);

            foreach ($files as $file) {
                if ($file->getExtension() !== 'log') {
                    continue;
                }

                $logFiles->push([
                    'name' => $file->getFilename(),
                    'relative_name' => $file->getRelativePathname(),
                    'size_formatted' => $this->formatBytes($file->getSize()),
                    'size_bytes' => $file->getSize(),
                    'updated_at' => Carbon::createFromTimestamp($file->getMTime()),
                    'updated_at_formatted' => Carbon::createFromTimestamp($file->getMTime())->format('d M Y H:i:s'),
                ]);
            }
        }

        // Sort DESC by updated_at (newest first)
        return $logFiles->unique('name')->sortByDesc('updated_at')->values();
    }

    /**
     * Get DataTables collection for log files list.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLogFilesForDataTable()
    {
        $files = $this->getLogFiles();

        return DataTables::of($files)
            ->addIndexColumn()
            ->addColumn('size', fn ($row) => $row['size_formatted'])
            ->addColumn('updated_at', fn ($row) => $row['updated_at_formatted'])
            ->addColumn('aksi', function ($row) {
                $wrapperStart = '<div class="flex items-center justify-center gap-1.5">';
                $btnView = '';
                $btnDelete = '';

                $user = auth()->user();
                $canRead = !$user || $user->hasRole(\App\Enums\RoleEnum::DEVELOPER->value) || $user->hasRole(\App\Enums\RoleEnum::SUPERADMIN->value) || $user->hasRole(\App\Enums\RoleEnum::ADMIN->value) || $user->can('settings-apps-log.read');
                $canDelete = !$user || $user->hasRole(\App\Enums\RoleEnum::DEVELOPER->value) || $user->hasRole(\App\Enums\RoleEnum::SUPERADMIN->value) || $user->can('settings-apps-log.delete');

                if ($canRead) {
                    $btnView = '<a href="' . route('settings.apps-log.show', $row['name']) . '" title="Lihat isi log"
                        class="btn size-7 bg-info hover:bg-info-hover rounded text-white inline-flex items-center justify-center cursor-pointer shadow-sm">
                            <i class="iconify tabler--eye text-base"></i>
                        </a>';
                }

                if ($canDelete) {
                    $btnDelete = '<button type="button" title="Hapus file log" id="btn-delete"
                        data-id="' . e($row['name']) . '" data-url-action="' . route('settings.apps-log.destroy', $row['name']) . '"
                        class="btn size-7 bg-danger hover:bg-danger-hover rounded text-white inline-flex items-center justify-center cursor-pointer shadow-sm">
                            <i class="iconify tabler--trash text-base"></i>
                        </button>';
                }

                $wrapperBottom = '</div>';

                return $wrapperStart . $btnView . $btnDelete . $wrapperBottom;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    /**
     * Get log file details and parsed entries.
     *
     * @param string $filename
     * @param string|null $levelFilter
     * @param int $maxEntries
     * @return array
     */
    public function getLogFileDetail(string $filename, ?string $levelFilter = null, int $maxEntries = 500): array
    {
        $filePath = $this->getSafeFilePath($filename);
        if (!$filePath) {
            return [
                'found' => false,
                'file_name' => $filename,
                'file_size' => '0 B',
                'updated_at' => '-',
                'entries' => collect(),
            ];
        }

        $fileSize = File::size($filePath);
        $updatedAt = Carbon::createFromTimestamp(File::lastModified($filePath))->format('d M Y H:i:s');

        $entries = $this->parseLogFile($filePath, $levelFilter, $maxEntries);

        return [
            'found' => true,
            'file_name' => basename($filePath),
            'file_size' => $this->formatBytes($fileSize),
            'raw_size' => $fileSize,
            'updated_at' => $updatedAt,
            'entries' => $entries,
        ];
    }

    /**
     * Parse log file safely into structured entries.
     *
     * @param string $filePath
     * @param string|null $levelFilter
     * @param int $maxEntries
     * @return Collection
     */
    protected function parseLogFile(string $filePath, ?string $levelFilter = null, int $maxEntries = 500): Collection
    {
        if (!File::exists($filePath) || File::size($filePath) === 0) {
            return collect();
        }

        $fileSize = File::size($filePath);
        $maxBytesToRead = 5 * 1024 * 1024; // 5MB max read window

        $handle = fopen($filePath, 'r');
        if (!$handle) {
            return collect();
        }

        if ($fileSize > $maxBytesToRead) {
            fseek($handle, -$maxBytesToRead, SEEK_END);
            // discard partial first line
            fgets($handle);
        }

        $entries = [];
        $currentEntry = null;

        while (($line = fgets($handle)) !== false) {
            $trimmedLine = rtrim($line, "\r\n");
            // Check if line is a standard Laravel log header: [YYYY-MM-DD HH:MM:SS] env.LEVEL: message
            if (preg_match('/^\[(\d{4}-\d{2}-\d{2}[T ]\d{2}:\d{2}:\d{2}(?:\.\d+)?(?:[\+-]\d{2}:\d{2}|Z)?)\]\s+([a-zA-Z0-9_\-]+)\.([a-zA-Z]+):\s+(.*)$/', $trimmedLine, $matches)) {
                if ($currentEntry !== null) {
                    $entries[] = $currentEntry;
                }
                $currentEntry = [
                    'datetime' => $matches[1],
                    'environment' => $matches[2],
                    'level' => strtoupper($matches[3]),
                    'message' => $matches[4],
                    'stacktrace' => '',
                ];
            } elseif ($currentEntry !== null) {
                $currentEntry['stacktrace'] .= ($currentEntry['stacktrace'] === '' ? '' : "\n") . $trimmedLine;
            }
        }

        if ($currentEntry !== null) {
            $entries[] = $currentEntry;
        }

        fclose($handle);

        // Reverse to show newest entries first
        $entries = array_reverse($entries);

        $filtered = collect();
        $id = 1;

        foreach ($entries as $entry) {
            if ($levelFilter && $levelFilter !== 'ALL' && strtoupper($levelFilter) !== $entry['level']) {
                continue;
            }

            $filtered->push([
                'id' => $id++,
                'datetime' => $entry['datetime'],
                'environment' => $entry['environment'],
                'level' => $entry['level'],
                'message' => $entry['message'],
                'stacktrace' => trim($entry['stacktrace']),
            ]);

            if ($filtered->count() >= $maxEntries) {
                break;
            }
        }

        return $filtered;
    }

    /**
     * Get DataTables collection for log entries in a specific file.
     *
     * @param string $filename
     * @param array $params
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLogEntriesForDataTable(string $filename, array $params = [])
    {
        $level = $params['level'] ?? null;
        $detail = $this->getLogFileDetail($filename, $level, 500);

        return DataTables::of($detail['entries'])
            ->addIndexColumn()
            ->addColumn('level_badge', function ($row) {
                $level = strtoupper($row['level']);
                $badgeClass = match ($level) {
                    'EMERGENCY', 'ALERT', 'CRITICAL', 'ERROR' => 'bg-danger/10 text-danger border-danger/20',
                    'WARNING' => 'bg-warning/10 text-warning border-warning/20',
                    'NOTICE', 'INFO' => 'bg-info/10 text-info border-info/20',
                    'DEBUG' => 'bg-gray-100 text-gray-700 border-gray-200',
                    default => 'bg-secondary/10 text-secondary border-secondary/20',
                };

                return '<span class="inline-flex items-center py-0.5 px-2 rounded-full text-xs font-semibold border ' . $badgeClass . '">' . e($level) . '</span>';
            })
            ->addColumn('message_view', function ($row) {
                $short = e(mb_strimwidth($row['message'], 0, 140, '...'));
                $jsonLog = e(json_encode($row, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP));

                return '<div class="btn-log-detail cursor-pointer text-sm text-gray-800 hover:text-primary font-mono break-all" data-log="' . $jsonLog . '" title="Klik untuk lihat detail entri log">' . $short . '</div>';
            })
            ->addColumn('aksi', function ($row) {
                $jsonLog = e(json_encode($row, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP));

                return '<div class="flex items-center justify-center">
                    <button type="button" title="Lihat Detail Log" class="btn-log-detail btn size-7 bg-info hover:bg-info-hover rounded text-white inline-flex items-center justify-center cursor-pointer shadow-sm" data-log="' . $jsonLog . '">
                        <i class="iconify tabler--eye text-base"></i>
                    </button>
                </div>';
            })
            ->rawColumns(['level_badge', 'message_view', 'aksi'])
            ->make(true);
    }

    /**
     * Delete a log file.
     *
     * @param string $filename
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteLogFile(string $filename)
    {
        $filePath = $this->getSafeFilePath($filename);

        if (!$filePath) {
            return redirect()->back()->withErrors(['error' => 'File log tidak ditemukan atau tidak valid.']);
        }

        try {
            File::delete($filePath);
            return redirect()->route('settings.apps-log.index')->with('success', 'File log ' . basename($filename) . ' berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menghapus file log. Error: ' . $e->getMessage()]);
        }
    }
}
