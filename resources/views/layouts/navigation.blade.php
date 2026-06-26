<nav class="bg-white border-b border-brand-border" x-data="{ open: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-8">
                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:linear-gradient(135deg,#ED93B1,#D4537E);">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <span class="font-semibold text-brand-dark text-base">Taskly</span>
                </a>

                <!-- Desktop Nav Links -->
                <div class="hidden sm:flex items-center gap-6">
                    <a href="{{ route('dashboard') }}"
                        class="text-sm font-medium pb-1 transition-colors {{ request()->routeIs('dashboard') ? 'text-brand border-b-2 border-brand' : 'text-gray-500 hover:text-brand' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('tasks.index') }}"
                        class="text-sm font-medium pb-1 transition-colors {{ request()->routeIs('tasks.*') ? 'text-brand border-b-2 border-brand' : 'text-gray-500 hover:text-brand' }}">
                        Tasks
                    </a>
                    <a href="{{ route('projects.index') }}"
                        class="text-sm font-medium pb-1 transition-colors {{ request()->routeIs('projects.*') ? 'text-brand border-b-2 border-brand' : 'text-gray-500 hover:text-brand' }}">
                        Projects
                    </a>
                    <a href="{{ route('categories.index') }}"
                        class="text-sm font-medium pb-1 transition-colors {{ request()->routeIs('categories.*') ? 'text-brand border-b-2 border-brand' : 'text-gray-500 hover:text-brand' }}">
                        Categories
                    </a>
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('admin.activity-logs') }}"
                            class="text-sm font-medium pb-1 transition-colors {{ request()->routeIs('admin.*') ? 'text-brand border-b-2 border-brand' : 'text-gray-500 hover:text-brand' }}">
                            Activity Logs
                        </a>
                    @endif
                </div>
            </div>

            <!-- User Dropdown -->
            <div class="hidden sm:flex items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-2 text-sm text-gray-600 hover:text-brand transition-colors">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-xs font-medium" style="background:linear-gradient(135deg,#ED93B1,#D4537E);">
                                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                            </div>
                            <span class="font-medium text-brand-dark">{{ auth()->user()->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Profil
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Keluar
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open" class="p-2 rounded-md text-gray-400 hover:text-brand hover:bg-brand-light transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden border-t border-brand-border">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <a href="{{ route('dashboard') }}" class="block py-2 text-sm {{ request()->routeIs('dashboard') ? 'text-brand font-medium' : 'text-gray-500' }}">Dashboard</a>
            <a href="{{ route('tasks.index') }}" class="block py-2 text-sm {{ request()->routeIs('tasks.*') ? 'text-brand font-medium' : 'text-gray-500' }}">Tasks</a>
            <a href="{{ route('projects.index') }}" class="block py-2 text-sm {{ request()->routeIs('projects.*') ? 'text-brand font-medium' : 'text-gray-500' }}">Projects</a>
            <a href="{{ route('categories.index') }}" class="block py-2 text-sm {{ request()->routeIs('categories.*') ? 'text-brand font-medium' : 'text-gray-500' }}">Categories</a>
            @if (auth()->user()->isAdmin())
                <a href="{{ route('admin.activity-logs') }}" class="block py-2 text-sm {{ request()->routeIs('admin.*') ? 'text-brand font-medium' : 'text-gray-500' }}">Activity Logs</a>
            @endif
        </div>
        <div class="border-t border-brand-border px-4 py-3 space-y-1">
            <p class="text-sm font-medium text-brand-dark">{{ auth()->user()->name }}</p>
            <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
            <a href="{{ route('profile.edit') }}" class="block py-2 text-sm text-gray-500">Profil</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm text-gray-500 py-2">Keluar</button>
            </form>
        </div>
    </div>
</nav>