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
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen">
        @include('layouts.navigation')
        @if (isset($header))
            <header class="gradient-banner mx-6 mt-4 mb-2">
                <div class="max-w-7xl mx-auto">
                    {{ $header }}
                </div>
            </header>
        @endif
        <main class="py-6">
            {{ $slot }}
        </main>
    </div>
</body>
</html>