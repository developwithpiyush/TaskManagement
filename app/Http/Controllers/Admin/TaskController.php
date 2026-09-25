<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index(Request $request): View
    {
        $query = Task::with(['project', 'assignee', 'creator']);

        if ($request->filled('search')) {
            $search = $request->string('search')->toString();

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description','like', "%{$search}%");
            });
        }

        if ($request->filled('project_id')) {
            $query->where('project_id',$request->integer('project_id'));
        }

        if ($request->filled('assigned_to')) {
            $query->where('assigned_to', $request->integer('assigned_to'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->string('status')->toString());
        }

        if ($request->filled('priority')) {
            $query->where('priority', $request->string('priority')->toString());
        }

        $tasks = $query->latest() ->paginate(10)->withQueryString();

        $projects = Project::orderBy('name')->get(['id', 'name',]);

        $employees = User::where('role', 'employee')
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('admin.tasks.index',compact('tasks', 'projects', 'employees'));
    }

    public function create(): View
    {
        $projects = Project::where('status', 'active')
            ->orderBy('name')
            ->get();

        $employees = User::where('role', 'employee')
            ->orderBy('name')
            ->get();

        return view( 'admin.tasks.create', compact('projects', 'employees'));
    }

    public function store(StoreTaskRequest $request): RedirectResponse 
    {
        Task::create([
            ...$request->validated(),
            'created_by' => auth()->id(),
        ]);

        return redirect()
            ->route('admin.tasks.index')
            ->with('success', 'Task created successfully.');
    }

    public function show(Task $task): View
    {
        $task->load(['project', 'assignee', 'creator']);

        return view('admin.tasks.show', compact('task'));
    }

    public function edit(Task $task): View
    {
        $projects = Project::orderBy('name')->get();

        $employees = User::where('role', 'employee')
            ->orderBy('name')
            ->get();

        return view('admin.tasks.edit', compact('task', 'projects', 'employees'));
    }

    public function update(UpdateTaskRequest $request,Task $task): RedirectResponse 
    {
        $task->update(
            $request->validated()
        );

        return redirect()->route('admin.tasks.index')
            ->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return redirect()
            ->route('admin.tasks.index')
            ->with('success', 'Task deleted successfully.');
    }
}