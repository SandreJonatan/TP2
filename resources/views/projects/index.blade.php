@extends('layouts.app')

@section('title', 'Projects List')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-4">Projects</h1>
    
    <!-- Form Pencarian -->
    <form method="GET" action="{{ route('projects.index') }}" class="mb-6 flex space-x-4">
        <input 
            type="text" 
            name="search" 
            placeholder="Search projects" 
            value="{{ request('search') }}"
            class="w-full border-gray-300 rounded-lg shadow-sm"
        >
        <button 
            type="submit" 
            class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700">
            Search
        </button>
    </form>

    <a href="{{ route('projects.create') }}" class="inline-block mb-6 bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700">
        Add Project
    </a>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($projects as $project)
            <div class="bg-gray-100 shadow rounded-lg p-4">
                <h3 class="text-lg font-bold">{{ $project->name }}</h3>
                <p class="text-gray-700">{{ $project->description }}</p>
                <p class="text-gray-500 text-sm">Deadline: {{ $project->deadline }}</p>
                <p class="mt-2">
                    Progress: 
                    <span class="font-bold">
                        {{ $project->tasks->count() > 0 
                            ? round(($project->tasks->where('status', 'Completed')->count() / $project->tasks->count()) * 100, 2) 
                            : 0 
                        }}%
                    </span>
                </p>

                <!-- Diagram Progress -->
                @if ($project->tasks->count() > 0)
                    <canvas id="chart-{{ $project->id }}" width="400" height="200" class="mt-4"></canvas>
                @else
                    <p class="text-sm text-gray-500 mt-4">No tasks available to display progress.</p>
                @endif

                <!-- Form Tambah Tugas -->
                <form method="POST" action="{{ route('tasks.store', $project) }}" class="mt-4">
                    @csrf
                    <div class="space-y-2">
                        <input 
                            type="text" 
                            name="title" 
                            placeholder="Task Title" 
                            class="w-full border-gray-300 rounded-lg shadow-sm"
                            required
                        >
                        <select 
                            name="status" 
                            class="w-full border-gray-300 rounded-lg shadow-sm"
                            required
                        >
                            <option value="Pending">Pending</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Completed">Completed</option>
                        </select>
                        <button 
                            type="submit" 
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700">
                            Add Task
                        </button>
                    </div>
                </form>
            </div>
        @endforeach
    </div>
</div>

<!-- Script untuk Diagram Chart.js -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        @foreach($projects as $project)
        new Chart(document.getElementById("chart-{{ $project->id }}"), {
            type: 'doughnut',
            data: {
                labels: ['Completed', 'Remaining'],
                datasets: [{
                    data: [
                        {{ $project->tasks->where('status', 'Completed')->count() }},
                        {{ $project->tasks->count() - $project->tasks->where('status', 'Completed')->count() }}
                    ],
                    backgroundColor: ['#4CAF50', '#FFC107'],
                }]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'top',
                    },
                },
            }
        });
        @endforeach
    });
</script>
@endsection
