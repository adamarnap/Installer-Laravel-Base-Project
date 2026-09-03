@extends('layouts.admin.master')

@section('title', 'Cache Management')

@section('breadcrumb')
    {{ Breadcrumbs::render('cache') }}
@endsection

@section('content')
    <div class="grid grid-cols-1 gap-base">
        {{-- START: Overview Status Card --}}
        <div class="card">
            <div class="card-header">
                <div>
                    <h4 class="card-title mb-1.25">Status Cache Sistem</h4>
                    <p class="text-default-400">Informasi status cache konfigurasi, rute, view, dan driver cache aplikasi saat ini.</p>
                </div>
            </div>
            <div class="card-body">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    {{-- Config Cache Status --}}
                    <div class="border border-default-200 rounded-lg p-4 bg-default-50/50 flex items-center justify-between">
                        <div>
                            <span class="text-xs text-default-500 font-semibold uppercase block mb-1">Cache Konfigurasi</span>
                            <div class="flex items-center gap-2">
                                @if ($cacheStatus['config_cached'])
                                    <span class="badge bg-success/15 text-success font-semibold text-xs py-1 px-2.5 rounded-full inline-flex items-center gap-1">
                                        <i class="iconify tabler--circle-check text-sm"></i> Ter-cache
                                    </span>
                                @else
                                    <span class="badge bg-warning/15 text-warning font-semibold text-xs py-1 px-2.5 rounded-full inline-flex items-center gap-1">
                                        <i class="iconify tabler--alert-circle text-sm"></i> Belum di-cache
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-primary/10 text-primary flex items-center justify-center">
                            <i class="iconify tabler--settings text-xl"></i>
                        </div>
                    </div>

                    {{-- Route Cache Status --}}
                    <div class="border border-default-200 rounded-lg p-4 bg-default-50/50 flex items-center justify-between">
                        <div>
                            <span class="text-xs text-default-500 font-semibold uppercase block mb-1">Cache Rute</span>
                            <div class="flex items-center gap-2">
                                @if ($cacheStatus['routes_cached'])
                                    <span class="badge bg-success/15 text-success font-semibold text-xs py-1 px-2.5 rounded-full inline-flex items-center gap-1">
                                        <i class="iconify tabler--circle-check text-sm"></i> Ter-cache
                                    </span>
                                @else
                                    <span class="badge bg-warning/15 text-warning font-semibold text-xs py-1 px-2.5 rounded-full inline-flex items-center gap-1">
                                        <i class="iconify tabler--alert-circle text-sm"></i> Belum di-cache
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-info/10 text-info flex items-center justify-center">
                            <i class="iconify tabler--route text-xl"></i>
                        </div>
                    </div>

                    {{-- Compiled Views --}}
                    <div class="border border-default-200 rounded-lg p-4 bg-default-50/50 flex items-center justify-between">
                        <div>
                            <span class="text-xs text-default-500 font-semibold uppercase block mb-1">Kompilasi Blade View</span>
                            <div class="text-lg font-bold text-default-800">
                                {{ $cacheStatus['view_files_count'] }} <span class="text-xs font-normal text-default-500">File Blade</span>
                            </div>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-secondary/10 text-secondary flex items-center justify-center">
                            <i class="iconify tabler--layout text-xl"></i>
                        </div>
                    </div>

                    {{-- Cache Driver & Environment --}}
                    <div class="border border-default-200 rounded-lg p-4 bg-default-50/50 flex items-center justify-between">
                        <div>
                            <span class="text-xs text-default-500 font-semibold uppercase block mb-1">Driver & Lingkungan</span>
                            <div class="text-sm font-semibold text-default-800">
                                {{ strtoupper($cacheStatus['cache_driver']) }}
                                <span class="badge bg-primary/10 text-primary text-2xs px-2 py-0.5 rounded font-mono">{{ $cacheStatus['app_env'] }}</span>
                            </div>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-dark/10 text-dark flex items-center justify-center">
                            <i class="iconify tabler--server text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- END: Overview Status Card --}}

        {{-- START: Cache Actions Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-base">
            {{-- Card 1: Konfigurasi --}}
            <div class="card flex flex-col justify-between">
                <div class="card-body">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-lg bg-primary/10 text-primary flex items-center justify-center">
                            <i class="iconify tabler--adjustments-horizontal text-xl"></i>
                        </div>
                        <div>
                            <h5 class="font-bold text-default-800">Cache Konfigurasi</h5>
                            <span class="text-xs text-default-400">Pengaturan framework & file konfigurasi</span>
                        </div>
                    </div>
                    <p class="text-sm text-default-600 mb-4">
                        Menggabungkan semua konfigurasi aplikasi menjadi satu file untuk mempercepat performa loading aplikasi.
                    </p>
                    <div class="bg-default-100 rounded p-2 text-xs font-mono text-default-700 mb-4 flex items-center gap-2">
                        <i class="iconify tabler--terminal text-default-500"></i>
                        <span>php artisan config:cache</span>
                    </div>
                </div>
                <div class="card-footer border-t border-default-200 p-4 bg-default-50/50 flex items-center justify-between gap-2">
                    <button type="button"
                        class="btn-cache-action btn bg-primary hover:bg-primary-hover text-white text-xs py-2 px-3 rounded inline-flex items-center gap-1.5"
                        data-action="config_cache"
                        data-title="Buat Cache Konfigurasi"
                        data-command="php artisan config:cache"
                        data-desc="Apakah Anda yakin ingin mengkompilasi file konfigurasi aplikasi?">
                        <i class="iconify tabler--device-floppy text-sm"></i>
                        Cache Config
                    </button>
                    <button type="button"
                        class="btn-cache-action btn border-danger text-danger hover:bg-danger hover:text-white text-xs py-2 px-3 rounded inline-flex items-center gap-1.5"
                        data-action="config_clear"
                        data-title="Bersihkan Cache Konfigurasi"
                        data-command="php artisan config:clear"
                        data-desc="Apakah Anda yakin ingin menghapus cache konfigurasi? Aplikasi akan membaca langsung dari file konfigurasi individual.">
                        <i class="iconify tabler--trash text-sm"></i>
                        Clear Config
                    </button>
                </div>
            </div>

            {{-- Card 2: Rute (Routes) --}}
            <div class="card flex flex-col justify-between">
                <div class="card-body">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-lg bg-info/10 text-info flex items-center justify-center">
                            <i class="iconify tabler--route-2 text-xl"></i>
                        </div>
                        <div>
                            <h5 class="font-bold text-default-800">Cache Rute</h5>
                            <span class="text-xs text-default-400">Pendaftaran URL & Endpoint Rute</span>
                        </div>
                    </div>
                    <p class="text-sm text-default-600 mb-4">
                        Mengompilasi seluruh rute aplikasi menjadi satu file registrasi untuk mempercepat pencocokan rute request.
                    </p>
                    <div class="bg-default-100 rounded p-2 text-xs font-mono text-default-700 mb-4 flex items-center gap-2">
                        <i class="iconify tabler--terminal text-default-500"></i>
                        <span>php artisan route:cache</span>
                    </div>
                </div>
                <div class="card-footer border-t border-default-200 p-4 bg-default-50/50 flex items-center justify-between gap-2">
                    <button type="button"
                        class="btn-cache-action btn bg-primary hover:bg-primary-hover text-white text-xs py-2 px-3 rounded inline-flex items-center gap-1.5"
                        data-action="route_cache"
                        data-title="Buat Cache Rute"
                        data-command="php artisan route:cache"
                        data-desc="Apakah Anda yakin ingin mengkompilasi seluruh rute aplikasi?">
                        <i class="iconify tabler--device-floppy text-sm"></i>
                        Cache Route
                    </button>
                    <button type="button"
                        class="btn-cache-action btn border-danger text-danger hover:bg-danger hover:text-white text-xs py-2 px-3 rounded inline-flex items-center gap-1.5"
                        data-action="route_clear"
                        data-title="Bersihkan Cache Rute"
                        data-command="php artisan route:clear"
                        data-desc="Apakah Anda yakin ingin menghapus cache rute? Aplikasi akan mendaftarkan ulang rute setiap request.">
                        <i class="iconify tabler--trash text-sm"></i>
                        Clear Route
                    </button>
                </div>
            </div>

            {{-- Card 3: Blade View --}}
            <div class="card flex flex-col justify-between">
                <div class="card-body">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-lg bg-secondary/10 text-secondary flex items-center justify-center">
                            <i class="iconify tabler--template text-xl"></i>
                        </div>
                        <div>
                            <h5 class="font-bold text-default-800">Cache Blade View</h5>
                            <span class="text-xs text-default-400">Template Blade yang dikompilasi</span>
                        </div>
                    </div>
                    <p class="text-sm text-default-600 mb-4">
                        Mengompilasi seluruh template Blade ke dalam file PHP standar di direktori storage framework untuk performa render cepat.
                    </p>
                    <div class="bg-default-100 rounded p-2 text-xs font-mono text-default-700 mb-4 flex items-center gap-2">
                        <i class="iconify tabler--terminal text-default-500"></i>
                        <span>php artisan view:cache</span>
                    </div>
                </div>
                <div class="card-footer border-t border-default-200 p-4 bg-default-50/50 flex items-center justify-between gap-2">
                    <button type="button"
                        class="btn-cache-action btn bg-primary hover:bg-primary-hover text-white text-xs py-2 px-3 rounded inline-flex items-center gap-1.5"
                        data-action="view_cache"
                        data-title="Kompilasi Cache View"
                        data-command="php artisan view:cache"
                        data-desc="Apakah Anda yakin ingin mengkompilasi seluruh template Blade view?">
                        <i class="iconify tabler--device-floppy text-sm"></i>
                        Cache View
                    </button>
                    <button type="button"
                        class="btn-cache-action btn border-danger text-danger hover:bg-danger hover:text-white text-xs py-2 px-3 rounded inline-flex items-center gap-1.5"
                        data-action="view_clear"
                        data-title="Bersihkan Cache View"
                        data-command="php artisan view:clear"
                        data-desc="Apakah Anda yakin ingin menghapus seluruh file kompilasi Blade view yang tersimpan?">
                        <i class="iconify tabler--trash text-sm"></i>
                        Clear View
                    </button>
                </div>
            </div>

            {{-- Card 4: Event & Listener --}}
            <div class="card flex flex-col justify-between">
                <div class="card-body">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-lg bg-warning/10 text-warning flex items-center justify-center">
                            <i class="iconify tabler--broadcast text-xl"></i>
                        </div>
                        <div>
                            <h5 class="font-bold text-default-800">Cache Event & Listener</h5>
                            <span class="text-xs text-default-400">Pendaftaran Event Discovery</span>
                        </div>
                    </div>
                    <p class="text-sm text-default-600 mb-4">
                        Membuat cache registrasi discovery untuk seluruh Event dan Listener yang terdaftar di aplikasi.
                    </p>
                    <div class="bg-default-100 rounded p-2 text-xs font-mono text-default-700 mb-4 flex items-center gap-2">
                        <i class="iconify tabler--terminal text-default-500"></i>
                        <span>php artisan event:cache</span>
                    </div>
                </div>
                <div class="card-footer border-t border-default-200 p-4 bg-default-50/50 flex items-center justify-between gap-2">
                    <button type="button"
                        class="btn-cache-action btn bg-primary hover:bg-primary-hover text-white text-xs py-2 px-3 rounded inline-flex items-center gap-1.5"
                        data-action="event_cache"
                        data-title="Buat Cache Event"
                        data-command="php artisan event:cache"
                        data-desc="Apakah Anda yakin ingin mengkompilasi registrasi Event & Listener?">
                        <i class="iconify tabler--device-floppy text-sm"></i>
                        Cache Event
                    </button>
                    <button type="button"
                        class="btn-cache-action btn border-danger text-danger hover:bg-danger hover:text-white text-xs py-2 px-3 rounded inline-flex items-center gap-1.5"
                        data-action="event_clear"
                        data-title="Bersihkan Cache Event"
                        data-command="php artisan event:clear"
                        data-desc="Apakah Anda yakin ingin menghapus cache registrasi Event & Listener?">
                        <i class="iconify tabler--trash text-sm"></i>
                        Clear Event
                    </button>
                </div>
            </div>

            {{-- Card 5: Application Data Cache --}}
            <div class="card flex flex-col justify-between">
                <div class="card-body">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-lg bg-success/10 text-success flex items-center justify-center">
                            <i class="iconify tabler--database text-xl"></i>
                        </div>
                        <div>
                            <h5 class="font-bold text-default-800">Cache Data Aplikasi</h5>
                            <span class="text-xs text-default-400">Data cache query & session cache</span>
                        </div>
                    </div>
                    <p class="text-sm text-default-600 mb-4">
                        Membersihkan seluruh key data cache yang disimpan oleh aplikasi melalui driver cache default ({{ strtoupper($cacheStatus['cache_driver']) }}).
                    </p>
                    <div class="bg-default-100 rounded p-2 text-xs font-mono text-default-700 mb-4 flex items-center gap-2">
                        <i class="iconify tabler--terminal text-default-500"></i>
                        <span>php artisan cache:clear</span>
                    </div>
                </div>
                <div class="card-footer border-t border-default-200 p-4 bg-default-50/50 flex items-center justify-end">
                    <button type="button"
                        class="btn-cache-action btn border-danger text-danger hover:bg-danger hover:text-white text-xs py-2 px-3 rounded inline-flex items-center gap-1.5"
                        data-action="cache_clear"
                        data-title="Bersihkan Data Cache Aplikasi"
                        data-command="php artisan cache:clear"
                        data-desc="Apakah Anda yakin ingin mengosongkan seluruh data cache aplikasi? Data temporary yang tersimpan di cache akan dihapus.">
                        <i class="iconify tabler--trash text-sm"></i>
                        Clear App Cache
                    </button>
                </div>
            </div>

            {{-- Card 6: Full Optimization (All in One) --}}
            <div class="card flex flex-col justify-between border-2 border-primary/20">
                <div class="card-body">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-lg bg-primary text-white flex items-center justify-center">
                            <i class="iconify tabler--rocket text-xl"></i>
                        </div>
                        <div>
                            <h5 class="font-bold text-default-800">Optimasi Lengkap Framework</h5>
                            <span class="text-xs text-primary font-semibold">Tindakan Menyeluruh (All-In-One)</span>
                        </div>
                    </div>
                    <p class="text-sm text-default-600 mb-4">
                        Menjalankan atau membersihkan seluruh cache framework sekaligus (Config, Route, View, dan Event).
                    </p>
                    <div class="bg-default-100 rounded p-2 text-xs font-mono text-default-700 mb-4 flex items-center gap-2">
                        <i class="iconify tabler--terminal text-default-500"></i>
                        <span>php artisan optimize | optimize:clear</span>
                    </div>
                </div>
                <div class="card-footer border-t border-default-200 p-4 bg-default-50/50 flex items-center justify-between gap-2">
                    <button type="button"
                        class="btn-cache-action btn bg-success hover:bg-success-hover text-white text-xs py-2 px-3 rounded inline-flex items-center gap-1.5"
                        data-action="optimize"
                        data-title="Jalankan Optimasi Framework"
                        data-command="php artisan optimize"
                        data-desc="Apakah Anda yakin ingin mengoptimasi framework? Perintah ini akan mengkompilasi config, routes, dan file terkait untuk performa maksimal.">
                        <i class="iconify tabler--bolt text-sm"></i>
                        Optimize
                    </button>
                    <button type="button"
                        class="btn-cache-action btn bg-danger hover:bg-danger-hover text-white text-xs py-2 px-3 rounded inline-flex items-center gap-1.5"
                        data-action="optimize_clear"
                        data-title="Bersihkan Seluruh Cache Optimasi"
                        data-command="php artisan optimize:clear"
                        data-desc="Apakah Anda yakin ingin membersihkan seluruh cache (config, route, view, event, compiled)?">
                        <i class="iconify tabler--sparkles text-sm"></i>
                        Optimize Clear
                    </button>
                </div>
            </div>
        </div>
        {{-- END: Cache Actions Cards --}}
    </div>

    {{-- Form for Submitting Cache Actions --}}
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
                const action = $(this).data('action');
                const title = $(this).data('title');
                const command = $(this).data('command');
                const desc = $(this).data('desc');

                Swal.fire({
                    title: title,
                    html: `
                        <div class="text-left space-y-3">
                            <p class="text-sm text-gray-600">${desc}</p>
                            <div class="bg-gray-100 p-2.5 rounded text-xs font-mono text-gray-800 border border-gray-300">
                                <span class="text-gray-500 font-semibold block text-[10px] uppercase mb-1">Perintah Artisan yang Dijalankan:</span>
                                <code>${command}</code>
                            </div>
                        </div>
                    `,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="iconify tabler--check mr-1"></i> Ya, Jalankan!',
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
