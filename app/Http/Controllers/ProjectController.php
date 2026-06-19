<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Models\Project;
use App\Traits\LogsActivity;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    use LogsActivity;

    public function index()
    {
        $projects = Project::where('user_id', auth()->id())->latest()->get();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(StoreProjectRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();

        $project = Project::create($validated);
        $this->logActivity('create', $project);

        return redirect()->route('projects.index')->with('success', 'Project berhasil dibuat.');
    }

    public function show(Project $project)
    {
        $this->authorize('view', $project);
        $project->load('tasks');
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $this->authorize('update', $project);
        return view('projects.edit', compact('project'));
    }

    public function update(StoreProjectRequest $request, Project $project)
    {
        $this->authorize('update', $project);

        $project->update($request->validated());
        $this->logActivity('update', $project);

        return redirect()->route('projects.index')->with('success', 'Project berhasil diperbarui.');
    }

    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);

        $this->logActivity('delete', $project);
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project berhasil dihapus.');
    }
}