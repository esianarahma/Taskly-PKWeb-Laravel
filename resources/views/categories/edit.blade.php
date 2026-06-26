<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-medium text-brand-dark">Edit Kategori</h2>
        <p class="text-sm text-brand mt-1">Perbarui nama atau warna kategori</p>
    </x-slot>

    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="card-pink">
            <form method="POST" action="{{ route('categories.update', $category) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-xs font-medium text-brand mb-1">Nama Kategori *</label>
                    <input type="text" name="name" value="{{ old('name', $category->name) }}"
                        class="input-pink" required autofocus/>
                    <x-input-error :messages="$errors->get('name')" class="mt-1" />
                </div>

                <div class="mb-6">
                    <label class="block text-xs font-medium text-brand mb-1">Warna</label>
                    <div class="flex items-center gap-3">
                        <input type="color" name="color" value="{{ old('color', $category->color) }}"
                            class="h-10 w-16 rounded-lg border border-brand-border cursor-pointer"/>
                        <span class="text-sm text-gray-500">Pilih warna untuk kategori ini</span>
                    </div>
                    <x-input-error :messages="$errors->get('color')" class="mt-1" />
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('categories.index') }}" class="btn-outline-pink">Batal</a>
                    <button type="submit" class="btn-pink">Update</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>