<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Services\Admin\Settings\AppsLogService;
use Illuminate\Http\Request;

class AppsLogController extends Controller
{
    public function __construct(protected AppsLogService $appsLogService)
    {
    }

    /**
     * Display a listing of log files.
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $this->setRule('settings-apps-log.read');

        if ($request->ajax()) {
            return $this->appsLogService->getLogFilesForDataTable();
        }

        $logFiles = $this->appsLogService->getLogFiles();

        return view('admin.settings.apps-log.index', compact('logFiles'));
    }

    /**
     * Display the specified log file details.
     *
     * @param Request $request
     * @param string $filename
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function show(Request $request, string $filename)
    {
        $this->setRule('settings-apps-log.read');

        if ($request->ajax()) {
            return $this->appsLogService->getLogEntriesForDataTable($filename, $request->all());
        }

        $logDetail = $this->appsLogService->getLogFileDetail($filename);

        if (!$logDetail['found']) {
            return redirect()->route('settings.apps-log.index')->withErrors(['error' => 'File log tidak ditemukan.']);
        }

        return view('admin.settings.apps-log.show', compact('logDetail', 'filename'));
    }

    /**
     * Remove the specified log file from storage.
     *
     * @param string $filename
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $filename)
    {
        $this->setRule('settings-apps-log.delete');

        return $this->appsLogService->deleteLogFile($filename);
    }
}
