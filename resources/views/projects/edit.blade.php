<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-medium text-brand-dark">Edit Project</h2>
        <p class="text-sm text-brand mt-1">Perbarui informasi project kamu</p>
    </x-slot>

    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="card-pink">
            <form method="POST" action="{{ route('projects.update', $project) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-xs font-medium text-brand mb-1">Nama Project *</label>
                    <input type="text" name="name" value="{{ old('name', $project->name) }}"
                        class="input-pink" required autofocus/>
                    <x-input-error :messages="$errors->get('name')" class="mt-1" />
                </div>

                <div class="mb-4">
                    <label class="block text-xs font-medium text-brand mb-1">Deskripsi</label>
                    <textarea name="description" rows="3" class="input-pink">{{ old('description', $project->description) }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-1" />
                </div>

                <div class="mb-6">
                    <label class="block text-xs font-medium text-brand mb-1">Status</label>
                    <select name="status" class="input-pink">
                        <option value="active" @selected(old('status', $project->status) === 'active')>Active</option>
                        <option value="completed" @selected(old('status', $project->status) === 'completed')>Completed</option>
                        <option value="archived" @selected(old('status', $project->status) === 'archived')>Archived</option>
                    </select>
                    <x-input-error :messages="$errors->get('status')" class="mt-1" />
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('projects.index') }}" class="btn-outline-pink">Batal</a>
                    <button type="submit" class="btn-pink">Update</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>