<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'projects' => Project::count(),
            'tasks' => Task::count(),
            'pending_tasks' => Task::where('status','pending')->count(),
            'in_progress_tasks' => Task::where('status', 'in_progress')->count(),
            'completed_tasks' => Task::where('status', 'completed')->count(),
            'overdue_tasks' => Task::whereDate('due_date', '<',now()->toDateString())
                ->whereNotIn('status', ['completed', 'cancelled'])
                ->count(),
        ];

        $recentTasks = Task::with(['project','assignee']) ->latest()
            ->limit(10)
            ->get();

        return view('admin.dashboard',compact('stats', 'recentTasks'));
    }
}