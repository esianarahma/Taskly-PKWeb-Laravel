<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('tasks.update', $task) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <x-input-label for="title" :value="__('Judul Task')" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $task->title)" required autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="description" :value="__('Deskripsi')" />
                        <textarea id="description" name="description" rows="3"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('description', $task->description) }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <x-input-label for="project_id" :value="__('Project')" />
                            <select id="project_id" name="project_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}" @selected(old('project_id', $task->project_id) == $project->id)>{{ $project->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('project_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="category_id" :value="__('Kategori (opsional)')" />
                            <select id="category_id" name="category_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">- Tanpa kategori -</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id', $task->category_id) == $category->id)>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="todo" @selected(old('status', $task->status) === 'todo')>Todo</option>
                                <option value="in_progress" @selected(old('status', $task->status) === 'in_progress')>In Progress</option>
                                <option value="done" @selected(old('status', $task->status) === 'done')>Done</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="priority" :value="__('Prioritas')" />
                            <select id="priority" name="priority" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="low" @selected(old('priority', $task->priority) === 'low')>Low</option>
                                <option value="medium" @selected(old('priority', $task->priority) === 'medium')>Medium</option>
                                <option value="high" @selected(old('priority', $task->priority) === 'high')>High</option>
                            </select>
                            <x-input-error :messages="$errors->get('priority')" class="mt-2" />
                        </div>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="due_date" :value="__('Deadline')" />
                        <x-text-input id="due_date" name="due_date" type="date" class="mt-1 block w-full"
                            :value="old('due_date', $task->due_date?->format('Y-m-d'))" />
                        <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="attachment" :value="__('Lampiran (opsional)')" />
                        @if ($task->attachment)
                            <p class="text-sm text-gray-500 mb-1">File saat ini: {{ basename($task->attachment) }}</p>
                        @endif
                        <input id="attachment" name="attachment" type="file"
                            class="mt-1 block w-full text-sm text-gray-600 border border-gray-300 rounded-md cursor-pointer">
                        <p class="text-xs text-gray-400 mt-1">Maks. 2MB. Format: pdf, jpg, jpeg, png. Kosongkan jika tidak ingin mengubah.</p>
                        <x-input-error :messages="$errors->get('attachment')" class="mt-2" />
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('tasks.index') }}" class="px-4 py-2 text-sm text-gray-600 hover:underline">Batal</a>
                        <x-primary-button>{{ __('Update') }}</x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>