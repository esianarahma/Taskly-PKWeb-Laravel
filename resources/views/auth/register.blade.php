<x-guest-layout>
    <h2 class="text-lg font-medium text-brand-dark mb-6">Buat akun baru</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-xs font-medium text-brand mb-1">Nama Lengkap</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}"
                class="input-pink" placeholder="Nama kamu" required autofocus/>
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <div class="mb-4">
            <label class="block text-xs font-medium text-brand mb-1">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                class="input-pink" placeholder="contoh@email.com" required/>
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <div class="mb-4">
            <label class="block text-xs font-medium text-brand mb-1">Password</label>
            <input id="password" type="password" name="password"
                class="input-pink" placeholder="Min. 8 karakter" required/>
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <div class="mb-6">
            <label class="block text-xs font-medium text-brand mb-1">Konfirmasi Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation"
                class="input-pink" placeholder="Ulangi password" required/>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <button type="submit" class="btn-pink w-full justify-center">
            Daftar
        </button>

        <p class="text-center text-sm text-gray-500 mt-5">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-brand font-medium hover:text-brand-hover">Masuk</a>
        </p>
    </form>
</x-guest-layout>