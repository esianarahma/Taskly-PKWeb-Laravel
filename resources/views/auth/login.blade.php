<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <h2 class="text-lg font-medium text-brand-dark mb-6">Masuk ke akun kamu</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-xs font-medium text-brand mb-1">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                class="input-pink" placeholder="contoh@email.com" required autofocus/>
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <div class="mb-4">
            <label class="block text-xs font-medium text-brand mb-1">Password</label>
            <input id="password" type="password" name="password"
                class="input-pink" placeholder="••••••••" required/>
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <div class="flex justify-between items-center mb-6">
            <label class="flex items-center gap-2 text-sm text-gray-500">
                <input type="checkbox" name="remember" class="rounded border-brand-border text-brand focus:ring-brand"/>
                Ingat saya
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-brand hover:text-brand-hover">
                    Lupa password?
                </a>
            @endif
        </div>

        <button type="submit" class="btn-pink w-full justify-center">
            Masuk
        </button>

        <p class="text-center text-sm text-gray-500 mt-5">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-brand font-medium hover:text-brand-hover">Daftar sekarang</a>
        </p>
    </form>
</x-guest-layout>