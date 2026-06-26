<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-lg font-medium text-brand-dark">Categories</h2>
                <p class="text-sm text-brand mt-1">Kelola label untuk task kamu</p>
            </div>
            <a href="{{ route('categories.create') }}" class="btn-pink">+ Tambah Kategori</a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if (session('success'))
            <div class="mb-4 p-3 rounded-xl text-sm" style="background:#EAF3DE;color:#27500A;">
                {{ session('success') }}
            </div>
        @endif

        @if ($categories->isEmpty())
            <div class="card-pink text-center py-12">
                <p class="text-gray-500 text-sm mb-4">Belum ada kategori. Buat yang pertama!</p>
                <a href="{{ route('categories.create') }}" class="btn-pink">+ Tambah Kategori</a>
            </div>
        @else
            <div class="card-pink p-0 overflow-hidden">
                <table class="w-full text-sm">
                    <thead>
                        <tr style="background:linear-gradient(135deg,#FBEAF0,#FDF1F5);">
                            <th class="text-left px-6 py-3 text-xs font-medium text-brand uppercase tracking-wide">Warna</th>
                            <th class="text-left px-6 py-3 text-xs font-medium text-brand uppercase tracking-wide">Nama</th>
                            <th class="text-right px-6 py-3 text-xs font-medium text-brand uppercase tracking-wide">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr class="border-t border-brand-border hover:bg-pink-50 transition-colors">
                                <td class="px-6 py-3">
                                    <span class="inline-block w-6 h-6 rounded-full border border-brand-border" style="background-color:{{ $category->color }}"></span>
                                </td>
                                <td class="px-6 py-3 font-medium text-brand-dark">{{ $category->name }}</td>
                                <td class="px-6 py-3 text-right space-x-3">
                                    <a href="{{ route('categories.edit', $category) }}" class="text-brand hover:text-brand-hover">Edit</a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

    </div>
</x-app-layout>