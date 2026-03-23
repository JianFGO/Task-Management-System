<!DOCTYPE html>
<html lang="en">
<head>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 40px;
        background-color: #f8f9fa;
    }

    h1 {
        color: #333;
    }

    a {
        color: #007bff;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    form {
        background: white;
        padding: 20px;
        border-radius: 8px;
        max-width: 400px;
    }

    input, textarea, select {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
    }

    button {
        margin-top: 10px;
        padding: 10px;
        background: #007bff;
        color: white;
        border: none;
        cursor: pointer;
    }

    ul {
        background: white;
        padding: 15px;
        border-radius: 8px;
    }
</style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>
</head>
<body>
    <h1>Task List</h1>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <p><a href="{{ route('tasks.create') }}">Add New Task</a></p>

    @if($tasks->count())
        <ul>
            @foreach($tasks as $task)
                <li>
                    <strong>{{ $task->title }}</strong>
                    - Priority: {{ $task->priority }}
                    @if($task->description)
                        <br>{{ $task->description }}
                    @endif
                </li>
            @endforeach
        </ul>
    @else
        <p>No tasks yet.</p>
    @endif
</body>
</html>