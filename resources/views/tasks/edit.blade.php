<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-medium text-brand-dark">Edit Task</h2>
        <p class="text-sm text-brand mt-1">Perbarui detail task kamu</p>
    </x-slot>

    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="card-pink">
            <form method="POST" action="{{ route('tasks.update', $task) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-xs font-medium text-brand mb-1">Judul Task *</label>
                    <input type="text" name="title" value="{{ old('title', $task->title) }}"
                        class="input-pink" required autofocus/>
                    <x-input-error :messages="$errors->get('title')" class="mt-1" />
                </div>

                <div class="mb-4">
                    <label class="block text-xs font-medium text-brand mb-1">Deskripsi</label>
                    <textarea name="description" rows="3" class="input-pink">{{ old('description', $task->description) }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-1" />
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-xs font-medium text-brand mb-1">Project *</label>
                        <select name="project_id" class="input-pink">
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}" @selected(old('project_id', $task->project_id) == $project->id)>{{ $project->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('project_id')" class="mt-1" />
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-brand mb-1">Kategori</label>
                        <select name="category_id" class="input-pink">
                            <option value="">- Tanpa kategori -</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id', $task->category_id) == $category->id)>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-1" />
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-xs font-medium text-brand mb-1">Status</label>
                        <select name="status" class="input-pink">
                            <option value="todo" @selected(old('status', $task->status) === 'todo')>Todo</option>
                            <option value="in_progress" @selected(old('status', $task->status) === 'in_progress')>In Progress</option>
                            <option value="done" @selected(old('status', $task->status) === 'done')>Done</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-1" />
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-brand mb-1">Prioritas</label>
                        <select name="priority" class="input-pink">
                            <option value="low" @selected(old('priority', $task->priority) === 'low')>Low</option>
                            <option value="medium" @selected(old('priority', $task->priority) === 'medium')>Medium</option>
                            <option value="high" @selected(old('priority', $task->priority) === 'high')>High</option>
                        </select>
                        <x-input-error :messages="$errors->get('priority')" class="mt-1" />
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-xs font-medium text-brand mb-1">Deadline</label>
                    <input type="date" name="due_date" value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}" class="input-pink"/>
                    <x-input-error :messages="$errors->get('due_date')" class="mt-1" />
                </div>

                <div class="mb-6">
                    <label class="block text-xs font-medium text-brand mb-1">Lampiran</label>
                    @if ($task->attachment)
                        <div class="flex items-center gap-3 mb-2 p-2 rounded-xl" style="background:#FBEAF0;">
                            <svg class="w-4 h-4 text-brand flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                            </svg>
                            <span class="text-sm text-brand-dark flex-1">{{ basename($task->attachment) }}</span>
                            <a href="{{ route('tasks.download', $task) }}" class="text-xs text-brand hover:text-brand-hover">Download</a>
                        </div>
                    @endif
                    <input type="file" name="attachment" class="input-pink cursor-pointer"/>
                    <p class="text-xs mt-1" style="color:#993556;">Maks. 2MB · Format: PDF, JPG, PNG. Kosongkan jika tidak ingin mengubah.</p>
                    <x-input-error :messages="$errors->get('attachment')" class="mt-1" />
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('tasks.index') }}" class="btn-outline-pink">Batal</a>
                    <button type="submit" class="btn-pink">Update Task</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>