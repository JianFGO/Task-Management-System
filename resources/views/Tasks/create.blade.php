<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Task</title>

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                            <i class="icon-note"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" value="Create Task" readonly>
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

            <div id="ai-error-box" class="alert alert-danger d-none"></div>

            <div class="row">
                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div>
                                    <h3 class="mb-1">Create New Task</h3>
                                    <p class="mb-0">Add a new task to the system</p>
                                </div>
                                <div>
                                    <a href="{{ route('tasks.index') }}" class="btn btn-outline-primary">
                                        View All Tasks
                                    </a>
                                </div>
                            </div>

                            <div class="card mb-4 border">
                                <div class="card-body">
                                    <h5 class="mb-3">AI Task Assistant</h5>
                                    <p class="mb-3">Describe your goal and let AI suggest a task title, description, and priority.</p>

                                    <div class="form-group">
                                        <label for="ai_goal">What are you trying to do?</label>
                                        <textarea
                                            id="ai_goal"
                                            class="form-control"
                                            rows="4"
                                            placeholder="Example: I need to prepare for my group presentation next week."
                                        ></textarea>
                                    </div>

                                    <button type="button" class="btn btn-primary" id="generate-ai-task">
                                        Generate with AI
                                    </button>
                                    <span id="ai-loading" class="ml-3 d-none">Generating...</span>
                                </div>
                            </div>

                            <form method="POST" action="{{ route('tasks.store') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input
                                        type="text"
                                        name="title"
                                        id="title"
                                        class="form-control"
                                        value="{{ old('title') }}"
                                        placeholder="Enter task title"
                                    >
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea
                                        name="description"
                                        id="description"
                                        class="form-control"
                                        rows="5"
                                        placeholder="Enter task description"
                                    >{{ old('description') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="priority">Priority</label>
                                    <select name="priority" id="priority" class="form-control">
                                        <option value="0" {{ old('priority') == '0' ? 'selected' : '' }}>0 - Low</option>
                                        <option value="1" {{ old('priority') == '1' ? 'selected' : '' }}>1</option>
                                        <option value="2" {{ old('priority') == '2' ? 'selected' : '' }}>2</option>
                                        <option value="3" {{ old('priority') == '3' ? 'selected' : '' }}>3</option>
                                        <option value="4" {{ old('priority') == '4' ? 'selected' : '' }}>4</option>
                                        <option value="5" {{ old('priority') == '5' ? 'selected' : '' }}>5 - High</option>
                                    </select>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        Save Task
                                    </button>

                                    <a href="{{ route('tasks.index') }}" class="btn btn-light ml-2">
                                        Cancel
                                    </a>
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const button = document.getElementById('generate-ai-task');
    const loading = document.getElementById('ai-loading');
    const goalInput = document.getElementById('ai_goal');
    const errorBox = document.getElementById('ai-error-box');

    const titleInput = document.getElementById('title');
    const descriptionInput = document.getElementById('description');
    const priorityInput = document.getElementById('priority');

    button.addEventListener('click', async function () {
        const goal = goalInput.value.trim();
        errorBox.classList.add('d-none');
        errorBox.textContent = '';

        if (!goal) {
            errorBox.textContent = 'Please describe your goal first.';
            errorBox.classList.remove('d-none');
            return;
        }

        button.disabled = true;
        loading.classList.remove('d-none');

        try {
            const response = await fetch('{{ route('ai.suggest-task') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ goal })
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.error || 'AI request failed.');
            }

            titleInput.value = data.title ?? '';
            descriptionInput.value = data.description ?? '';
            priorityInput.value = String(data.priority ?? '0');
        } catch (error) {
            errorBox.textContent = error.message || 'Something went wrong.';
            errorBox.classList.remove('d-none');
        } finally {
            button.disabled = false;
            loading.classList.add('d-none');
        }
    });
});
</script>

</body>
</html>