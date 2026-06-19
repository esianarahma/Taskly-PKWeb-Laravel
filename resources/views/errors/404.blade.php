<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>404 - Halaman Tidak Ditemukan</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="text-center px-4">
        <p class="text-6xl font-bold text-gray-400">404</p>
        <p class="text-xl text-gray-700 mt-4">Halaman Tidak Ditemukan</p>
        <p class="text-gray-500 mt-2">Halaman yang kamu cari tidak ada atau sudah dipindahkan.</p>
        <a href="{{ route('dashboard') }}" class="inline-block mt-6 px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
            Kembali ke Dashboard
        </a>
    </div>
</body>
</html>