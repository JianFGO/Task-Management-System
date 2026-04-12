<?php

use Illuminate\Support\Facades\Route;
use App\Models\Task;

Route::get('/', function () {
    $tasks = Task::latest()->get();

    return view('dashboard', [
        'tasks' => $tasks,
        'totalTasks' => Task::count(),
        'completedTasks' => 0,
        'pendingTasks' => 0,
        'overdueTasks' => 0,
    ]);
});

Route::get('/dashboard', function () {
    $tasks = Task::latest()->get();

    return view('dashboard', [
        'tasks' => $tasks,
        'totalTasks' => Task::count(),
        'completedTasks' => 0,
        'pendingTasks' => 0,
        'overdueTasks' => 0,
    ]);
});

Route::resource('tasks', App\Http\Controllers\TaskController::class);