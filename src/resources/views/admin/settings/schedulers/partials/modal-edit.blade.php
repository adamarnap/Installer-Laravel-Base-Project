{{-- Start: Modal Toggle --}}
<button type="button" id="modalEditToggle" data-modal-toggle="modalEdit" data-modal-target="modalEdit" class="hidden"></button>
{{-- End: Modal Toggle --}}

{{-- Start: Modal Content --}}
<div class="ui-modals">
    <div class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[1055] justify-center items-start sm:items-center flex-wrap w-full md:inset-0 h-[calc(100%-1rem)] max-h-full transition-all duration-300 ease-in-out p-4"
        id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
        <div class="modal-dialog w-full max-w-[800px] max-h-[calc(100vh-2rem)] modal-lg">
            <div class="modal-content max-h-[calc(100vh-2rem)] overflow-hidden">
                {{-- Start: Modal Header --}}
                <div class="modal-header">
                    <h4 class="modal-title" id="modalEditLabel">
                        Edit Task Scheduler
                    </h4>
                    <button type="button"
                        class="end-2.5 text-white bg-gray-500 hover:bg-danger hover:text-white rounded-full text-xs leading-normal size-5 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="modalEdit">
                        <i class="ti ti-x"></i>
                        <span class="sr-only">Tutup modal</span>
                    </button>
                </div>
                {{-- End: Modal Header --}}

                {{-- Start: Form Edit --}}
                <form id="form-edit" action="" method="POST">
                    @csrf
                    @method('PUT')
                    {{-- Start: Modal Body --}}
                    <div class="modal-body overflow-y-auto max-h-[calc(100vh-14rem)] space-y-4">
                        <div>
                            <label class="form-label">
                                Nama Task <strong class="text-red-500">*</strong>
                            </label>
                            <input type="text" name="name" id="edit-name" class="form-control" required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="form-label">
                                    Tipe Task <strong class="text-red-500">*</strong>
                                </label>
                                <select name="type" id="edit-type" class="form-control" required>
                                    @foreach(\App\Enums\Settings\SchedulerTypeEnum::cases() as $type)
                                        <option value="{{ $type->value }}">{{ $type->label() }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="form-label">
                                    Command / Target <strong class="text-red-500">*</strong>
                                </label>
                                <input type="text" name="command" id="edit-command" class="form-control font-mono" required>
                            </div>
                        </div>

                        <div>
                            <label class="form-label">
                                Cron Expression <strong class="text-red-500">*</strong>
                            </label>
                            <input type="text" name="expression" id="edit-expression" class="form-control font-mono" required>
                        </div>

                        <div>
                            <label class="form-label">Keterangan / Deskripsi</label>
                            <textarea name="description" id="edit-description" rows="2" class="form-control"></textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="form-label">Kanal Notifikasi Kegagalan</label>
                                <select name="notification_channel" id="edit-notification-channel" class="form-control">
                                    @foreach(\App\Enums\Settings\SchedulerNotificationEnum::cases() as $channel)
                                        <option value="{{ $channel->value }}">{{ $channel->label() }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="form-label">Penerima Notifikasi</label>
                                <input type="text" name="notification_recipient" id="edit-notification-recipient" class="form-control">
                            </div>
                        </div>

                        <div class="space-y-3 pt-3 border-t border-gray-100">
                            <div class="flex items-start gap-2.5">
                                <input type="checkbox" name="is_active" id="edit-is-active" value="1" class="mt-0.5 rounded border-borderColor text-primary focus:ring-primary">
                                <label for="edit-is-active" class="cursor-pointer">
                                    <span class="text-xs text-gray-800 font-semibold block">Aktifkan Task Scheduler ini</span>
                                    <span class="text-[11px] text-gray-500 block leading-tight">Jadwal akan otomatis dieksekusi secara periodik oleh sistem sesuai ekspresi cron.</span>
                                </label>
                            </div>
                            <div class="flex items-start gap-2.5">
                                <input type="checkbox" name="without_overlapping" id="edit-without-overlapping" value="1" class="mt-0.5 rounded border-borderColor text-primary focus:ring-primary">
                                <label for="edit-without-overlapping" class="cursor-pointer">
                                    <span class="text-xs text-gray-800 font-semibold block">Cegah Overlapping (Without Overlapping)</span>
                                    <span class="text-[11px] text-gray-500 block leading-tight">Mencegah task dijalankan kembali jika proses eksekusi task sebelumnya masih berjalan (menghindari duplikasi & beban berlebih).</span>
                                </label>
                            </div>
                            <div class="flex items-start gap-2.5">
                                <input type="checkbox" name="run_in_background" id="edit-run-in-background" value="1" class="mt-0.5 rounded border-borderColor text-primary focus:ring-primary">
                                <label for="edit-run-in-background" class="cursor-pointer">
                                    <span class="text-xs text-gray-800 font-semibold block">Jalankan di Background (Run In Background)</span>
                                    <span class="text-[11px] text-gray-500 block leading-tight">Mengeksekusi task di latar belakang secara paralel agar tidak menghambat atau memblokir antrean task scheduler lainnya.</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    {{-- End: Modal Body --}}

                    {{-- Start: Modal Footer --}}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-modal-hide="modalEdit">Batal</button>
                        <button type="submit" class="btn bg-primary text-white">Perbarui Task</button>
                    </div>
                    {{-- End: Modal Footer --}}
                </form>
                {{-- End: Form Edit --}}
            </div>
        </div>
    </div>
</div>
{{-- End: Modal Content --}}
