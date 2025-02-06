<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My CodeIgniter 4 with Tailwind CSS</title>
    <link href="<?= base_url('css/style.css') ?>" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-900 flex items-center justify-center h-screen">
    <div class="text-center">
        <h1 class="text-4xl font-bold text-blue-600">Welcome to CodeIgniter 4 + Tailwind CSS</h1>
        <p class="text-lg mt-2 text-gray-700">Setup berhasil! 🎉</p>

        <!-- Tombol menuju halaman About dan Contact -->
        <div class="mt-6 space-x-4">
            <a href="<?= base_url('about') ?>" class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700 transition">
                Go to About Page
            </a>

            <a href="<?= base_url('contact') ?>" class="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-700 transition">
                Go to Contact Page
            </a>
        </div>
    </div>
</body>
</html>
