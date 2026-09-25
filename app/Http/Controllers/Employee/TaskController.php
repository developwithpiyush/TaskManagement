<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index(Request $request): View
    {
        $query = Task::with('project')->where('assigned_to', auth()->id());

        if ($request->filled('status')) {
            $query->where('status', $request->string('status')->toString());
        }

        if ($request->filled('priority')) {
            $query->where('priority', $request->string('priority')->toString());
        }

        if ($request->filled('search')) {
            $search = $request->string('search')->toString();

            $query->where(function ($q) use ($search) {
                $q->where( 'title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%"
                );
            });
        }

        $tasks = $query->latest()
            ->paginate(10)
            ->withQueryString();

        return view('employee.tasks.index', compact('tasks'));
    }

    public function show(Task $task): View
    {
        $this->authorize('view', $task);

        $task->load(['project', 'creator']);

        return view('employee.tasks.show', compact('task'));
    }

    public function updateStatus(Request $request, Task $task): JsonResponse 
    {
        $this->authorize('update', $task);

        $validated = $request->validate([
            'status' => ['required', 'in:pending,in_progress,completed,cancelled'],
        ]);

        $task->update([
            'status' => $validated['status'],
        ]);

        return response()->json([
            'message' => 'Task status updated successfully.',
            'data' => [
                'id' => $task->id,
                'status' => $task->status,
            ],
        ]);
    }
}