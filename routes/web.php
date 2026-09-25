<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\TaskController as AdminTaskController;
use App\Http\Controllers\Employee\DashboardController as EmployeeDashboardController;
use App\Http\Controllers\Employee\TaskController as EmployeeTaskController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', function () {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('employee.dashboard');
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    */

        Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
            Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
            Route::resource('projects', AdminProjectController::class);
            Route::resource('tasks', AdminTaskController::class);
        });

        /*
        |--------------------------------------------------------------------------
        | Employee Routes
        |--------------------------------------------------------------------------
        */

        Route::prefix('employee')->name('employee.')->group(function () {
            Route::get('/dashboard', [EmployeeDashboardController::class, 'index'])->name('dashboard');

            Route::get('/tasks', [EmployeeTaskController::class, 'index'])->name('tasks.index');

            Route::get('/tasks/{task}',[EmployeeTaskController::class, 'show'])->name('tasks.show');

            Route::patch('/tasks/{task}/status', [EmployeeTaskController::class, 'updateStatus'])->name('tasks.status');
        });
});

require __DIR__.'/auth.php';
