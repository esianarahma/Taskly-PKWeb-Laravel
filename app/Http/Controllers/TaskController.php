<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::where('user_id', auth()->id());

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $tasks = $query->with(['project', 'category'])->latest()->get();

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $projects = Project::where('user_id', auth()->id())->get();
        $categories = Category::where('user_id', auth()->id())->get();

        return view('tasks.create', compact('projects', 'categories'));
    }

    public function store(StoreTaskRequest $request)
    {
        $validated = $request->validated();

        Project::where('id', $validated['project_id'])
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if ($request->hasFile('attachment')) {
            $validated['attachment'] = $this->storeAttachment($request->file('attachment'));
        }

        $validated['user_id'] = auth()->id();

        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Task berhasil dibuat.');
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);

        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        $projects = Project::where('user_id', auth()->id())->get();
        $categories = Category::where('user_id', auth()->id())->get();

        return view('tasks.edit', compact('task', 'projects', 'categories'));
    }

    public function update(StoreTaskRequest $request, Task $task)
    {
        $this->authorize('update', $task);

        $validated = $request->validated();

        Project::where('id', $validated['project_id'])
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if ($request->hasFile('attachment')) {
            if ($task->attachment) {
                Storage::disk('local')->delete($task->attachment);
            }
            $validated['attachment'] = $this->storeAttachment($request->file('attachment'));
        }

        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Task berhasil diperbarui.');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        if ($task->attachment) {
            Storage::disk('local')->delete($task->attachment);
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task berhasil dihapus.');
    }

    public function download(Task $task)
    {
        $this->authorize('view', $task);

        abort_unless($task->attachment, 404);

        return Storage::disk('local')->download($task->attachment);
    }

    private function storeAttachment($file): string
    {
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();

        return $file->storeAs('attachments', $filename, 'local');
    }
}