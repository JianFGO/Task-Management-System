<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Task</title>

    <!-- Use SAME styles as dashboard -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>

<div id="main-wrapper">

    <!-- HEADER -->
    <div class="nav-header">
        <div class="brand-logo">
            <a href="{{ url('/dashboard') }}">
                <span class="brand-title text-white" style="font-size: 20px; padding-left: 10px;">
                    Task Manager
                </span>
            </a>
        </div>
    </div>

    <!-- SIDEBAR -->
    <div class="nk-sidebar">
        <div class="nk-nav-scroll">
            <ul class="metismenu" id="menu">

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

    <!-- CONTENT -->
    <div class="content-body">
        <div class="container-fluid mt-3">

            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">

                            <h3 class="mb-4">Create New Task</h3>

                            <!-- ERRORS -->
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- FORM -->
                            <form method="POST" action="{{ route('tasks.store') }}">
                                @csrf

                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Priority</label>
                                    <select name="priority" class="form-control">
                                        <option value="0">Low</option>
                                        <option value="1">Medium</option>
                                        <option value="2">High</option>
                                        <option value="3">Urgent</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    Save Task
                                </button>

                                <a href="{{ route('tasks.index') }}" class="btn btn-light ml-2">
                                    Cancel
                                </a>

                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

<!-- JS (same as dashboard) -->
<script src="{{ asset('plugins/common/common.min.js') }}"></script>
<script src="{{ asset('js/custom.min.js') }}"></script>

</body>
</html>