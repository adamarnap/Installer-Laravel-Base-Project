{{-- START: Modal Add Scheduler Task --}}
<div id="modal-add" class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="modal-add-title">
    <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all max-w-2xl w-full m-3 sm:mx-auto">
        <div class="flex flex-col bg-white border border-default-200 shadow-sm rounded-xl pointer-events-auto dark:bg-default-800 dark:border-default-700">
            <div class="flex justify-between items-center py-3 px-4 border-b border-default-200 dark:border-default-700">
                <div class="flex items-center gap-2">
                    <i class="iconify tabler--clock-plus text-primary text-xl"></i>
                    <h3 id="modal-add-title" class="font-bold text-default-800 dark:text-white">
                        Tambah Scheduled Task Baru
                    </h3>
                </div>
                <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-default-100 text-default-800 hover:bg-default-200 focus:outline-none dark:bg-default-700 dark:hover:bg-default-600 dark:text-default-400" data-hs-overlay="#modal-add">
                    <span class="sr-only">Close</span>
                    <i class="iconify tabler--x text-base"></i>
                </button>
            </div>

            <form action="{{ route('settings.schedulers.store') }}" method="POST" id="form-add-scheduler">
                @csrf
                <div class="p-4 overflow-y-auto max-h-[75vh] space-y-4">
                    {{-- Task Name --}}
                    <div>
                        <label for="add_name" class="form-label py-1 mb-0! font-semibold text-xs text-default-700">Nama Task <span class="text-danger">*</span></label>
                        <input type="text" id="add_name" name="name" class="form-input text-xs" placeholder="Contoh: Sinkronisasi Data Hari Libur Harian" required>
                        <small class="text-default-400 mt-1 block text-2xs">Nama deskriptif untuk mengidentifikasi tugas penjadwalan ini.</small>
                    </div>

                    {{-- Command & Type --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <div class="sm:col-span-2">
                            <label for="add_command" class="form-label py-1 mb-0! font-semibold text-xs text-default-700">Perintah (Command) <span class="text-danger">*</span></label>
                            <input type="text" id="add_command" name="command" class="form-input text-xs font-mono" placeholder="Contoh: holidays:sync atau cache:clear" required>
                            <small class="text-default-400 mt-1 block text-2xs">Perintah Artisan atau instruksi sistem yang akan dijalankan.</small>
                        </div>
                        <div>
                            <label for="add_type" class="form-label py-1 mb-0! font-semibold text-xs text-default-700">Tipe Task <span class="text-danger">*</span></label>
                            <select id="add_type" name="type" class="form-select text-xs" required>
                                <option value="artisan" selected>Artisan Command</option>
                                <option value="shell">Shell / Exec Command</option>
                                <option value="closure">Closure / Callback</option>
                            </select>
                        </div>
                    </div>

                    {{-- Cron Expression --}}
                    <div>
                        <label for="add_expression" class="form-label py-1 mb-0! font-semibold text-xs text-default-700">Interval Waktu / Cron Expression <span class="text-danger">*</span></label>
                        <div class="flex gap-2">
                            <input type="text" id="add_expression" name="expression" class="form-input text-xs font-mono" placeholder="* * * * *" value="0 0 * * *" required>
                            <select id="add_expression_presets" class="form-select text-xs w-48">
                                <option value="">- Template Preset -</option>
                                <option value="* * * * *">Setiap Menit (* * * * *)</option>
                                <option value="*/5 * * * *">Setiap 5 Menit (*/5 * * * *)</option>
                                <option value="*/15 * * * *">Setiap 15 Menit (*/15 * * * *)</option>
                                <option value="0 * * * *">Setiap Jam (0 * * * *)</option>
                                <option value="0 0 * * *" selected>Tengah Malam Harian (0 0 * * *)</option>
                                <option value="0 1 * * *">Pukul 01:00 Harian (0 1 * * *)</option>
                                <option value="0 0 * * 0">Mingguan Hari Minggu (0 0 * * 0)</option>
                                <option value="0 0 1 * *">Bulanan Tgl 1 (0 0 1 * *)</option>
                            </select>
                        </div>
                        <small class="text-default-400 mt-1 block text-2xs">Format standar 5-kolom cron (menit jam hari-bulan bulan hari-minggu).</small>
                    </div>

                    {{-- Description --}}
                    <div>
                        <label for="add_description" class="form-label py-1 mb-0! font-semibold text-xs text-default-700">Keterangan / Deskripsi</label>
                        <textarea id="add_description" name="description" rows="2" class="form-textarea text-xs" placeholder="Penjelasan detail kegunaan task scheduler ini..."></textarea>
                    </div>

                    {{-- Execution Options & Consequences (Detailed explanations for user clarity) --}}
                    <div class="border border-default-200 rounded-lg p-3 bg-default-50/70 space-y-3">
                        <span class="text-xs font-bold text-default-800 uppercase block border-b border-default-200 pb-1">
                            Opsi Konfigurasi & Kebijakan Eksekusi
                        </span>

                        {{-- Checkbox 1: is_active (Eksekusi Aktif) --}}
                        <div class="flex items-start gap-3">
                            <div class="flex items-center h-5">
                                <input type="checkbox" id="add_is_active" name="is_active" value="1" checked class="form-checkbox rounded text-primary focus:ring-primary size-4">
                            </div>
                            <div>
                                <label for="add_is_active" class="font-semibold text-xs text-default-800 cursor-pointer">
                                    Aktifkan Penjadwalan Eksekusi (Status Aktif)
                                </label>
                                <p class="text-2xs text-default-500 mt-0.5 leading-relaxed">
                                    Jika dicentang, daemon scheduler Laravel (<code>php artisan schedule:run</code>) akan secara otomatis mengeksekusi task ini sesuai cron expression yang ditentukan. Jika tidak dicentang, task akan diabaikan dan dinonaktifkan dari jadwal.
                                </p>
                            </div>
                        </div>

                        {{-- Checkbox 2: without_overlapping --}}
                        <div class="flex items-start gap-3">
                            <div class="flex items-center h-5">
                                <input type="checkbox" id="add_without_overlapping" name="without_overlapping" value="1" class="form-checkbox rounded text-primary focus:ring-primary size-4">
                            </div>
                            <div>
                                <label for="add_without_overlapping" class="font-semibold text-xs text-default-800 cursor-pointer">
                                    Cegah Eksekusi Tumpang Tindih (Without Overlapping)
                                </label>
                                <p class="text-2xs text-default-500 mt-0.5 leading-relaxed">
                                    Mencegah instance task baru berjalan jika proses task sebelumnya masih aktif bekerja. Sangat dianjurkan untuk task yang memerlukan durasi eksekusi lama demi mencegah beban database dan server bertumpuk.
                                </p>
                            </div>
                        </div>

                        {{-- Checkbox 3: run_in_background --}}
                        <div class="flex items-start gap-3">
                            <div class="flex items-center h-5">
                                <input type="checkbox" id="add_run_in_background" name="run_in_background" value="1" class="form-checkbox rounded text-primary focus:ring-primary size-4">
                            </div>
                            <div>
                                <label for="add_run_in_background" class="font-semibold text-xs text-default-800 cursor-pointer">
                                    Jalankan di Latar Belakang (Run in Background)
                                </label>
                                <p class="text-2xs text-default-500 mt-0.5 leading-relaxed">
                                    Mengeksekusi task secara asinkron tanpa memblokir task scheduler lainnya yang dijadwalkan pada menit yang sama.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Notification Settings --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label for="add_notification_channel" class="form-label py-1 mb-0! font-semibold text-xs text-default-700">Kanal Notifikasi Kegagalan</label>
                            <select id="add_notification_channel" name="notification_channel" class="form-select text-xs">
                                <option value="none" selected>Tanpa Notifikasi (None)</option>
                                <option value="email">Email</option>
                                <option value="slack">Slack Webhook</option>
                            </select>
                        </div>
                        <div>
                            <label for="add_notification_recipient" class="form-label py-1 mb-0! font-semibold text-xs text-default-700">Penerima Notifikasi</label>
                            <input type="text" id="add_notification_recipient" name="notification_recipient" class="form-input text-xs" placeholder="Email atau URL Webhook Slack">
                            <small class="text-default-400 mt-1 block text-2xs">Diisi jika memilih kanal notifikasi saat eksekusi gagal.</small>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-default-200 dark:border-default-700">
                    <button type="button" class="btn border border-default-300 hover:bg-default-100 text-default-700 text-xs py-2 px-3 rounded inline-flex items-center gap-1" data-hs-overlay="#modal-add">
                        <i class="iconify tabler--x text-sm"></i>
                        Batal
                    </button>
                    <button type="submit" class="btn bg-primary hover:bg-primary-hover text-white text-xs py-2 px-4 rounded inline-flex items-center gap-1.5 shadow-sm">
                        <i class="iconify tabler--device-floppy text-sm"></i>
                        Simpan Task
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- END: Modal Add Scheduler Task --}}
