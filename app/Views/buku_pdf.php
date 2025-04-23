<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Laporan Data Buku</title>
  <style>
    body { font-family: sans-serif; font-size: 12px; }
    table { width: 100%; border-collapse: collapse; margin-top: 12px; }
    th, td { border: 1px solid #333; padding: 6px; text-align: left; }
    th { background: #f0f0f0; }
    h2, h3 { margin-top: 20px; }
    .chart { text-align: center; margin-top: 12px; }
  </style>
</head>
<body>
  <h2>Laporan Data Buku</h2>

  <!-- 1) SUMMARY TABLE -->
  <h3>Jumlah Buku per Kategori</h3>
  <table>
    <thead>
      <tr><th>Kategori</th><th>Total</th></tr>
    </thead>
    <tbody>
      <?php foreach($categoryData as $row): ?>
      <tr>
        <td><?= $row['kategori'] ?: '—Tidak ada—' ?></td>
        <td><?= $row['total'] ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <!-- 2) PIE CHART via QuickChart -->
  <?php
    // Prepare labels & data arrays for the chart
    $labels = array_column($categoryData, 'kategori');
    $totals = array_column($categoryData, 'total');
    $chartConfig = [
      'type' => 'pie',
      'data' => [
        'labels'   => $labels,
        'datasets' => [[ 'data' => $totals ]]
      ]
    ];
    $encoded = rawurlencode(json_encode($chartConfig));
    $chartUrl = "https://quickchart.io/chart?c={$encoded}";
  ?>
  <div class="chart">
    <img src="<?= $chartUrl ?>" alt="Chart: Buku per Kategori" width="400" />
  </div>

  <!-- 3) FULL BOOK LIST -->
  <h3>Daftar Lengkap Buku</h3>
  <table>
    <thead>
      <tr>
        <th>No</th><th>ID</th><th>Judul</th><th>ISBN</th>
        <th>Kategori</th><th>Pengarang</th><th>Penerbit</th><th>Tahun</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($books as $i => $b): ?>
      <tr>
        <td><?= $i+1 ?></td>
        <td><?= $b['id_buku'] ?></td>
        <td><?= $b['judul'] ?></td>
        <td><?= $b['isbn'] ?></td>
        <td><?= $b['kategori'] ?></td>
        <td><?= $b['pengarang'] ?></td>
        <td><?= $b['penerbit'] ?></td>
        <td><?= $b['tahun'] ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>
