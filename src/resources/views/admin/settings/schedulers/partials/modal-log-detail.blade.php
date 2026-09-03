{{-- START: Modal Scheduler Log Detail --}}
<div id="modal-scheduler-log" class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="modal-scheduler-log-title">
    <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all max-w-3xl w-full m-3 sm:mx-auto">
        <div class="flex flex-col bg-white border border-default-200 shadow-sm rounded-xl pointer-events-auto dark:bg-default-800 dark:border-default-700">
            <div class="flex justify-between items-center py-3 px-4 border-b border-default-200 dark:border-default-700">
                <div class="flex items-center gap-2">
                    <i class="iconify tabler--history text-primary text-xl"></i>
                    <h3 id="modal-scheduler-log-title" class="font-bold text-default-800 dark:text-white">
                        Detail Riwayat Eksekusi Scheduler
                    </h3>
                </div>
                <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-default-100 text-default-800 hover:bg-default-200 focus:outline-none dark:bg-default-700 dark:hover:bg-default-600 dark:text-default-400" data-hs-overlay="#modal-scheduler-log">
                    <span class="sr-only">Close</span>
                    <i class="iconify tabler--x text-base"></i>
                </button>
            </div>

            <div class="p-4 overflow-y-auto max-h-[75vh] space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 bg-default-50 p-3 rounded-lg border border-default-200">
                    <div>
                        <span class="text-2xs text-default-500 font-semibold uppercase block">Nama Task</span>
                        <span id="log-task-name" class="font-bold text-xs text-default-800"></span>
                    </div>
                    <div>
                        <span class="text-2xs text-default-500 font-semibold uppercase block">Perintah (Command)</span>
                        <span id="log-command" class="font-mono text-xs text-default-700"></span>
                    </div>
                    <div>
                        <span class="text-2xs text-default-500 font-semibold uppercase block">Status Eksekusi</span>
                        <span id="log-status-badge"></span>
                    </div>
                    <div>
                        <span class="text-2xs text-default-500 font-semibold uppercase block">Waktu & Durasi</span>
                        <span id="log-time-duration" class="font-mono text-xs text-default-700"></span>
                    </div>
                </div>

                <div id="log-output-section">
                    <label class="form-label font-bold text-xs uppercase text-default-700">Output Console / Artisan:</label>
                    <pre id="log-output" class="bg-slate-900 text-slate-100 p-3 rounded text-xs font-mono break-all whitespace-pre-wrap max-h-56 overflow-y-auto border border-slate-800"></pre>
                </div>

                <div id="log-error-section" class="hidden">
                    <label class="form-label font-bold text-xs uppercase text-danger">Pesan Kesalahan (Error Message):</label>
                    <pre id="log-error" class="bg-red-50 text-red-700 p-3 rounded text-xs font-mono break-all whitespace-pre-wrap max-h-56 overflow-y-auto border border-red-200"></pre>
                </div>
            </div>

            <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-default-200 dark:border-default-700">
                <button type="button" class="btn border border-default-300 hover:bg-default-100 text-default-700 text-xs py-2 px-4 rounded inline-flex items-center gap-1" data-hs-overlay="#modal-scheduler-log">
                    <i class="iconify tabler--x text-sm"></i>
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
{{-- END: Modal Scheduler Log Detail --}}
