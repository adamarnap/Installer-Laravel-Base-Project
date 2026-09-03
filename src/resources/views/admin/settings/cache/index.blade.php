@extends('layouts.admin.master')

@section('title', 'Cache Management')

@section('breadcrumb')
    {{ Breadcrumbs::render('cache') }}
@endsection

@section('content')
<div class="space-y-6">
    <!-- START: Environment & Summary Info -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white p-4 flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-primary-50 text-primary flex items-center justify-center text-2xl">
                <i class="ti ti-server"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium">Environment</p>
                <h4 class="text-base font-bold text-gray-800 uppercase">{{ $cacheStatus['app_env'] }}</h4>
                <span class="text-xs text-gray-400">Debug: {{ $cacheStatus['app_debug'] ? 'True' : 'False' }}</span>
            </div>
        </div>

        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white p-4 flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-success/10 text-success flex items-center justify-center text-2xl">
                <i class="ti ti-database"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium">Cache Driver</p>
                <h4 class="text-base font-bold text-gray-800 uppercase">{{ $cacheStatus['cache_driver'] }}</h4>
                <span class="text-xs text-gray-400">Default Cache Store</span>
            </div>
        </div>

        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white p-4 flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-info/10 text-info flex items-center justify-center text-2xl">
                <i class="ti ti-files"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium">Compiled Views</p>
                <h4 class="text-base font-bold text-gray-800">{{ $cacheStatus['view_files_count'] }} File</h4>
                <span class="text-xs text-gray-400">Blade Templates</span>
            </div>
        </div>
    </div>
    <!-- END: Environment & Summary Info -->

    <!-- START: Quick Actions Banner -->
    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white">
        <div class="card-header border-b border-borderColor p-4 flex items-center justify-between flex-wrap gap-3">
            <div>
                <h5 class="card-title text-base font-bold text-gray-800">Operasi Cache & Optimasi Aplikasi</h5>
                <p class="text-xs text-gray-500 mt-0.5">Kelola seluruh komponen cache framework dan aplikasi untuk menjaga performa optimal.</p>
            </div>
            <div class="flex items-center gap-2">
                <button type="button" class="btn bg-primary border border-primary text-white text-center hover:bg-primary-hover hover:text-white inline-flex items-center gap-1.5 py-2 px-4 rounded text-sm"
                    data-modal-toggle="modalCacheExecute" data-modal-target="modalCacheExecute">
                    <i class="ti ti-settings-cog text-base"></i> Jalankan Aksi Cache
                </button>
            </div>
        </div>
    </div>
    <!-- END: Quick Actions Banner -->

    <!-- START: Cache Management Items -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Config Cache -->
        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white flex flex-col justify-between">
            <div class="card-header border-b border-borderColor p-4 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <i class="ti ti-settings text-xl text-primary"></i>
                    <h5 class="card-title font-semibold text-gray-800">Configuration Cache</h5>
                </div>
                @if($cacheStatus['config_cached'])
                    <span class="inline-flex items-center py-1 px-2.5 rounded-full text-xs font-semibold bg-success/10 text-success border border-success/20">
                        <i class="ti ti-check mr-1"></i> Cached
                    </span>
                @else
                    <span class="inline-flex items-center py-1 px-2.5 rounded-full text-xs font-semibold bg-warning/10 text-warning border border-warning/20">
                        <i class="ti ti-alert-circle mr-1"></i> Not Cached
                    </span>
                @endif
            </div>
            <div class="p-4 flex-grow space-y-2">
                <p class="text-xs text-gray-600 leading-relaxed">
                    Menggabungkan seluruh file konfigurasi Laravel ke dalam satu file tunggal untuk mempercepat bootstrap aplikasi.
                </p>
                <div class="text-[11px] font-mono text-gray-500 bg-gray-50 p-2 rounded border border-gray-100 space-y-1">
                    <div><span class="text-gray-400">Cache:</span> <code class="text-primary font-bold">php artisan config:cache</code></div>
                    <div><span class="text-gray-400">Clear:</span> <code class="text-danger font-bold">php artisan config:clear</code></div>
                </div>
            </div>
            <div class="card-footer border-t border-borderColor p-4 bg-gray-50 flex items-center justify-between gap-2">
                <button type="button" class="btn-cache-action w-1/2 btn bg-primary border border-primary text-white text-center hover:bg-primary-hover hover:text-white py-1.5 px-3 rounded text-xs flex items-center justify-center gap-1"
                    data-action="config_cache"
                    data-title="Cache Configuration"
                    data-command="php artisan config:cache"
                    data-desc="Membuat cache seluruh konfigurasi aplikasi.">
                    <i class="ti ti-cpu"></i> Cache Config
                </button>
                <button type="button" class="btn-cache-action w-1/2 btn bg-white border border-borderColor text-gray-700 text-center hover:bg-gray-100 py-1.5 px-3 rounded text-xs flex items-center justify-center gap-1"
                    data-action="config_clear"
                    data-title="Clear Configuration Cache"
                    data-command="php artisan config:clear"
                    data-desc="Menghapus cache konfigurasi aplikasi.">
                    <i class="ti ti-trash"></i> Clear Config
                </button>
            </div>
        </div>

        <!-- Route Cache -->
        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white flex flex-col justify-between">
            <div class="card-header border-b border-borderColor p-4 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <i class="ti ti-route text-xl text-primary"></i>
                    <h5 class="card-title font-semibold text-gray-800">Route Cache</h5>
                </div>
                @if($cacheStatus['routes_cached'])
                    <span class="inline-flex items-center py-1 px-2.5 rounded-full text-xs font-semibold bg-success/10 text-success border border-success/20">
                        <i class="ti ti-check mr-1"></i> Cached
                    </span>
                @else
                    <span class="inline-flex items-center py-1 px-2.5 rounded-full text-xs font-semibold bg-warning/10 text-warning border border-warning/20">
                        <i class="ti ti-alert-circle mr-1"></i> Not Cached
                    </span>
                @endif
            </div>
            <div class="p-4 flex-grow space-y-2">
                <p class="text-xs text-gray-600 leading-relaxed">
                    Melakukan kompilasi seluruh rute web & API ke dalam cache file untuk mempercepat matching routing request.
                </p>
                <div class="text-[11px] font-mono text-gray-500 bg-gray-50 p-2 rounded border border-gray-100 space-y-1">
                    <div><span class="text-gray-400">Cache:</span> <code class="text-primary font-bold">php artisan route:cache</code></div>
                    <div><span class="text-gray-400">Clear:</span> <code class="text-danger font-bold">php artisan route:clear</code></div>
                </div>
            </div>
            <div class="card-footer border-t border-borderColor p-4 bg-gray-50 flex items-center justify-between gap-2">
                <button type="button" class="btn-cache-action w-1/2 btn bg-primary border border-primary text-white text-center hover:bg-primary-hover hover:text-white py-1.5 px-3 rounded text-xs flex items-center justify-center gap-1"
                    data-action="route_cache"
                    data-title="Cache Routes"
                    data-command="php artisan route:cache"
                    data-desc="Melakukan kompilasi rute ke dalam cache file.">
                    <i class="ti ti-cpu"></i> Cache Route
                </button>
                <button type="button" class="btn-cache-action w-1/2 btn bg-white border border-borderColor text-gray-700 text-center hover:bg-gray-100 py-1.5 px-3 rounded text-xs flex items-center justify-center gap-1"
                    data-action="route_clear"
                    data-title="Clear Route Cache"
                    data-command="php artisan route:clear"
                    data-desc="Menghapus cache rute aplikasi.">
                    <i class="ti ti-trash"></i> Clear Route
                </button>
            </div>
        </div>

        <!-- View Cache -->
        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white flex flex-col justify-between">
            <div class="card-header border-b border-borderColor p-4 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <i class="ti ti-template text-xl text-primary"></i>
                    <h5 class="card-title font-semibold text-gray-800">View (Blade) Cache</h5>
                </div>
                <span class="inline-flex items-center py-1 px-2.5 rounded-full text-xs font-semibold bg-info/10 text-info border border-info/20">
                    <i class="ti ti-files mr-1"></i> {{ $cacheStatus['view_files_count'] }} Views
                </span>
            </div>
            <div class="p-4 flex-grow space-y-2">
                <p class="text-xs text-gray-600 leading-relaxed">
                    Melakukan pra-kompilasi semua template Blade ke dalam PHP murni di folder framework untuk meningkatkan kecepatan render.
                </p>
                <div class="text-[11px] font-mono text-gray-500 bg-gray-50 p-2 rounded border border-gray-100 space-y-1">
                    <div><span class="text-gray-400">Cache:</span> <code class="text-primary font-bold">php artisan view:cache</code></div>
                    <div><span class="text-gray-400">Clear:</span> <code class="text-danger font-bold">php artisan view:clear</code></div>
                </div>
            </div>
            <div class="card-footer border-t border-borderColor p-4 bg-gray-50 flex items-center justify-between gap-2">
                <button type="button" class="btn-cache-action w-1/2 btn bg-primary border border-primary text-white text-center hover:bg-primary-hover hover:text-white py-1.5 px-3 rounded text-xs flex items-center justify-center gap-1"
                    data-action="view_cache"
                    data-title="Compile Blade Views"
                    data-command="php artisan view:cache"
                    data-desc="Melakukan pra-kompilasi seluruh template Blade aplikasi.">
                    <i class="ti ti-cpu"></i> Compile Views
                </button>
                <button type="button" class="btn-cache-action w-1/2 btn bg-white border border-borderColor text-gray-700 text-center hover:bg-gray-100 py-1.5 px-3 rounded text-xs flex items-center justify-center gap-1"
                    data-action="view_clear"
                    data-title="Clear Compiled Views"
                    data-command="php artisan view:clear"
                    data-desc="Menghapus file pra-kompilasi template Blade.">
                    <i class="ti ti-trash"></i> Clear Views
                </button>
            </div>
        </div>

        <!-- Event Cache -->
        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white flex flex-col justify-between">
            <div class="card-header border-b border-borderColor p-4 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <i class="ti ti-bell-ringing text-xl text-primary"></i>
                    <h5 class="card-title font-semibold text-gray-800">Event & Listener Cache</h5>
                </div>
                @if($cacheStatus['events_cached'])
                    <span class="inline-flex items-center py-1 px-2.5 rounded-full text-xs font-semibold bg-success/10 text-success border border-success/20">
                        <i class="ti ti-check mr-1"></i> Cached
                    </span>
                @else
                    <span class="inline-flex items-center py-1 px-2.5 rounded-full text-xs font-semibold bg-warning/10 text-warning border border-warning/20">
                        <i class="ti ti-alert-circle mr-1"></i> Not Cached
                    </span>
                @endif
            </div>
            <div class="p-4 flex-grow space-y-2">
                <p class="text-xs text-gray-600 leading-relaxed">
                    Melakukan discovery dan kompilasi seluruh event & listener terdaftar pada aplikasi.
                </p>
                <div class="text-[11px] font-mono text-gray-500 bg-gray-50 p-2 rounded border border-gray-100 space-y-1">
                    <div><span class="text-gray-400">Cache:</span> <code class="text-primary font-bold">php artisan event:cache</code></div>
                    <div><span class="text-gray-400">Clear:</span> <code class="text-danger font-bold">php artisan event:clear</code></div>
                </div>
            </div>
            <div class="card-footer border-t border-borderColor p-4 bg-gray-50 flex items-center justify-between gap-2">
                <button type="button" class="btn-cache-action w-1/2 btn bg-primary border border-primary text-white text-center hover:bg-primary-hover hover:text-white py-1.5 px-3 rounded text-xs flex items-center justify-center gap-1"
                    data-action="event_cache"
                    data-title="Cache Events & Listeners"
                    data-command="php artisan event:cache"
                    data-desc="Melakukan discovery dan pembuatan cache event & listener.">
                    <i class="ti ti-cpu"></i> Cache Events
                </button>
                <button type="button" class="btn-cache-action w-1/2 btn bg-white border border-borderColor text-gray-700 text-center hover:bg-gray-100 py-1.5 px-3 rounded text-xs flex items-center justify-center gap-1"
                    data-action="event_clear"
                    data-title="Clear Event Cache"
                    data-command="php artisan event:clear"
                    data-desc="Menghapus cache event & listener aplikasi.">
                    <i class="ti ti-trash"></i> Clear Events
                </button>
            </div>
        </div>

        <!-- Application Data Cache -->
        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white flex flex-col justify-between">
            <div class="card-header border-b border-borderColor p-4 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <i class="ti ti-database-export text-xl text-primary"></i>
                    <h5 class="card-title font-semibold text-gray-800">Application Data Cache</h5>
                </div>
                <span class="inline-flex items-center py-1 px-2.5 rounded-full text-xs font-semibold bg-primary/10 text-primary border border-primary/20">
                    <i class="ti ti-database mr-1"></i> {{ strtoupper($cacheStatus['cache_driver']) }}
                </span>
            </div>
            <div class="p-4 flex-grow space-y-2">
                <p class="text-xs text-gray-600 leading-relaxed">
                    Membersihkan seluruh data cache aplikasi (database, cache repository, redis, file cache, dsb).
                </p>
                <div class="text-[11px] font-mono text-gray-500 bg-gray-50 p-2 rounded border border-gray-100 space-y-1">
                    <div><span class="text-gray-400">Clear:</span> <code class="text-danger font-bold">php artisan cache:clear</code></div>
                </div>
            </div>
            <div class="card-footer border-t border-borderColor p-4 bg-gray-50 flex items-center justify-end">
                <button type="button" class="btn-cache-action w-full btn bg-danger border border-danger text-white text-center hover:bg-danger/80 hover:text-white py-1.5 px-3 rounded text-xs flex items-center justify-center gap-1"
                    data-action="cache_clear"
                    data-title="Flush Application Data Cache"
                    data-command="php artisan cache:clear"
                    data-desc="Membersihkan seluruh data cache yang tersimpan di cache store default.">
                    <i class="ti ti-trash"></i> Flush Data Cache
                </button>
            </div>
        </div>

        <!-- Framework Optimization (Optimize & Optimize Clear) -->
        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white flex flex-col justify-between">
            <div class="card-header border-b border-borderColor p-4 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <i class="ti ti-bolt text-xl text-primary"></i>
                    <h5 class="card-title font-semibold text-gray-800">Framework Optimization</h5>
                </div>
                <span class="inline-flex items-center py-1 px-2.5 rounded-full text-xs font-semibold bg-primary/10 text-primary border border-primary/20">
                    <i class="ti ti-bolt mr-1"></i> Optimize
                </span>
            </div>
            <div class="p-4 flex-grow space-y-2">
                <p class="text-xs text-gray-600 leading-relaxed">
                    Mengoptimalkan bootstrap framework atau membersihkan seluruh cache hasil kompilasi & optimasi sekaligus.
                </p>
                <div class="text-[11px] font-mono text-gray-500 bg-gray-50 p-2 rounded border border-gray-100 space-y-1">
                    <div><span class="text-gray-400">Optimize:</span> <code class="text-primary font-bold">php artisan optimize</code></div>
                    <div><span class="text-gray-400">Clear:</span> <code class="text-danger font-bold">php artisan optimize:clear</code></div>
                </div>
            </div>
            <div class="card-footer border-t border-borderColor p-4 bg-gray-50 flex items-center justify-between gap-2">
                <button type="button" class="btn-cache-action w-1/2 btn bg-primary border border-primary text-white text-center hover:bg-primary-hover hover:text-white py-1.5 px-3 rounded text-xs flex items-center justify-center gap-1"
                    data-action="optimize"
                    data-title="Optimize Framework"
                    data-command="php artisan optimize"
                    data-desc="Melakukan caching konfigurasi dan rute framework untuk performa maksimal.">
                    <i class="ti ti-bolt"></i> Optimize
                </button>
                <button type="button" class="btn-cache-action w-1/2 btn bg-danger border border-danger text-white text-center hover:bg-danger/80 hover:text-white py-1.5 px-3 rounded text-xs flex items-center justify-center gap-1"
                    data-action="optimize_clear"
                    data-title="Optimize Clear"
                    data-command="php artisan optimize:clear"
                    data-desc="Membersihkan seluruh cache optimasi framework (config, route, view, event, compiled classes, cache).">
                    <i class="ti ti-trash"></i> Optimize Clear
                </button>
            </div>
        </div>
    </div>
    <!-- END: Cache Management Items -->
</div>

@include('admin.settings.cache.partials.modal-execute')
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        const actionDetails = {
            'optimize': { command: 'php artisan optimize', desc: 'Melakukan caching konfigurasi, rute, dan file framework untuk performa maksimal.' },
            'optimize_clear': { command: 'php artisan optimize:clear', desc: 'Membersihkan seluruh cache optimasi framework (config, route, view, event, compiled classes, cache).' },
            'config_cache': { command: 'php artisan config:cache', desc: 'Membuat cache seluruh file konfigurasi aplikasi.' },
            'config_clear': { command: 'php artisan config:clear', desc: 'Menghapus cache konfigurasi aplikasi.' },
            'route_cache': { command: 'php artisan route:cache', desc: 'Melakukan kompilasi seluruh rute aplikasi ke dalam cache file.' },
            'route_clear': { command: 'php artisan route:clear', desc: 'Menghapus cache rute aplikasi.' },
            'view_cache': { command: 'php artisan view:cache', desc: 'Melakukan pra-kompilasi seluruh template Blade aplikasi.' },
            'view_clear': { command: 'php artisan view:clear', desc: 'Menghapus file pra-kompilasi template Blade.' },
            'event_cache': { command: 'php artisan event:cache', desc: 'Melakukan discovery dan pembuatan cache event & listener.' },
            'event_clear': { command: 'php artisan event:clear', desc: 'Menghapus cache event & listener aplikasi.' },
            'cache_clear': { command: 'php artisan cache:clear', desc: 'Membersihkan seluruh data cache yang tersimpan di cache store default.' }
        };

        $('#modal-cache-select-action').on('change', function () {
            const val = $(this).val();
            if (actionDetails[val]) {
                $('#modal-cache-command-text').text(actionDetails[val].command);
                $('#modal-cache-desc-text').text(actionDetails[val].desc);
            }
        });

        $('.btn-cache-action').on('click', function (e) {
            e.preventDefault();
            const action = $(this).data('action');
            $('#modal-cache-select-action').val(action).trigger('change');
            $('#modalExecuteToggle').click();
        });
    });
</script>
@endpush
