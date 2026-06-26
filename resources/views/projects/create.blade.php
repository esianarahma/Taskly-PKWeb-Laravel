<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-medium text-brand-dark">Tambah Project</h2>
        <p class="text-sm text-brand mt-1">Buat project baru untuk mengelola task kamu</p>
    </x-slot>

    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="card-pink">
            <form method="POST" action="{{ route('projects.store') }}">
                @csrf

                <div class="mb-4">
                    <label class="block text-xs font-medium text-brand mb-1">Nama Project *</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="input-pink" placeholder="Contoh: Skripsi Semester 4" required autofocus/>
                    <x-input-error :messages="$errors->get('name')" class="mt-1" />
                </div>

                <div class="mb-4">
                    <label class="block text-xs font-medium text-brand mb-1">Deskripsi</label>
                    <textarea name="description" rows="3"
                        class="input-pink" placeholder="Jelaskan project ini...">{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-1" />
                </div>

                <div class="mb-6">
                    <label class="block text-xs font-medium text-brand mb-1">Status</label>
                    <select name="status" class="input-pink">
                        <option value="active" @selected(old('status') === 'active')>Active</option>
                        <option value="completed" @selected(old('status') === 'completed')>Completed</option>
                        <option value="archived" @selected(old('status') === 'archived')>Archived</option>
                    </select>
                    <x-input-error :messages="$errors->get('status')" class="mt-1" />
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('projects.index') }}" class="btn-outline-pink">Batal</a>
                    <button type="submit" class="btn-pink">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>