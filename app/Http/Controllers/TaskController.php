<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use Illuminate\Http\Request;
use App\Models\TaskStatus;
use App\Models\Task;
use App\Models\User;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $tasks = Task::paginate(15);
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $task = new Task();
        $taskStatuses = TaskStatus::all();
        $users = User::all();
        return view('tasks.create', compact('task', 'taskStatuses', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $validated = $request->validated();
        $task = new Task();
        $task->fill($validated);
        $task->created_by_id = auth()->id();
        $task->save();
        flash('Задача успешно создана')->success();
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::find($id);
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::findOrFail($id);
        $taskStatuses = TaskStatus::all();
        $users = User::all();
        return view('tasks.edit', compact('task', 'taskStatuses', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, string $id)
    {
        $task = Task::find($id);
        $validated = $request->validated();
        $task->fill($validated);
        $task->save();
        flash('Задача успешно обновлена')->success();
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        try {
            $task->delete();
            flash('Задача успешно удалёна')->success();
            return redirect()->route('tasks.index');
        } catch (\Exception $e) {
            flash('Не удалось удалить задачу')->error();
            return redirect()->back()->withInput();
        }
    }
}
