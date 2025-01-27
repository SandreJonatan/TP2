@extends('layouts.app')

@section('title', 'Create Project')

@section('content')
<div class="container">
    <h1>Create a New Project</h1>
    <form method="POST" action="{{ route('projects.store') }}">
        @csrf
        <div>
            <label for="name">Project Name:</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description"></textarea>
        </div>
        <div>
            <label for="deadline">Deadline:</label>
            <input type="date" name="deadline" id="deadline" required>
        </div>
        <button type="submit">Save Project</button>
    </form>
</div>
@endsection
