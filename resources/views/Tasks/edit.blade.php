<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>

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
                            <i class="icon-pencil"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" value="Edit Task" readonly>
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

            @if($errors->any())
                <div class="alert alert-danger">
                    <strong>Please fix the following:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div>
                                    <h3 class="mb-1">Edit Task</h3>
                                    <p class="mb-0">Update task details</p>
                                </div>
                                <div>
                                    <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-info">View Task</a>
                                    <a href="{{ route('tasks.index') }}" class="btn btn-light ml-2">Back</a>
                                </div>
                            </div>

                            <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input
                                        type="text"
                                        name="title"
                                        id="title"
                                        class="form-control"
                                        value="{{ old('title', $task->title) }}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea
                                        name="description"
                                        id="description"
                                        class="form-control"
                                        rows="5"
                                    >{{ old('description', $task->description) }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="priority">Priority</label>
                                    <select name="priority" id="priority" class="form-control">
                                        <option value="0" {{ old('priority', $task->priority) == '0' ? 'selected' : '' }}>0 - Low</option>
                                        <option value="1" {{ old('priority', $task->priority) == '1' ? 'selected' : '' }}>1</option>
                                        <option value="2" {{ old('priority', $task->priority) == '2' ? 'selected' : '' }}>2</option>
                                        <option value="3" {{ old('priority', $task->priority) == '3' ? 'selected' : '' }}>3</option>
                                        <option value="4" {{ old('priority', $task->priority) == '4' ? 'selected' : '' }}>4</option>
                                        <option value="5" {{ old('priority', $task->priority) == '5' ? 'selected' : '' }}>5 - High</option>
                                    </select>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary">Update Task</button>
                                    <a href="{{ route('tasks.index') }}" class="btn btn-light ml-2">Cancel</a>
                                </div>
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