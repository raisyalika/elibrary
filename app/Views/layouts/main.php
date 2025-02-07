<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'E-Library SDN Jelambar Baru 07' ?></title>
    <link href="<?= base_url('css/style.css') ?>" rel="stylesheet">
</head>
<body class="bg-gray-50 flex min-h-screen flex-col">

    <!-- Include the Navbar for All Pages -->
    <?= $this->include('partials/navbar') ?>

    <main class="flex-grow bg-gray-50">
        <?= $this->renderSection('content') ?> <!-- Dynamic Content -->
    </main>

    <!-- Footer -->
    <footer class="bg-orange-100 mt-auto py-4">
        <div class="container mx-auto text-center">
            <h2 class="font-bold mb-2">E-Library SDN Jelambar Baru 07</h2>
            <p class="text-sm text-gray-600">© Copyright 2025 SDN Jelambar Baru 07</p>
        </div>
    </footer>

</body>
</html>
