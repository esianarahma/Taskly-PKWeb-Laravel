<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Sambutan --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <p class="text-lg font-semibold text-gray-800">Selamat datang, {{ auth()->user()->name }}! 👋</p>
                <p class="text-sm text-gray-500 mt-1">{{ now()->format('d/m/Y') }}</p>
            </div>

            {{-- Statistik --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white shadow-sm sm:rounded-lg p-5">
                    <p class="text-xs text-gray-500 uppercase tracking-wide">Total Task</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ $totalTasks }}</p>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-5">
                    <p class="text-xs text-gray-500 uppercase tracking-wide">Selesai</p>
                    <p class="text-3xl font-bold text-green-600 mt-1">{{ $doneTasks }}</p>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-5">
                    <p class="text-xs text-gray-500 uppercase tracking-wide">In Progress</p>
                    <p class="text-3xl font-bold text-blue-600 mt-1">{{ $inProgressTasks }}</p>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-5">
                    <p class="text-xs text-gray-500 uppercase tracking-wide">Overdue</p>
                    <p class="text-3xl font-bold text-red-500 mt-1">{{ $overdueTasks }}</p>
                </div>
            </div>

            {{-- Info ringkas project & kategori --}}
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white shadow-sm sm:rounded-lg p-5 flex items-center gap-4">
                    <div class="bg-blue-100 text-blue-600 rounded-lg p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7a2 2 0 012-2h4l2 2h8a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide">Total Project</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $totalProjects }}</p>
                    </div>
                    <a href="{{ route('projects.index') }}" class="ml-auto text-sm text-blue-600 hover:underline">Lihat →</a>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg p-5 flex items-center gap-4">
                    <div class="bg-purple-100 text-purple-600 rounded-lg p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide">Total Kategori</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $totalCategories }}</p>
                    </div>
                    <a href="{{ route('categories.index') }}" class="ml-auto text-sm text-purple-600 hover:underline">Lihat →</a>
                </div>
            </div>

            {{-- Task terbaru --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <p class="text-sm font-semibold text-gray-800">Task Terbaru</p>
                    <a href="{{ route('tasks.index') }}" class="text-sm text-blue-600 hover:underline">Lihat semua →</a>
                </div>

                @if ($recentTasks->isEmpty())
                    <p class="text-sm text-gray-400">Belum ada task. <a href="{{ route('tasks.create') }}" class="text-blue-600 hover:underline">Buat task pertamamu!</a></p>
                @else
                    <div class="space-y-3">
                        @foreach ($recentTasks as $task)
                            <div class="flex items-center gap-3 py-2 border-b last:border-0">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-800 truncate {{ $task->status === 'done' ? 'line-through text-gray-400' : '' }}">
                                        {{ $task->title }}
                                    </p>
                                    <p class="text-xs text-gray-400">{{ $task->project->name }}</p>
                                </div>
                                <span class="px-2 py-1 text-xs rounded-full shrink-0
                                    @if($task->status === 'todo') bg-gray-100 text-gray-700
                                    @elseif($task->status === 'in_progress') bg-blue-100 text-blue-700
                                    @else bg-green-100 text-green-700 @endif">
                                    {{ str_replace('_', ' ', ucfirst($task->status)) }}
                                </span>
                                <span class="px-2 py-1 text-xs rounded-full shrink-0
                                    @if($task->priority === 'high') bg-red-100 text-red-700
                                    @elseif($task->priority === 'medium') bg-yellow-100 text-yellow-700
                                    @else bg-green-100 text-green-700 @endif">
                                    {{ ucfirst($task->priority) }}
                                </span>
                                @if ($task->due_date)
                                    <span class="text-xs shrink-0 {{ $task->due_date->isPast() && $task->status !== 'done' ? 'text-red-500 font-medium' : 'text-gray-400' }}">
                                        {{ $task->due_date->format('d M Y') }}
                                    </span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>