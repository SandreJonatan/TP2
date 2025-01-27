@extends('layouts.app')

@section('title', 'Add Task')

@section('content')
<div class="container">
    <h1>Add a Task</h1>
    <form method="POST" action="{{ route('tasks.store', $project) }}">
        @csrf
        <div>
            <label for="title">Task Title:</label>
            <input type="text" name="title" id="title" required>
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description"></textarea>
        </div>
        <div>
            <label for="status">Status:</label>
            <select name="status" id="status" required>
                <option value="Pending">Pending</option>
                <option value="In Progress">In Progress</option>
                <option value="Completed">Completed</option>
            </select>
        </div>
        <button type="submit">Add Task</button>
    </form>
</div>
@endsection
