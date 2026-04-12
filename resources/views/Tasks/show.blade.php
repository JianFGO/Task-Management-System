<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Task</title>

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>

<div id="main-wrapper">

    <div class="nav-header">
        <div class="brand-logo">
            <a href="{{ url('/dashboard') }}">
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
                            <i class="icon-eye"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" value="View Task" readonly>
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
                    <a href="{{ url('/dashboard') }}">
                        <i class="icon-speedometer menu-icon"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('tasks.index') }}">
                        <i class="icon-list menu-icon"></i>
                        <span class="nav-text">All Tasks</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('tasks.create') }}">
                        <i class="icon-note menu-icon"></i>
                        <span class="nav-text">Create Task</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="content-body">
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div>
                                    <h3 class="mb-1">{{ $task->title }}</h3>
                                    <p class="mb-0">Task details</p>
                                </div>
                                <div>
                                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary">Edit Task</a>
                                    <a href="{{ route('tasks.index') }}" class="btn btn-light ml-2">Back</a>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h5>Description</h5>
                                <p>{{ $task->description ?: 'No description provided.' }}</p>
                            </div>

                            <div class="mb-4">
                                <h5>Priority</h5>
                                <span class="badge badge-info">{{ $task->priority }}</span>
                            </div>

                            <div class="mb-4">
                                <h5>Created</h5>
                                <p>{{ $task->created_at ? $task->created_at->format('d M Y, H:i') : 'N/A' }}</p>
                            </div>

                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Delete this task?')">
                                    Delete Task
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="copyright">
            <p>Copyright &copy; Task Management System</p>
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