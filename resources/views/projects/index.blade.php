<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-lg font-medium text-brand-dark">Projects</h2>
                <p class="text-sm text-brand mt-1">Kelola semua project kamu</p>
            </div>
            <a href="{{ route('projects.create') }}" class="btn-pink">
                + Tambah Project
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if (session('success'))
            <div class="mb-4 p-3 rounded-xl text-sm" style="background:#EAF3DE;color:#27500A;">
                {{ session('success') }}
            </div>
        @endif

        @if ($projects->isEmpty())
            <div class="card-pink text-center py-12">
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4" style="background:#FBEAF0;">
                    <svg class="w-8 h-8 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7a2 2 0 012-2h4l2 2h8a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"/>
                    </svg>
                </div>
                <p class="text-gray-500 text-sm mb-4">Belum ada project. Yuk buat yang pertama!</p>
                <a href="{{ route('projects.create') }}" class="btn-pink">+ Tambah Project</a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($projects as $project)
                    <div class="card-pink border-t-4" style="border-top-color:#D4537E;border-radius:0 0 16px 16px;">
                        <div class="flex justify-between items-start mb-2">
                            <p class="font-medium text-brand-dark">{{ $project->name }}</p>
                            <span class="px-2 py-1 text-xs rounded-full
                                @if($project->status === 'active') bg-pink-50 text-brand-hover
                                @elseif($project->status === 'completed') bg-green-50 text-green-700
                                @else bg-gray-100 text-gray-500 @endif">
                                {{ ucfirst($project->status) }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-500 mb-4">{{ Str::limit($project->description, 80) ?: '-' }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-xs px-3 py-1 rounded-full" style="background:#FBEAF0;color:#993556;">
                                {{ $project->tasks->count() }} tasks
                            </span>
                            <div class="flex gap-3">
                                <a href="{{ route('projects.edit', $project) }}" class="text-sm text-brand hover:text-brand-hover">Edit</a>
                                <form action="{{ route('projects.destroy', $project) }}" method="POST" class="inline" onsubmit="return confirm('Hapus project ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-red-500 hover:text-red-700">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</x-app-layout>