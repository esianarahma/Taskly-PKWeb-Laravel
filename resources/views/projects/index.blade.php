<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Projects') }}
            </h2>
            <a href="{{ route('projects.create') }}" class="px-4 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700">
                + Tambah Project
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

                @if ($projects->isEmpty())
                    <p class="text-gray-500 text-sm">Belum ada project. Klik "Tambah Project" untuk membuat yang baru.</p>
                @else
                    <table class="w-full text-sm text-left">
                        <thead class="border-b text-gray-500">
                            <tr>
                                <th class="py-2">Nama</th>
                                <th class="py-2">Deskripsi</th>
                                <th class="py-2">Status</th>
                                <th class="py-2 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $project)
                                <tr class="border-b">
                                    <td class="py-2 font-medium">{{ $project->name }}</td>
                                    <td class="py-2 text-gray-500">{{ Str::limit($project->description, 50) }}</td>
                                    <td class="py-2">
                                        <span class="px-2 py-1 text-xs rounded-full
                                            @if($project->status === 'active') bg-blue-100 text-blue-700
                                            @elseif($project->status === 'completed') bg-green-100 text-green-700
                                            @else bg-gray-100 text-gray-700 @endif">
                                            {{ ucfirst($project->status) }}
                                        </span>
                                    </td>
                                    <td class="py-2 text-right space-x-2">
                                        <a href="{{ route('projects.edit', $project) }}" class="text-blue-600 hover:underline">Edit</a>
                                        <form action="{{ route('projects.destroy', $project) }}" method="POST" class="inline" onsubmit="return confirm('Hapus project ini?')">
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