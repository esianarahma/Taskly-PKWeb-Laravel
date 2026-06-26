<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-medium text-brand-dark">Tambah Task Baru</h2>
        <p class="text-sm text-brand mt-1">Isi detail task yang ingin kamu kerjakan</p>
    </x-slot>

    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

        @if ($projects->isEmpty())
            <div class="card-pink text-center py-8">
                <p class="text-sm text-gray-500 mb-4">Kamu belum punya project. Buat project dulu sebelum menambah task.</p>
                <a href="{{ route('projects.create') }}" class="btn-pink">+ Buat Project</a>
            </div>
        @else
            <div class="card-pink">
                <form method="POST" action="{{ route('tasks.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-xs font-medium text-brand mb-1">Judul Task *</label>
                        <input type="text" name="title" value="{{ old('title') }}"
                            class="input-pink" placeholder="Contoh: Buat halaman login" required autofocus/>
                        <x-input-error :messages="$errors->get('title')" class="mt-1" />
                    </div>

                    <div class="mb-4">
                        <label class="block text-xs font-medium text-brand mb-1">Deskripsi</label>
                        <textarea name="description" rows="3"
                            class="input-pink" placeholder="Jelaskan detail task ini...">{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-1" />
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-medium text-brand mb-1">Project *</label>
                            <select name="project_id" class="input-pink">
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}" @selected(old('project_id') == $project->id)>{{ $project->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('project_id')" class="mt-1" />
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-brand mb-1">Kategori</label>
                            <select name="category_id" class="input-pink">
                                <option value="">- Tanpa kategori -</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-1" />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-medium text-brand mb-1">Status</label>
                            <select name="status" class="input-pink">
                                <option value="todo" @selected(old('status', 'todo') === 'todo')>Todo</option>
                                <option value="in_progress" @selected(old('status') === 'in_progress')>In Progress</option>
                                <option value="done" @selected(old('status') === 'done')>Done</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-1" />
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-brand mb-1">Prioritas</label>
                            <select name="priority" class="input-pink">
                                <option value="low" @selected(old('priority') === 'low')>Low</option>
                                <option value="medium" @selected(old('priority', 'medium') === 'medium')>Medium</option>
                                <option value="high" @selected(old('priority') === 'high')>High</option>
                            </select>
                            <x-input-error :messages="$errors->get('priority')" class="mt-1" />
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-xs font-medium text-brand mb-1">Deadline</label>
                        <input type="date" name="due_date" value="{{ old('due_date') }}" class="input-pink"/>
                        <x-input-error :messages="$errors->get('due_date')" class="mt-1" />
                    </div>

                    <div class="mb-6">
                        <label class="block text-xs font-medium text-brand mb-1">Lampiran (opsional)</label>
                        <input type="file" name="attachment" class="input-pink cursor-pointer"/>
                        <p class="text-xs mt-1" style="color:#993556;">Maks. 2MB · Format: PDF, JPG, PNG</p>
                        <x-input-error :messages="$errors->get('attachment')" class="mt-1" />
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('tasks.index') }}" class="btn-outline-pink">Batal</a>
                        <button type="submit" class="btn-pink">Simpan Task</button>
                    </div>
                </form>
            </div>
        @endif

    </div>
</x-app-layout>