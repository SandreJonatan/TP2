<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required|in:Pending,In Progress,Completed',
        ]);

        $project->tasks()->create($request->all());

        return redirect()->route('projects.index')->with('success', 'Task added successfully.');
    }
}
