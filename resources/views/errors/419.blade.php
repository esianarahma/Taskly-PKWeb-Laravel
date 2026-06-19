<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>419 - Sesi Berakhir</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="text-center px-4">
        <p class="text-6xl font-bold text-yellow-500">419</p>
        <p class="text-xl text-gray-700 mt-4">Sesi Telah Berakhir</p>
        <p class="text-gray-500 mt-2">Halaman sudah terlalu lama terbuka. Silakan muat ulang dan coba lagi.</p>
        <a href="{{ url()->previous() }}" class="inline-block mt-6 px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
            Muat Ulang Halaman
        </a>
    </div>
</body>
</html>