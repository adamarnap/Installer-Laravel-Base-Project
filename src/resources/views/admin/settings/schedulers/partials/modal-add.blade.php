{{-- Start: Modal Content --}}
<div class="ui-modals">
    <div class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[1055] justify-center items-start sm:items-center flex-wrap w-full md:inset-0 h-[calc(100%-1rem)] max-h-full transition-all duration-300 ease-in-out p-4"
        id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
        <div class="modal-dialog w-full max-w-[800px] max-h-[calc(100vh-2rem)] modal-lg">
            <div class="modal-content max-h-[calc(100vh-2rem)] overflow-hidden">
                {{-- Start: Modal Header --}}
                <div class="modal-header">
                    <h4 class="modal-title" id="modalAddLabel">
                        Tambah Task Scheduler Baru
                    </h4>
                    <button type="button"
                        class="end-2.5 text-white bg-gray-500 hover:bg-danger hover:text-white rounded-full text-xs leading-normal size-5 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="modalAdd">
                        <i class="ti ti-x"></i>
                        <span class="sr-only">Tutup modal</span>
                    </button>
                </div>
                {{-- End: Modal Header --}}

                {{-- Start: Form Add --}}
                <form action="{{ route('settings.schedulers.store') }}" method="POST">
                    @csrf
                    {{-- Start: Modal Body --}}
                    <div class="modal-body overflow-y-auto max-h-[calc(100vh-14rem)] space-y-4">
                        <div>
                            <label class="form-label">
                                Nama Task <strong class="text-red-500">*</strong>
                            </label>
                            <input type="text" name="name" class="form-control" required placeholder="Contoh: Pembersihan Cache Harian">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="form-label">
                                    Tipe Task <strong class="text-red-500">*</strong>
                                </label>
                                <select name="type" class="form-control" required>
                                    @foreach(\App\Enums\Settings\SchedulerTypeEnum::cases() as $type)
                                        <option value="{{ $type->value }}">{{ $type->label() }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="form-label">
                                    Command / Target <strong class="text-red-500">*</strong>
                                </label>
                                <input type="text" name="command" class="form-control font-mono" required placeholder="Contoh: cache:clear atau inspire">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="form-label">Preset Interval</label>
                                <select id="preset-interval-select" class="form-control">
                                    <option value="* * * * *">Setiap Menit (* * * * *)</option>
                                    <option value="*/5 * * * *">Setiap 5 Menit (*/5 * * * *)</option>
                                    <option value="0 * * * *">Setiap Jam (0 * * * *)</option>
                                    <option value="0 0 * * *">Setiap Hari (0 0 * * *)</option>
                                    <option value="0 0 * * 0">Setiap Minggu (0 0 * * 0)</option>
                                    <option value="0 0 1 * *">Setiap Bulan (0 0 1 * *)</option>
                                    <option value="custom">Kustom Cron Expression</option>
                                </select>
                            </div>
                            <div>
                                <label class="form-label">
                                    Cron Expression <strong class="text-red-500">*</strong>
                                </label>
                                <input type="text" name="expression" id="cron-expression-input" value="* * * * *" class="form-control font-mono" required placeholder="* * * * *">
                            </div>
                        </div>

                        <div>
                            <label class="form-label">Keterangan / Deskripsi</label>
                            <textarea name="description" rows="2" class="form-control" placeholder="Deskripsi singkat fungsi task ini..."></textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="form-label">Kanal Notifikasi Kegagalan</label>
                                <select name="notification_channel" class="form-control">
                                    @foreach(\App\Enums\Settings\SchedulerNotificationEnum::cases() as $channel)
                                        <option value="{{ $channel->value }}">{{ $channel->label() }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="form-label">Penerima Notifikasi (Email/Webhook)</label>
                                <input type="text" name="notification_recipient" class="form-control" placeholder="admin@example.com atau https://hooks.slack.com/...">
                            </div>
                        </div>

                        <div class="space-y-3 pt-3 border-t border-gray-100">
                            <div class="flex items-start gap-2.5">
                                <input type="checkbox" id="add-is-active" name="is_active" value="1" checked class="mt-0.5 rounded border-borderColor text-primary focus:ring-primary">
                                <label for="add-is-active" class="cursor-pointer">
                                    <span class="text-xs text-gray-800 font-semibold block">Aktifkan Task Scheduler ini</span>
                                    <span class="text-[11px] text-gray-500 block leading-tight">Jadwal akan otomatis dieksekusi secara periodik oleh sistem sesuai ekspresi cron.</span>
                                </label>
                            </div>
                            <div class="flex items-start gap-2.5">
                                <input type="checkbox" id="add-without-overlapping" name="without_overlapping" value="1" class="mt-0.5 rounded border-borderColor text-primary focus:ring-primary">
                                <label for="add-without-overlapping" class="cursor-pointer">
                                    <span class="text-xs text-gray-800 font-semibold block">Cegah Overlapping (Without Overlapping)</span>
                                    <span class="text-[11px] text-gray-500 block leading-tight">Mencegah task dijalankan kembali jika proses eksekusi task sebelumnya masih berjalan (menghindari duplikasi & beban berlebih).</span>
                                </label>
                            </div>
                            <div class="flex items-start gap-2.5">
                                <input type="checkbox" id="add-run-in-background" name="run_in_background" value="1" class="mt-0.5 rounded border-borderColor text-primary focus:ring-primary">
                                <label for="add-run-in-background" class="cursor-pointer">
                                    <span class="text-xs text-gray-800 font-semibold block">Jalankan di Background (Run In Background)</span>
                                    <span class="text-[11px] text-gray-500 block leading-tight">Mengeksekusi task di latar belakang secara paralel agar tidak menghambat atau memblokir antrean task scheduler lainnya.</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    {{-- End: Modal Body --}}

                    {{-- Start: Modal Footer --}}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-modal-hide="modalAdd">Batal</button>
                        <button type="submit" class="btn bg-primary text-white">Simpan Task</button>
                    </div>
                    {{-- End: Modal Footer --}}
                </form>
                {{-- End: Form Add --}}
            </div>
        </div>
    </div>
</div>
{{-- End: Modal Content --}}
