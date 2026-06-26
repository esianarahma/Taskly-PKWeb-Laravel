<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-lg font-medium text-brand-dark">Selamat datang, {{ auth()->user()->name }}! 🌸</h2>
                <p class="text-sm text-brand mt-1">{{ now()->format('d/m/Y') }}</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        {{-- Statistik --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="rounded-2xl p-5" style="background:#FBEAF0;">
                <p class="text-xs font-medium text-brand-hover uppercase tracking-wide mb-2">Total Task</p>
                <p class="text-3xl font-medium text-brand-dark">{{ $totalTasks }}</p>
            </div>
            <div class="rounded-2xl p-5" style="background:#EAF3DE;">
                <p class="text-xs font-medium uppercase tracking-wide mb-2" style="color:#3B6D11;">Selesai</p>
                <p class="text-3xl font-medium" style="color:#27500A;">{{ $doneTasks }}</p>
            </div>
            <div class="rounded-2xl p-5" style="background:#E6F1FB;">
                <p class="text-xs font-medium uppercase tracking-wide mb-2" style="color:#185FA5;">In Progress</p>
                <p class="text-3xl font-medium" style="color:#0C447C;">{{ $inProgressTasks }}</p>
            </div>
            <div class="rounded-2xl p-5" style="background:#FCEBEB;">
                <p class="text-xs font-medium uppercase tracking-wide mb-2" style="color:#A32D2D;">Overdue</p>
                <p class="text-3xl font-medium" style="color:#791F1F;">{{ $overdueTasks }}</p>
            </div>
        </div>

        {{-- Info Project & Kategori --}}
        <div class="grid grid-cols-2 gap-4">
            <div class="card-pink flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0" style="background:#FBEAF0;">
                    <svg class="w-6 h-6 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7a2 2 0 012-2h4l2 2h8a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-brand uppercase tracking-wide">Total Project</p>
                    <p class="text-2xl font-medium text-brand-dark">{{ $totalProjects }}</p>
                </div>
                <a href="{{ route('projects.index') }}" class="ml-auto text-sm text-brand hover:text-brand-hover">Lihat →</a>
            </div>
            <div class="card-pink flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0" style="background:#FBEAF0;">
                    <svg class="w-6 h-6 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-brand uppercase tracking-wide">Total Kategori</p>
                    <p class="text-2xl font-medium text-brand-dark">{{ $totalCategories }}</p>
                </div>
                <a href="{{ route('categories.index') }}" class="ml-auto text-sm text-brand hover:text-brand-hover">Lihat →</a>
            </div>
        </div>

        {{-- Task Terbaru --}}
        <div class="card-pink">
            <div class="flex justify-between items-center mb-4">
                <p class="text-sm font-medium text-brand-dark">Task Terbaru</p>
                <a href="{{ route('tasks.index') }}" class="text-sm text-brand hover:text-brand-hover">Lihat semua →</a>
            </div>

            @if ($recentTasks->isEmpty())
                <p class="text-sm text-gray-400">Belum ada task.
                    <a href="{{ route('tasks.create') }}" class="text-brand hover:underline">Buat task pertamamu!</a>
                </p>
            @else
                <div class="space-y-3">
                    @foreach ($recentTasks as $task)
                        <div class="flex items-center gap-3 py-2 border-b border-brand-border last:border-0">
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
</x-app-layout>