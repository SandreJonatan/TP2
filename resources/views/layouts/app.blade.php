<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Project Management')</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800">
    <nav class="bg-blue-600 text-white shadow-lg p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('projects.index') }}" class="text-xl font-bold">Project Management</a>
            <ul class="flex space-x-4">
                <li><a href="{{ route('projects.index') }}" class="hover:underline">Home</a></li>
                <li><a href="{{ route('projects.create') }}" class="hover:underline">Create Project</a></li>
                <li><a href="{{ route('notifications.index') }}" class="hover:underline">Notifications</a></li>
            </ul>
        </div>
    </nav>

    <main class="container mx-auto py-6">
        @yield('content')
    </main>
</body>
</html>
