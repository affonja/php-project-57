<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStatusRequest;
use App\Models\TaskStatus;
use Illuminate\Http\Request;

class TaskStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $taskStatuses = TaskStatus::all();
        return view('taskStatuses.index', compact('taskStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('taskStatuses.create', ['taskStatus' => new TaskStatus()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskStatusRequest $request)
    {
        $this->saveTaskStatus(new TaskStatus(), $request);
        flash('Статус успешно создан')->success();
        return redirect()->route('task_statuses.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(TaskStatus $taskStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskStatus $taskStatus)
    {
        return view('taskStatuses.edit', compact('taskStatus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskStatusRequest $request, TaskStatus $taskStatus)
    {
        $this->saveTaskStatus($taskStatus, $request);
        flash('Статус успешно обновлен')->success();
        return redirect()->route('task_statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskStatus $taskStatus)
    {
        try {
            $taskStatus->delete();
            flash('Статус успешно удалён')->success();
        } catch (\Exception $e) {
            flash('Не удалось удалить статус')->error();
        }
        return redirect()->route('task_statuses.index');
    }

    /**
     * Save the task status to the database.
     */
    private function saveTaskStatus(TaskStatus $taskStatus, TaskStatusRequest $request)
    {
        $validated = $request->validated();
        $taskStatus->fill($validated);
        $taskStatus->save();
    }
}
