<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Taskly') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased dot-pattern min-h-screen flex items-center justify-center py-12">
    <div class="w-full max-w-md px-4">
        <!-- Logo -->
        <div class="text-center mb-6">
            <div class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-3" style="background:linear-gradient(135deg,#ED93B1,#D4537E);">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h1 class="text-2xl font-semibold text-brand-dark">Taskly</h1>
            <p class="text-sm text-brand mt-1">Manajemen tugas yang simpel & menyenangkan 🌸</p>
        </div>

        <!-- Card -->
        <div class="bg-white rounded-2xl border border-brand-border p-8 shadow-sm">
            {{ $slot }}
        </div>
    </div>
</body>
</html>