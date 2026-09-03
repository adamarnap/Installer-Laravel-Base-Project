<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Services\Admin\Settings\QueuesService;
use Illuminate\Http\Request;

class QueuesController extends Controller
{
    public function __construct(protected QueuesService $queuesService)
    {
    }

    /**
     * Display a listing of queue jobs and statistics.
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $this->setRule('settings-queues.read');

        if ($request->ajax()) {
            $type = $request->input('type', 'pending');
            if ($type === 'failed') {
                return $this->queuesService->getFailedJobsForDataTable();
            }
            return $this->queuesService->getPendingJobsForDataTable();
        }

        $stats = $this->queuesService->getQueueStats();

        return view('admin.settings.queues.index', compact('stats'));
    }

    /**
     * Retry a specific failed job.
     *
     * @param string|int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function retry($id)
    {
        $this->setRule('settings-queues.update');

        return $this->queuesService->retryJob($id);
    }

    /**
     * Retry all failed jobs.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function retryAll()
    {
        $this->setRule('settings-queues.update');

        return $this->queuesService->retryAllFailedJobs();
    }

    /**
     * Forget/Delete a specific failed job.
     *
     * @param string|int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forget($id)
    {
        $this->setRule('settings-queues.delete');

        return $this->queuesService->forgetJob($id);
    }

    /**
     * Flush all failed jobs.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function flush()
    {
        $this->setRule('settings-queues.delete');

        return $this->queuesService->flushFailedJobs();
    }

    /**
     * Clear pending jobs from queue.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clear(Request $request)
    {
        $this->setRule('settings-queues.delete');

        return $this->queuesService->clearQueue($request->input('queue'));
    }
}
