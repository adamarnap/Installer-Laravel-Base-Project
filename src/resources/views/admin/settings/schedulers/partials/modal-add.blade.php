{{-- START: Modal Add Scheduled Task --}}
<div class="modal-add z-[999] fixed transition-all inset-0 overflow-x-hidden overflow-y-auto" id="modal-add">
    <div class="popup-dialog flex transition-all items-center justify-center min-h-screen px-4 sm:px-6">
        <div class="trezo-card w-full max-w-[95%] sm:max-w-[720px] md:max-w-[850px] bg-white dark:bg-[#0c1427] p-[20px] md:p-[25px] rounded-md">
            
            {{-- START: Modal Header --}}
            <div class="trezo-card-header bg-gray-50 dark:bg-[#15203c] mb-[20px] md:mb-[25px] flex items-center justify-between -mx-[20px] md:-mx-[25px] -mt-[20px] md:-mt-[25px] p-[20px] md:p-[25px] rounded-t-md">
                <div class="trezo-card-title">
                    <h5 class="mb-0 text-base">
                        Tambah Task Scheduler Baru
                    </h5>
                </div>
                <div class="trezo-card-subtitle">
                    <button type="button" class="text-[23px] transition-all leading-none text-black dark:text-white hover:text-primary-500" id="modal-add-toggle">
                        <i class="ri-close-fill"></i>
                    </button>
                </div>
            </div>
            {{-- END: Modal Header --}}

            {{-- START: Form Add --}}
            <form action="{{ route('settings.schedulers.store') }}" method="POST">
                @csrf
                {{-- START: Modal Body --}}
                <div class="trezo-card-content pb-[20px] md:pb-[25px] space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-[15px]">
                        {{-- Task Name --}}
                        <div>
                            <label class="mb-[12px] font-medium block text-xs md:text-sm">
                                Nama Task <strong class="text-red-500">*</strong>
                            </label>
                            <input type="text" name="name" required class="h-[45px] rounded-md text-black dark:text-white border border-gray-200 dark:border-[#172036] bg-white dark:bg-[#0c1427] px-[17px] block w-full outline-0 transition-all placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:border-primary-500 text-xs" placeholder="e.g. Daily Data Backup">
                        </div>

                        {{-- Type --}}
                        <div>
                            <label class="mb-[12px] font-medium block text-xs md:text-sm">
                                Tipe Task <strong class="text-red-500">*</strong>
                            </label>
                            <select name="type" required class="select2 h-[45px] rounded-md border border-gray-200 dark:border-[#172036] bg-white dark:bg-[#0c1427] px-[13px] block w-full outline-0 cursor-pointer transition-all focus:border-primary-500 text-xs">
                                @foreach (\App\Enums\Settings\SchedulerTypeEnum::cases() as $typeEnum)
                                    <option value="{{ $typeEnum->value }}">{{ $typeEnum->label() }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Command --}}
                    <div>
                        <label class="mb-[12px] font-medium block text-xs md:text-sm">
                            Command / Perintah Artisan <strong class="text-red-500">*</strong>
                        </label>
                        <input type="text" name="command" required class="h-[45px] rounded-md text-black dark:text-white border border-gray-200 dark:border-[#172036] bg-white dark:bg-[#0c1427] px-[17px] block w-full outline-0 transition-all placeholder:text-gray-500 dark:placeholder:text-gray-400 font-mono text-xs focus:border-primary-500" placeholder="e.g. queue:work --stop-when-empty atau cache:clear">
                    </div>

                    {{-- Cron Expression --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-[15px]">
                        <div>
                            <label class="mb-[12px] font-medium block text-xs md:text-sm">
                                Preset Jadwal Cron
                            </label>
                            <select id="preset-cron-select" class="h-[45px] rounded-md border border-gray-200 dark:border-[#172036] bg-white dark:bg-[#0c1427] px-[13px] block w-full outline-0 cursor-pointer transition-all focus:border-primary-500 text-xs">
                                <option value="">-- Pilih Preset Interval --</option>
                                <option value="* * * * *">Setiap Menit (* * * * *)</option>
                                <option value="*/5 * * * *">Setiap 5 Menit (*/5 * * * *)</option>
                                <option value="*/15 * * * *">Setiap 15 Menit (*/15 * * * *)</option>
                                <option value="*/30 * * * *">Setiap 30 Menit (*/30 * * * *)</option>
                                <option value="0 * * * *">Setiap Jam (0 * * * *)</option>
                                <option value="0 0 * * *">Setiap Hari Jam 00:00 (0 0 * * *)</option>
                                <option value="0 1 * * *">Setiap Hari Jam 01:00 (0 1 * * *)</option>
                                <option value="0 0 * * 0">Setiap Minggu (0 0 * * 0)</option>
                                <option value="0 0 1 * *">Setiap Awal Bulan (0 0 1 * *)</option>
                            </select>
                        </div>

                        <div>
                            <label class="mb-[12px] font-medium block text-xs md:text-sm">
                                Cron Expression <strong class="text-red-500">*</strong>
                            </label>
                            <input type="text" name="expression" id="input-expression-add" required class="h-[45px] rounded-md text-black dark:text-white border border-gray-200 dark:border-[#172036] bg-white dark:bg-[#0c1427] px-[17px] block w-full outline-0 transition-all font-mono text-xs focus:border-primary-500" placeholder="* * * * *">
                        </div>
                    </div>

                    {{-- Description --}}
                    <div>
                        <label class="mb-[12px] font-medium block text-xs md:text-sm">
                            Deskripsi Task
                        </label>
                        <textarea name="description" rows="2" class="h-[80px] rounded-md text-black dark:text-white border border-gray-200 dark:border-[#172036] bg-white dark:bg-[#0c1427] p-[17px] block w-full outline-0 transition-all placeholder:text-gray-500 dark:placeholder:text-gray-400 text-xs focus:border-primary-500" placeholder="Keterangan fungsi dari task ini..."></textarea>
                    </div>

                    {{-- Execution Options (Checkboxes with detailed explanations) --}}
                    <div class="p-4 bg-gray-50 dark:bg-[#15203c] rounded-md space-y-3">
                        <label class="font-semibold text-xs md:text-sm text-gray-800 dark:text-white block border-b border-gray-200 dark:border-[#172036] pb-2">
                            Opsi Eksekusi Task & Penjelasannya:
                        </label>
                        
                        {{-- Is Active Checkbox --}}
                        <div class="flex items-start gap-3">
                            <input type="checkbox" name="is_active" id="add-is-active" value="1" checked class="mt-0.5 rounded border-gray-300 text-primary-500 focus:ring-primary-400 cursor-pointer">
                            <label for="add-is-active" class="cursor-pointer text-xs">
                                <strong class="text-gray-800 dark:text-white block">Aktifkan Task (Is Active)</strong>
                                <span class="text-gray-500 block text-[11px] mt-0.5">Task ini akan didaftarkan ke sistem scheduler dan dieksekusi secara otomatis saat jadwal cron tercapai.</span>
                            </label>
                        </div>

                        {{-- Without Overlapping Checkbox --}}
                        <div class="flex items-start gap-3">
                            <input type="checkbox" name="without_overlapping" id="add-without-overlapping" value="1" class="mt-0.5 rounded border-gray-300 text-primary-500 focus:ring-primary-400 cursor-pointer">
                            <label for="add-without-overlapping" class="cursor-pointer text-xs">
                                <strong class="text-gray-800 dark:text-white block">Without Overlapping (Cegah Eksekusi Tumpang Tindih)</strong>
                                <span class="text-gray-500 block text-[11px] mt-0.5">Mencegah instance baru dari task ini berjalan jika eksekusi task sebelumnya belum selesai, sehingga menghindari duplikasi proses data.</span>
                            </label>
                        </div>

                        {{-- Run in Background Checkbox --}}
                        <div class="flex items-start gap-3">
                            <input type="checkbox" name="run_in_background" id="add-run-in-background" value="1" class="mt-0.5 rounded border-gray-300 text-primary-500 focus:ring-primary-400 cursor-pointer">
                            <label for="add-run-in-background" class="cursor-pointer text-xs">
                                <strong class="text-gray-800 dark:text-white block">Run in Background (Eksekusi di Latar Belakang)</strong>
                                <span class="text-gray-500 block text-[11px] mt-0.5">Menjalankan task ini sebagai proses background terpisah sehingga tidak memblokir atau memperlambat task-task scheduler lainnya.</span>
                            </label>
                        </div>
                    </div>

                    {{-- Notifications --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-[15px]">
                        <div>
                            <label class="mb-[12px] font-medium block text-xs md:text-sm">
                                Notifikasi Kegagalan
                            </label>
                            <select name="notification_channel" class="select2 h-[45px] rounded-md border border-gray-200 dark:border-[#172036] bg-white dark:bg-[#0c1427] px-[13px] block w-full outline-0 cursor-pointer transition-all focus:border-primary-500 text-xs">
                                @foreach (\App\Enums\Settings\SchedulerNotificationEnum::cases() as $notifEnum)
                                    <option value="{{ $notifEnum->value }}">{{ $notifEnum->label() }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="mb-[12px] font-medium block text-xs md:text-sm">
                                Penerima / Webhook URL
                            </label>
                            <input type="text" name="notification_recipient" class="h-[45px] rounded-md text-black dark:text-white border border-gray-200 dark:border-[#172036] bg-white dark:bg-[#0c1427] px-[17px] block w-full outline-0 transition-all placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:border-primary-500 text-xs" placeholder="email@domain.com atau https://hooks.slack.com/...">
                        </div>
                    </div>
                </div>
                {{-- END: Modal Body --}}

                {{-- START: Modal Footer --}}
                <div class="trezo-card-footer flex items-center justify-between -mx-[20px] md:-mx-[25px] px-[20px] md:px-[25px] pt-[20px] md:pt-[25px] border-t border-gray-100 dark:border-[#172036]">
                    <button class="py-[10px] px-[25px] bg-gray-200 dark:bg-[#15203c] text-gray-700 dark:text-gray-300 transition-all hover:bg-gray-300 rounded-md text-xs font-medium" type="button" id="modal-add-toggle">
                        Batal
                    </button>
                    <button type="submit" class="py-[10px] px-[25px] bg-primary-500 text-white transition-all hover:bg-primary-400 rounded-md text-xs font-medium inline-flex items-center gap-1.5">
                        <i class="material-symbols-outlined !text-sm">save</i>
                        Simpan Task
                    </button>
                </div>
                {{-- END: Modal Footer --}}
            </form>
            {{-- END: Form Add --}}

        </div>
    </div>
</div>
{{-- END: Modal Add Scheduled Task --}}
