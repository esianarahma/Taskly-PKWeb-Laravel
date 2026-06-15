<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tasks') }}
            </h2>
            <a href="{{ route('tasks.create') }}" class="px-4 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700">
                + Tambah Task
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-md text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="GET" action="{{ route('tasks.index') }}" class="flex flex-wrap gap-2 mb-4">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul task..."
                        class="flex-1 min-w-[150px] rounded-md border-gray-300 shadow-sm text-sm focus:ring-blue-500 focus:border-blue-500">

                    <select name="status" class="rounded-md border-gray-300 shadow-sm text-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua Status</option>
                        <option value="todo" @selected(request('status') === 'todo')>Todo</option>
                        <option value="in_progress" @selected(request('status') === 'in_progress')>In Progress</option>
                        <option value="done" @selected(request('status') === 'done')>Done</option>
                    </select>

                    <select name="priority" class="rounded-md border-gray-300 shadow-sm text-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua Prioritas</option>
                        <option value="low" @selected(request('priority') === 'low')>Low</option>
                        <option value="medium" @selected(request('priority') === 'medium')>Medium</option>
                        <option value="high" @selected(request('priority') === 'high')>High</option>
                    </select>

                    <button type="submit" class="px-4 py-2 bg-gray-600 text-white text-sm rounded-md hover:bg-gray-700">
                        Filter
                    </button>
                    <a href="{{ route('tasks.index') }}" class="px-4 py-2 text-sm text-gray-600 hover:underline">
                        Reset
                    </a>
                </form>

                @if ($tasks->isEmpty())
                    <p class="text-gray-500 text-sm">Belum ada task. Klik "Tambah Task" untuk membuat yang baru.</p>
                @else
                    <table class="w-full text-sm text-left">
                        <thead class="border-b text-gray-500">
                            <tr>
                                <th class="py-2">Judul</th>
                                <th class="py-2">Project</th>
                                <th class="py-2">Kategori</th>
                                <th class="py-2">Status</th>
                                <th class="py-2">Prioritas</th>
                                <th class="py-2">Deadline</th>
                                <th class="py-2 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr class="border-b">
                                    <td class="py-2 font-medium">{{ $task->title }}</td>
                                    <td class="py-2 text-gray-500">{{ $task->project->name }}</td>
                                    <td class="py-2">
                                        @if ($task->category)
                                            <span class="inline-flex items-center gap-1">
                                                <span class="inline-block w-3 h-3 rounded-full" style="background-color: {{ $task->category->color }}"></span>
                                                {{ $task->category->name }}
                                            </span>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="py-2">
                                        <span class="px-2 py-1 text-xs rounded-full
                                            @if($task->status === 'todo') bg-gray-100 text-gray-700
                                            @elseif($task->status === 'in_progress') bg-blue-100 text-blue-700
                                            @else bg-green-100 text-green-700 @endif">
                                            {{ str_replace('_', ' ', ucfirst($task->status)) }}
                                        </span>
                                    </td>
                                    <td class="py-2">
                                        <span class="px-2 py-1 text-xs rounded-full
                                            @if($task->priority === 'high') bg-red-100 text-red-700
                                            @elseif($task->priority === 'medium') bg-yellow-100 text-yellow-700
                                            @else bg-green-100 text-green-700 @endif">
                                            {{ ucfirst($task->priority) }}
                                        </span>
                                    </td>
                                    <td class="py-2 text-gray-500">
                                        {{ $task->due_date ? $task->due_date->format('d M Y') : '-' }}
                                    </td>
                                    <td class="py-2 text-right space-x-2">
                                        <a href="{{ route('tasks.edit', $task) }}" class="text-blue-600 hover:underline">Edit</a>
                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline" onsubmit="return confirm('Hapus task ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>