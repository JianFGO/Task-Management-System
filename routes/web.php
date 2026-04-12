<?php

use Illuminate\Support\Facades\Route;
use App\Models\Task;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AiTaskController;

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

Route::post('/ai/suggest-task', [AiTaskController::class, 'suggest'])->name('ai.suggest-task');

Route::resource('tasks', TaskController::class);