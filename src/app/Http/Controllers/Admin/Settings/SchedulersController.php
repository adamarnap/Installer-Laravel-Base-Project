<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Settings\Schedulers\CreateRequest;
use App\Http\Requests\Admin\Settings\Schedulers\UpdateRequest;
use App\Http\Services\Admin\Settings\SchedulersService;
use Illuminate\Http\Request;

class SchedulersController extends Controller
{
    public function __construct(protected SchedulersService $schedulersService)
    {
    }

    /**
     * Display a listing of registered schedulers, monitoring info, and execution logs.
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $this->setRule('settings-schedulers.read');

        if ($request->ajax()) {
            if ($request->input('type') === 'logs') {
                return $this->schedulersService->getSchedulerLogsForDataTable();
            }

            return $this->schedulersService->getSchedulersForDataTable();
        }

        $tasks = $this->schedulersService->getScheduledTasks();
        $monitoring = $this->schedulersService->getMonitoringStatus();
        $stats = $this->schedulersService->getSchedulerStats();

        return view('admin.settings.schedulers.index', compact('tasks', 'monitoring', 'stats'));
    }

    /**
     * Store a newly created scheduled task.
     *
     * @param CreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateRequest $request)
    {
        $this->setRule('settings-schedulers.create');

        return $this->schedulersService->storeTask($request->validated());
    }

    /**
     * Display the specified scheduled task details for editing.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $this->setRule('settings-schedulers.read');

        $task = $this->schedulersService->getTaskById($id);

        return response()->json($task);
    }

    /**
     * Update the specified scheduled task in storage.
     *
     * @param UpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, int $id)
    {
        $this->setRule('settings-schedulers.update');

        return $this->schedulersService->updateTask($id, $request->validated());
    }

    /**
     * Remove the specified scheduled task from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        $this->setRule('settings-schedulers.delete');

        return $this->schedulersService->deleteTask($id);
    }

    /**
     * Run a scheduled task immediately.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function run(Request $request)
    {
        $this->setRule('settings-schedulers.update');

        $request->validate([
            'source' => 'nullable|string|in:kernel,db',
            'task_index' => 'nullable',
            'task_id' => 'nullable|integer',
        ]);

        $source = $request->input('source', 'kernel');
        $identifier = $source === 'db' ? (int) $request->input('task_id') : (int) $request->input('task_index', 0);

        return $this->schedulersService->runTask($identifier, $source);
    }
}

