<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <meta name="theme-name" content="quixlab" />

    <title>Task Manager Dashboard</title>

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>

    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>

    <div id="main-wrapper">

        <div class="nav-header">
            <div class="brand-logo">
                <a href="{{ url('/dashboard') }}">
                    <b class="logo-abbr">
                        <img src="{{ asset('images/logo.png') }}" alt="">
                    </b>
                    <span class="logo-compact">
                        <img src="{{ asset('images/logo-compact.png') }}" alt="">
                    </span>
                    <span class="brand-title text-white" style="font-size: 20px; font-weight: 600; padding-left: 10px;">
                        Task Manager
                    </span>
                </a>
            </div>
        </div>

        <div class="header">
            <div class="header-content clearfix">

                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>

                <div class="header-left">
                    <div class="input-group icons">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-transparent border-0 pr-2 pr-sm-3">
                                <i class="mdi mdi-clipboard-text"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" placeholder="Task Management Dashboard" readonly>
                    </div>
                </div>

                <div class="header-right">
                    <ul class="clearfix">
                        <li class="icons dropdown d-none d-md-flex">
                            <a href="javascript:void(0)" class="log-user">
                                <span>Welcome</span>
                            </a>
                        </li>
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative">
                                <span class="activity active"></span>
                                <img src="{{ asset('images/user/1.png') }}" height="40" width="40" alt="">
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="nk-sidebar">
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">

                    <li class="nav-label">Main</li>

                    <li>
                        <a href="{{ url('/dashboard') }}" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('tasks.index') }}" aria-expanded="false">
                            <i class="icon-list menu-icon"></i>
                            <span class="nav-text">All Tasks</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('tasks.create') }}" aria-expanded="false">
                            <i class="icon-note menu-icon"></i>
                            <span class="nav-text">Create Task</span>
                        </a>
                    </li>

                    <li class="nav-label">Quick Links</li>

                    <li>
                        <a href="{{ url('/') }}" aria-expanded="false">
                            <i class="icon-home menu-icon"></i>
                            <span class="nav-text">Home</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>

        <div class="content-body">
            <div class="container-fluid mt-3">

                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-1">
                            <div class="card-body">
                                <h3 class="card-title text-white">Total Tasks</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{ $totalTasks ?? 0 }}</h2>
                                    <p class="text-white mb-0">All recorded tasks</p>
                                </div>
                                <span class="float-right display-5 opacity-5">
                                    <i class="fa fa-tasks"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-2">
                            <div class="card-body">
                                <h3 class="card-title text-white">Completed Tasks</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{ $completedTasks ?? 0 }}</h2>
                                    <p class="text-white mb-0">Tasks marked complete</p>
                                </div>
                                <span class="float-right display-5 opacity-5">
                                    <i class="fa fa-check-circle"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-3">
                            <div class="card-body">
                                <h3 class="card-title text-white">Pending Tasks</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{ $pendingTasks ?? 0 }}</h2>
                                    <p class="text-white mb-0">Still awaiting action</p>
                                </div>
                                <span class="float-right display-5 opacity-5">
                                    <i class="fa fa-clock-o"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-4">
                            <div class="card-body">
                                <h3 class="card-title text-white">Overdue Tasks</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{ $overdueTasks ?? 0 }}</h2>
                                    <p class="text-white mb-0">Past due date</p>
                                </div>
                                <span class="float-right display-5 opacity-5">
                                    <i class="fa fa-exclamation-circle"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div>
                                        <h4 class="mb-1">Task Overview</h4>
                                        <p class="mb-0">Summary of the current task management system</p>
                                    </div>
                                    <div>
                                        <a href="{{ route('tasks.create') }}" class="btn btn-primary">
                                            Add New Task
                                        </a>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Status</th>
                                                <th>Due Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($tasks ?? [] as $task)
                                                <tr>
                                                    <td>{{ $task->title ?? 'Untitled Task' }}</td>
                                                    <td>
                                                        @php
                                                            $status = strtolower($task->status ?? 'pending');
                                                            $badgeClass = 'badge-warning';

                                                            if ($status === 'completed') {
                                                                $badgeClass = 'badge-success';
                                                            } elseif ($status === 'pending') {
                                                                $badgeClass = 'badge-warning';
                                                            } elseif ($status === 'overdue') {
                                                                $badgeClass = 'badge-danger';
                                                            }
                                                        @endphp

                                                        <span class="badge {{ $badgeClass }}">
                                                            {{ ucfirst($task->status ?? 'pending') }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $task->due_date ?? 'No due date' }}</td>
                                                    <td>
                                                        <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-sm btn-info">View</a>
                                                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center">No tasks found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Quick Actions</h4>

                                <div class="mb-3">
                                    <a href="{{ route('tasks.create') }}" class="btn btn-primary btn-block">
                                        Create New Task
                                    </a>
                                </div>

                                <div class="mb-3">
                                    <a href="{{ route('tasks.index') }}" class="btn btn-outline-primary btn-block">
                                        View All Tasks
                                    </a>
                                </div>

                                <hr>

                                <h5 class="mb-3">System Notes</h5>
                                <ul class="pl-3 mb-0">
                                    <li>Total tasks are shown at the top of the page.</li>
                                    <li>Use the sidebar to access task pages.</li>
                                    <li>Use the action buttons to view or edit each task.</li>
                                </ul>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body px-0">
                                <h4 class="card-title px-4 mb-3">Recent Task Status</h4>
                                <div class="todo-list">
                                    <div class="tdl-holder">
                                        <div class="tdl-content">
                                            <ul id="todo_list">
                                                <li>
                                                    <label>
                                                        <input type="checkbox" {{ ($completedTasks ?? 0) > 0 ? 'checked' : '' }} disabled>
                                                        <i></i>
                                                        <span>Completed tasks recorded</span>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label>
                                                        <input type="checkbox" {{ ($pendingTasks ?? 0) == 0 ? 'checked' : '' }} disabled>
                                                        <i></i>
                                                        <span>Pending tasks reviewed</span>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label>
                                                        <input type="checkbox" {{ ($overdueTasks ?? 0) == 0 ? 'checked' : '' }} disabled>
                                                        <i></i>
                                                        <span>Overdue tasks cleared</span>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label>
                                                        <input type="checkbox" disabled>
                                                        <i></i>
                                                        <span>Use "Create Task" to add more work items</span>
                                                    </label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Task Management Information</h4>
                                <p class="mb-2">
                                    This dashboard provides an overview of task records stored in the system.
                                </p>
                                <p class="mb-0">
                                    Use the navigation menu to create, view, edit, and manage tasks efficiently.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="footer">
            <div class="copyright">
                <p>
                    Copyright &copy; Task Management System
                </p>
            </div>
        </div>

    </div>

    <script src="{{ asset('plugins/common/common.min.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('js/settings.js') }}"></script>
    <script src="{{ asset('js/gleek.js') }}"></script>
    <script src="{{ asset('js/styleSwitcher.js') }}"></script>
</body>
</html>