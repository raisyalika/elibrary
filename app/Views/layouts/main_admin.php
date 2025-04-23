    <!-- in app/Views/layouts/main_admin.php -->

    <!DOCTYPE html>
    <html lang="id" class="h-full">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title><?= $title ?? 'E-Library SDN Jelambar Baru 07' ?></title>
      <link href="<?= base_url('css/style.css') ?>" rel="stylesheet">

      <!-- Add html2pdf.js -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    </head>
    <body class="bg-gray-50 flex min-h-screen">
      <div class="flex">
        <?= $this->include('partials/navbar_admin') ?>
      </div>

      <div class="flex-grow bg-gray-50 w-full p-4 md:p-6">
        <?= $this->renderSection('content') ?>
      </div>
    </body>
    </html>
