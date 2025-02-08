<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'E-Library SDN Jelambar Baru 07' ?></title>
    <link href="<?= base_url('css/style.css') ?>" rel="stylesheet">
</head>
<body class="bg-gray-50 flex min-h-screen">

  <div class="flex">
    <?= $this->include('partials/navbar_admin') ?>
    
  </div>
  <!-- Include the Navbar for All Pages -->
  <div class="flex-grow bg-gray-50 w-full p-4 md:p-6 md:ml-64">
  <?= $this->renderSection('content') ?> <!-- Dynamic Content -->
</div>

</body>
</html>
