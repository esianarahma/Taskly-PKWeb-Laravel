<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-lg font-medium text-brand-dark">Daftar Task</h2>
                <p class="text-sm text-brand mt-1">Kelola semua tugas kamu di sini</p>
            </div>
            <a href="{{ route('tasks.create') }}" class="btn-pink">+ Tambah Task</a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4">

        @if (session('success'))
            <div class="p-3 rounded-xl text-sm" style="background:#EAF3DE;color:#27500A;">
                {{ session('success') }}
            </div>
        @endif

        {{-- Filter --}}
        <form method="GET" action="{{ route('tasks.index') }}" class="flex flex-wrap gap-2">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari judul task..."
                class="input-pink flex-1 min-w-[150px]"/>
            <select name="status" class="input-pink w-auto">
                <option value="">Semua Status</option>
                <option value="todo" @selected(request('status') === 'todo')>Todo</option>
                <option value="in_progress" @selected(request('status') === 'in_progress')>In Progress</option>
                <option value="done" @selected(request('status') === 'done')>Done</option>
            </select>
            <select name="priority" class="input-pink w-auto">
                <option value="">Semua Prioritas</option>
                <option value="low" @selected(request('priority') === 'low')>Low</option>
                <option value="medium" @selected(request('priority') === 'medium')>Medium</option>
                <option value="high" @selected(request('priority') === 'high')>High</option>
            </select>
            <button type="submit" class="btn-pink">Filter</button>
            <a href="{{ route('tasks.index') }}" class="btn-outline-pink">Reset</a>
        </form>

        {{-- Table --}}
        @if ($tasks->isEmpty())
            <div class="card-pink text-center py-12">
                <p class="text-gray-500 text-sm mb-4">Belum ada task. Yuk buat yang pertama!</p>
                <a href="{{ route('tasks.create') }}" class="btn-pink">+ Tambah Task</a>
            </div>
        @else
            <div class="card-pink p-0 overflow-hidden">
                <table class="w-full text-sm table-fixed">
                    <thead>
                        <tr style="background:linear-gradient(135deg,#FBEAF0,#FDF1F5);">
                            <th class="text-left px-4 py-3 text-xs font-medium text-brand uppercase tracking-wide w-[28%]">Judul</th>
                            <th class="text-left px-4 py-3 text-xs font-medium text-brand uppercase tracking-wide w-[15%]">Project</th>
                            <th class="text-left px-4 py-3 text-xs font-medium text-brand uppercase tracking-wide w-[13%]">Kategori</th>
                            <th class="text-left px-4 py-3 text-xs font-medium text-brand uppercase tracking-wide w-[12%]">Status</th>
                            <th class="text-left px-4 py-3 text-xs font-medium text-brand uppercase tracking-wide w-[12%]">Prioritas</th>
                            <th class="text-left px-4 py-3 text-xs font-medium text-brand uppercase tracking-wide w-[12%]">Deadline</th>
                            <th class="w-[8%]"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr class="border-t border-brand-border hover:bg-pink-50 transition-colors">
                                <td class="px-4 py-3 font-medium text-brand-dark {{ $task->status === 'done' ? 'line-through text-gray-400' : '' }}">
                                    {{ $task->title }}
                                </td>
                                <td class="px-4 py-3 text-gray-500">{{ $task->project->name }}</td>
                                <td class="px-4 py-3">
                                    @if ($task->category)
                                        <span class="inline-flex items-center gap-1 text-xs">
                                            <span class="w-3 h-3 rounded-full inline-block" style="background-color:{{ $task->category->color }}"></span>
                                            {{ $task->category->name }}
                                        </span>
                                    @else
                                        <span class="text-gray-300">-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 text-xs rounded-full
                                        @if($task->status === 'todo') bg-gray-100 text-gray-700
                                        @elseif($task->status === 'in_progress') bg-pink-50 text-brand-hover
                                        @else bg-green-100 text-green-700 @endif">
                                        {{ str_replace('_', ' ', ucfirst($task->status)) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 text-xs rounded-full
                                        @if($task->priority === 'high') bg-red-100 text-red-700
                                        @elseif($task->priority === 'medium') bg-yellow-100 text-yellow-700
                                        @else bg-green-100 text-green-700 @endif">
                                        {{ ucfirst($task->priority) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-xs {{ $task->due_date && $task->due_date->isPast() && $task->status !== 'done' ? 'text-red-500 font-medium' : 'text-gray-400' }}">
                                    {{ $task->due_date ? $task->due_date->format('d M Y') : '-' }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2 justify-center">
                                        @if ($task->attachment)
                                            <a href="{{ route('tasks.download', $task) }}" class="text-brand hover:text-brand-hover" title="Download lampiran">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                                </svg>
                                            </a>
                                        @endif
                                        <a href="{{ route('tasks.edit', $task) }}" class="text-brand hover:text-brand-hover" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline" onsubmit="return confirm('Hapus task ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-600" title="Hapus">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

    </div>
</x-app-layout>