<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Categories') }}
            </h2>
            <a href="{{ route('categories.create') }}" class="px-4 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700">
                + Tambah Kategori
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

                @if ($categories->isEmpty())
                    <p class="text-gray-500 text-sm">Belum ada kategori. Klik "Tambah Kategori" untuk membuat yang baru.</p>
                @else
                    <table class="w-full text-sm text-left">
                        <thead class="border-b text-gray-500">
                            <tr>
                                <th class="py-2">Warna</th>
                                <th class="py-2">Nama</th>
                                <th class="py-2 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr class="border-b">
                                    <td class="py-2">
                                        <span class="inline-block w-5 h-5 rounded-full border" style="background-color: {{ $category->color }}"></span>
                                    </td>
                                    <td class="py-2 font-medium">{{ $category->name }}</td>
                                    <td class="py-2 text-right space-x-2">
                                        <a href="{{ route('categories.edit', $category) }}" class="text-blue-600 hover:underline">Edit</a>
                                        <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kategori ini?')">
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