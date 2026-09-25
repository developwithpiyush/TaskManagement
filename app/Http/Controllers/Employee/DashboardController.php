<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $userId = auth()->id();

        $stats = [
            'total' => Task::where('assigned_to', $userId)->count(),

            'pending' => Task::where('assigned_to', $userId)
                ->where('status', 'pending')
                ->count(),

            'in_progress' => Task::where('assigned_to', $userId)
                ->where('status', 'in_progress')
                ->count(),

            'completed' => Task::where('assigned_to', $userId)
                ->where('status', 'completed')
                ->count(),
        ];

        return view('employee.dashboard', compact('stats'));
    }
}