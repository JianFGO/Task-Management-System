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
    <title>Create Task</title>
</head>
<body>
    <h1>Create Task</h1>

    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf

        <div>
            <label for="title">Title</label><br>
            <input type="text" name="title" id="title" value="{{ old('title') }}">
        </div>

        <br>

        <div>
            <label for="description">Description</label><br>
            <textarea name="description" id="description">{{ old('description') }}</textarea>
        </div>

        <br>

        <div>
            <label for="priority">Priority</label><br>
            <select name="priority" id="priority">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>

        <br>

        <button type="submit">Save Task</button>
    </form>

    <br>
    <a href="{{ route('tasks.index') }}">Back to task list</a>
</body>
</html>