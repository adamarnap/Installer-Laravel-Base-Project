@extends('layouts.admin.master')

@section('title', 'Cache Management')

@section('breadcrumb')
    {{ Breadcrumbs::render('cache') }}
@endsection

@section('content')
    {{-- START: Cache Overview Widgets --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-[25px] mb-[25px]">
        {{-- Environment & Driver --}}
        <div class="trezo-card bg-white dark:bg-[#0c1427] p-[20px] md:p-[25px] rounded-md">
            <div class="trezo-card-content">
                <span class="block text-gray-500 text-sm">
                    Environment & Driver
                </span>
                <h5 class="!mb-0 !text-[20px] mt-[4px] font-semibold text-gray-800 dark:text-white">
                    {{ strtoupper($cacheStatus['app_env'] ?? 'N/A') }}
                </h5>
                <div class="mt-[15px] flex items-center justify-between">
                    <span class="text-xs text-gray-500">
                        Driver: <strong class="text-gray-800 dark:text-white">{{ $cacheStatus['cache_driver'] ?? 'file' }}</strong>
                    </span>
                    @if ($cacheStatus['app_debug'] ?? false)
                        <span class="px-[8px] py-[3px] inline-block bg-orange-100 dark:bg-[#15203c] text-orange-600 rounded-sm font-medium text-xs">
                            Debug Active
                        </span>
                    @else
                        <span class="px-[8px] py-[3px] inline-block bg-primary-50 dark:bg-[#15203c] text-primary-500 rounded-sm font-medium text-xs">
                            Production Mode
                        </span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Config Cache Status --}}
        <div class="trezo-card bg-white dark:bg-[#0c1427] p-[20px] md:p-[25px] rounded-md">
            <div class="trezo-card-content">
                <span class="block text-gray-500 text-sm">
                    Config Cache
                </span>
                <h5 class="!mb-0 !text-[20px] mt-[4px] font-semibold text-gray-800 dark:text-white">
                    {{ ($cacheStatus['config_cached'] ?? false) ? 'Cached' : 'Not Cached' }}
                </h5>
                <div class="mt-[15px] flex items-center justify-between">
                    <span class="text-xs text-gray-500">
                        Status Konfigurasi
                    </span>
                    @if ($cacheStatus['config_cached'] ?? false)
                        <span class="px-[8px] py-[3px] inline-block bg-success-100 dark:bg-[#15203c] text-success-600 rounded-sm font-medium text-xs">
                            Optimal
                        </span>
                    @else
                        <span class="px-[8px] py-[3px] inline-block bg-orange-100 dark:bg-[#15203c] text-orange-600 rounded-sm font-medium text-xs">
                            Standar
                        </span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Route Cache Status --}}
        <div class="trezo-card bg-white dark:bg-[#0c1427] p-[20px] md:p-[25px] rounded-md">
            <div class="trezo-card-content">
                <span class="block text-gray-500 text-sm">
                    Route Cache
                </span>
                <h5 class="!mb-0 !text-[20px] mt-[4px] font-semibold text-gray-800 dark:text-white">
                    {{ ($cacheStatus['routes_cached'] ?? false) ? 'Cached' : 'Not Cached' }}
                </h5>
                <div class="mt-[15px] flex items-center justify-between">
                    <span class="text-xs text-gray-500">
                        Status Rute
                    </span>
                    @if ($cacheStatus['routes_cached'] ?? false)
                        <span class="px-[8px] py-[3px] inline-block bg-success-100 dark:bg-[#15203c] text-success-600 rounded-sm font-medium text-xs">
                            Optimal
                        </span>
                    @else
                        <span class="px-[8px] py-[3px] inline-block bg-orange-100 dark:bg-[#15203c] text-orange-600 rounded-sm font-medium text-xs">
                            Standar
                        </span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Compiled Views Count --}}
        <div class="trezo-card bg-white dark:bg-[#0c1427] p-[20px] md:p-[25px] rounded-md">
            <div class="trezo-card-content">
                <span class="block text-gray-500 text-sm">
                    Compiled Views
                </span>
                <h5 class="!mb-0 !text-[20px] mt-[4px] font-semibold text-gray-800 dark:text-white">
                    {{ $cacheStatus['view_files_count'] ?? 0 }} File
                </h5>
                <div class="mt-[15px] flex items-center justify-between">
                    <span class="text-xs text-gray-500">
                        Events: {{ ($cacheStatus['events_cached'] ?? false) ? 'Cached' : 'Not Cached' }}
                    </span>
                    <span class="px-[8px] py-[3px] inline-block bg-primary-50 dark:bg-[#15203c] text-primary-500 rounded-sm font-medium text-xs">
                        Blade Framework
                    </span>
                </div>
            </div>
        </div>
    </div>
    {{-- END: Cache Overview Widgets --}}

    {{-- START: Cache Actions Management --}}
    <div class="trezo-card bg-white dark:bg-[#0c1427] mb-[25px] p-[20px] md:p-[25px] rounded-md">
        <div class="trezo-card-header mb-[20px] md:mb-[25px] flex items-center justify-between">
            <div class="trezo-card-title">
                <h5 class="mb-0">
                    Operasi Manajemen Cache
                </h5>
            </div>
            <div class="trezo-card-subtitle">
                <span class="text-sm text-gray-500">
                    Artisan Cache Controls
                </span>
            </div>
        </div>

        <div class="trezo-card-content">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-[20px]">
                {{-- 1. Configuration Cache --}}
                <div class="border border-gray-200 dark:border-[#172036] rounded-md p-[20px] flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-[10px]">
                            <h6 class="font-semibold text-base mb-0">Cache Konfigurasi</h6>
                            <span class="px-[8px] py-[3px] rounded-sm text-xs font-mono {{ ($cacheStatus['config_cached'] ?? false) ? 'bg-success-100 text-success-600' : 'bg-gray-100 text-gray-600' }}">
                                {{ ($cacheStatus['config_cached'] ?? false) ? 'Cached' : 'Not Cached' }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-500 mb-[10px]">
                            Menggabungkan semua file konfigurasi ke dalam satu file tunggal untuk mempercepat bootstrap aplikasi.
                        </p>
                        <div class="p-2 bg-gray-50 dark:bg-[#15203c] rounded text-xs font-mono text-gray-600 dark:text-gray-400 mb-[15px]">
                            Perintah: <code class="text-primary-500 font-semibold">php artisan config:cache</code> / <code class="text-orange-600 font-semibold">config:clear</code>
                        </div>
                    </div>
                    @can('settings-cache.update')
                        <div class="flex items-center gap-[10px] pt-[15px] border-t border-gray-100 dark:border-[#172036]">
                            <button type="button" class="btn-cache-action w-1/2 py-[8px] md:py-[10px] px-[12px] md:px-[16px] bg-primary-500 text-white text-xs md:text-sm font-medium rounded-md border border-primary-500 hover:bg-primary-400 hover:border-primary-400 transition-all inline-flex items-center justify-center gap-1.5"
                                data-action="config_cache"
                                data-command="php artisan config:cache"
                                data-title="Buat Cache Konfigurasi"
                                data-desc="Aplikasi akan mengompilasi semua file konfigurasi ke dalam cache tunggal untuk performa tinggi.">
                                <i class="material-symbols-outlined !text-base">bolt</i>
                                <span>Cache Config</span>
                            </button>
                            <button type="button" class="btn-cache-action w-1/2 py-[8px] md:py-[10px] px-[12px] md:px-[16px] bg-gray-100 dark:bg-[#15203c] text-gray-700 dark:text-gray-300 text-xs md:text-sm font-medium rounded-md border border-gray-200 dark:border-[#172036] hover:bg-gray-200 transition-all inline-flex items-center justify-center gap-1.5"
                                data-action="config_clear"
                                data-command="php artisan config:clear"
                                data-title="Bersihkan Cache Konfigurasi"
                                data-desc="Aplikasi akan menghapus cache file konfigurasi dan membaca ulang file .env secara langsung.">
                                <i class="material-symbols-outlined !text-base">delete_sweep</i>
                                <span>Clear Config</span>
                            </button>
                        </div>
                    @endcan
                </div>

                {{-- 2. Route Cache --}}
                <div class="border border-gray-200 dark:border-[#172036] rounded-md p-[20px] flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-[10px]">
                            <h6 class="font-semibold text-base mb-0">Cache Rute</h6>
                            <span class="px-[8px] py-[3px] rounded-sm text-xs font-mono {{ ($cacheStatus['routes_cached'] ?? false) ? 'bg-success-100 text-success-600' : 'bg-gray-100 text-gray-600' }}">
                                {{ ($cacheStatus['routes_cached'] ?? false) ? 'Cached' : 'Not Cached' }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-500 mb-[10px]">
                            Melakukan kompilasi seluruh registrasi rute controller untuk meningkatkan performa routing HTTP.
                        </p>
                        <div class="p-2 bg-gray-50 dark:bg-[#15203c] rounded text-xs font-mono text-gray-600 dark:text-gray-400 mb-[15px]">
                            Perintah: <code class="text-primary-500 font-semibold">php artisan route:cache</code> / <code class="text-orange-600 font-semibold">route:clear</code>
                        </div>
                    </div>
                    @can('settings-cache.update')
                        <div class="flex items-center gap-[10px] pt-[15px] border-t border-gray-100 dark:border-[#172036]">
                            <button type="button" class="btn-cache-action w-1/2 py-[8px] md:py-[10px] px-[12px] md:px-[16px] bg-primary-500 text-white text-xs md:text-sm font-medium rounded-md border border-primary-500 hover:bg-primary-400 hover:border-primary-400 transition-all inline-flex items-center justify-center gap-1.5"
                                data-action="route_cache"
                                data-command="php artisan route:cache"
                                data-title="Buat Cache Rute"
                                data-desc="Aplikasi akan mengompilasi seluruh rute HTTP untuk mempercepat proses matching request.">
                                <i class="material-symbols-outlined !text-base">alt_route</i>
                                <span>Cache Route</span>
                            </button>
                            <button type="button" class="btn-cache-action w-1/2 py-[8px] md:py-[10px] px-[12px] md:px-[16px] bg-gray-100 dark:bg-[#15203c] text-gray-700 dark:text-gray-300 text-xs md:text-sm font-medium rounded-md border border-gray-200 dark:border-[#172036] hover:bg-gray-200 transition-all inline-flex items-center justify-center gap-1.5"
                                data-action="route_clear"
                                data-command="php artisan route:clear"
                                data-title="Bersihkan Cache Rute"
                                data-desc="Aplikasi akan menghapus cache registrasi rute dan mendaftarkannya ulang secara dinamis.">
                                <i class="material-symbols-outlined !text-base">delete_sweep</i>
                                <span>Clear Route</span>
                            </button>
                        </div>
                    @endcan
                </div>

                {{-- 3. Blade Views Cache --}}
                <div class="border border-gray-200 dark:border-[#172036] rounded-md p-[20px] flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-[10px]">
                            <h6 class="font-semibold text-base mb-0">Cache View Blade</h6>
                            <span class="px-[8px] py-[3px] rounded-sm text-xs font-mono bg-gray-100 text-gray-600">
                                {{ $cacheStatus['view_files_count'] ?? 0 }} files
                            </span>
                        </div>
                        <p class="text-sm text-gray-500 mb-[10px]">
                            Melakukan pre-kompilasi semua template Blade view aplikasi atau membersihkan view terkompilasi.
                        </p>
                        <div class="p-2 bg-gray-50 dark:bg-[#15203c] rounded text-xs font-mono text-gray-600 dark:text-gray-400 mb-[15px]">
                            Perintah: <code class="text-primary-500 font-semibold">php artisan view:cache</code> / <code class="text-orange-600 font-semibold">view:clear</code>
                        </div>
                    </div>
                    @can('settings-cache.update')
                        <div class="flex items-center gap-[10px] pt-[15px] border-t border-gray-100 dark:border-[#172036]">
                            <button type="button" class="btn-cache-action w-1/2 py-[8px] md:py-[10px] px-[12px] md:px-[16px] bg-primary-500 text-white text-xs md:text-sm font-medium rounded-md border border-primary-500 hover:bg-primary-400 hover:border-primary-400 transition-all inline-flex items-center justify-center gap-1.5"
                                data-action="view_cache"
                                data-command="php artisan view:cache"
                                data-title="Pre-kompilasi View Blade"
                                data-desc="Semua template Blade view aplikasi akan dikompilasi sebelumnya untuk mempercepat rendering laman.">
                                <i class="material-symbols-outlined !text-base">preview</i>
                                <span>Cache View</span>
                            </button>
                            <button type="button" class="btn-cache-action w-1/2 py-[8px] md:py-[10px] px-[12px] md:px-[16px] bg-gray-100 dark:bg-[#15203c] text-gray-700 dark:text-gray-300 text-xs md:text-sm font-medium rounded-md border border-gray-200 dark:border-[#172036] hover:bg-gray-200 transition-all inline-flex items-center justify-center gap-1.5"
                                data-action="view_clear"
                                data-command="php artisan view:clear"
                                data-title="Bersihkan Cache View Blade"
                                data-desc="File cache view blade terkompilasi akan dibersihkan dan di-generate ulang saat diakses.">
                                <i class="material-symbols-outlined !text-base">delete_sweep</i>
                                <span>Clear View</span>
                            </button>
                        </div>
                    @endcan
                </div>

                {{-- 4. Event Cache --}}
                <div class="border border-gray-200 dark:border-[#172036] rounded-md p-[20px] flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-[10px]">
                            <h6 class="font-semibold text-base mb-0">Cache Event & Listener</h6>
                            <span class="px-[8px] py-[3px] rounded-sm text-xs font-mono {{ ($cacheStatus['events_cached'] ?? false) ? 'bg-success-100 text-success-600' : 'bg-gray-100 text-gray-600' }}">
                                {{ ($cacheStatus['events_cached'] ?? false) ? 'Cached' : 'Not Cached' }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-500 mb-[10px]">
                            Melakukan manifest discovery caching untuk event dan listener di aplikasi.
                        </p>
                        <div class="p-2 bg-gray-50 dark:bg-[#15203c] rounded text-xs font-mono text-gray-600 dark:text-gray-400 mb-[15px]">
                            Perintah: <code class="text-primary-500 font-semibold">php artisan event:cache</code> / <code class="text-orange-600 font-semibold">event:clear</code>
                        </div>
                    </div>
                    @can('settings-cache.update')
                        <div class="flex items-center gap-[10px] pt-[15px] border-t border-gray-100 dark:border-[#172036]">
                            <button type="button" class="btn-cache-action w-1/2 py-[8px] md:py-[10px] px-[12px] md:px-[16px] bg-primary-500 text-white text-xs md:text-sm font-medium rounded-md border border-primary-500 hover:bg-primary-400 hover:border-primary-400 transition-all inline-flex items-center justify-center gap-1.5"
                                data-action="event_cache"
                                data-command="php artisan event:cache"
                                data-title="Buat Cache Event & Listener"
                                data-desc="Aplikasi akan memindai dan meng-cache penemuan event serta event listeners otomatis.">
                                <i class="material-symbols-outlined !text-base">event</i>
                                <span>Cache Event</span>
                            </button>
                            <button type="button" class="btn-cache-action w-1/2 py-[8px] md:py-[10px] px-[12px] md:px-[16px] bg-gray-100 dark:bg-[#15203c] text-gray-700 dark:text-gray-300 text-xs md:text-sm font-medium rounded-md border border-gray-200 dark:border-[#172036] hover:bg-gray-200 transition-all inline-flex items-center justify-center gap-1.5"
                                data-action="event_clear"
                                data-command="php artisan event:clear"
                                data-title="Bersihkan Cache Event"
                                data-desc="Aplikasi akan menghapus cache discovery event dan listener.">
                                <i class="material-symbols-outlined !text-base">delete_sweep</i>
                                <span>Clear Event</span>
                            </button>
                        </div>
                    @endcan
                </div>

                {{-- 5. Application Data Cache --}}
                <div class="border border-gray-200 dark:border-[#172036] rounded-md p-[20px] flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-[10px]">
                            <h6 class="font-semibold text-base mb-0">Application Data Cache</h6>
                            <span class="px-[8px] py-[3px] rounded-sm text-xs font-mono bg-primary-50 text-primary-500">
                                {{ $cacheStatus['cache_driver'] ?? 'file' }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-500 mb-[10px]">
                            Membersihkan seluruh item cache data aplikasi yang disimpan pada cache store backend.
                        </p>
                        <div class="p-2 bg-gray-50 dark:bg-[#15203c] rounded text-xs font-mono text-gray-600 dark:text-gray-400 mb-[15px]">
                            Perintah: <code class="text-danger-600 font-semibold">php artisan cache:clear</code>
                        </div>
                    </div>
                    @can('settings-cache.update')
                        <div class="pt-[15px] border-t border-gray-100 dark:border-[#172036]">
                            <button type="button" class="btn-cache-action w-full py-[8px] md:py-[10px] px-[12px] md:px-[16px] bg-orange-100 text-orange-600 hover:bg-orange-200 text-xs md:text-sm font-medium rounded-md border border-orange-200 transition-all inline-flex items-center justify-center gap-1.5"
                                data-action="cache_clear"
                                data-command="php artisan cache:clear"
                                data-title="Kosongkan Application Data Cache"
                                data-desc="Seluruh kunci dan data cache yang tersimpan di driver backend akan dihapus secara menyeluruh.">
                                <i class="material-symbols-outlined !text-base">cleaning_services</i>
                                <span>Flush Data Cache</span>
                            </button>
                        </div>
                    @endcan
                </div>

                {{-- 6. Full Optimization Commands --}}
                <div class="border border-gray-200 dark:border-[#172036] rounded-md p-[20px] flex flex-col justify-between bg-primary-50/20 dark:bg-[#15203c]/20">
                    <div>
                        <div class="flex items-center justify-between mb-[10px]">
                            <h6 class="font-semibold text-base mb-0">Full Framework Optimize</h6>
                            <span class="px-[8px] py-[3px] rounded-sm text-xs font-mono bg-primary-500 text-white">
                                All-in-One
                            </span>
                        </div>
                        <p class="text-sm text-gray-500 mb-[10px]">
                            Jalankan optimasi penuh (config + route + view) untuk performa maksimal production, atau bersihkan semuanya.
                        </p>
                        <div class="p-2 bg-gray-50 dark:bg-[#15203c] rounded text-xs font-mono text-gray-600 dark:text-gray-400 mb-[15px]">
                            Perintah: <code class="text-primary-500 font-semibold">php artisan optimize</code> / <code class="text-danger-600 font-semibold">optimize:clear</code>
                        </div>
                    </div>
                    @can('settings-cache.update')
                        <div class="flex items-center gap-[10px] pt-[15px] border-t border-gray-100 dark:border-[#172036]">
                            <button type="button" class="btn-cache-action w-1/2 py-[8px] md:py-[10px] px-[12px] md:px-[16px] bg-primary-500 text-white text-xs md:text-sm font-medium rounded-md border border-primary-500 hover:bg-primary-400 hover:border-primary-400 transition-all inline-flex items-center justify-center gap-1.5"
                                data-action="optimize"
                                data-command="php artisan optimize"
                                data-title="Jalankan Full Framework Optimization"
                                data-desc="Aplikasi akan mengompilasi config, routes, dan view sekaligus untuk performa production terbaik.">
                                <i class="material-symbols-outlined !text-base">rocket_launch</i>
                                <span>Optimize All</span>
                            </button>
                            <button type="button" class="btn-cache-action w-1/2 py-[8px] md:py-[10px] px-[12px] md:px-[16px] bg-danger-500 text-white text-xs md:text-sm font-medium rounded-md border border-danger-500 hover:bg-danger-400 hover:border-danger-400 transition-all inline-flex items-center justify-center gap-1.5"
                                data-action="optimize_clear"
                                data-command="php artisan optimize:clear"
                                data-title="Bersihkan Seluruh Cache Optimasi"
                                data-desc="Seluruh cache optimasi (config, route, view, cache, event) akan dibersihkan seketika.">
                                <i class="material-symbols-outlined !text-base">delete_forever</i>
                                <span>Clear All</span>
                            </button>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    {{-- END: Cache Actions Management --}}

    {{-- Form for submitting cache actions --}}
    <form id="form-cache-execute" action="{{ route('settings.cache.execute') }}" method="POST" class="hidden">
        @csrf
        <input type="hidden" name="action" id="cache-action-input" value="">
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.btn-cache-action').on('click', function(e) {
                e.preventDefault();
                var action = $(this).data('action');
                var command = $(this).data('command');
                var title = $(this).data('title');
                var desc = $(this).data('desc');

                Swal.fire({
                    title: title,
                    html: `
                        <div class="text-left text-xs space-y-2 leading-relaxed">
                            <p class="text-gray-600 dark:text-gray-300">${desc}</p>
                            <div class="p-2.5 bg-gray-100 dark:bg-gray-800 rounded font-mono text-xs text-primary-600 dark:text-primary-400">
                                <strong>Perintah yang dijalankan:</strong><br>
                                <code>${command}</code>
                            </div>
                        </div>
                    `,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#605DFF',
                    cancelButtonColor: '#919191',
                    confirmButtonText: 'Ya, Jalankan Perintah!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#cache-action-input').val(action);
                        $('#form-cache-execute').submit();
                    }
                });
            });
        });
    </script>
@endpush
