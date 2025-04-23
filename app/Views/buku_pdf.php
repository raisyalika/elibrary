<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Data Buku</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #eee;
        }
    </style>
</head>

<body>
    <h2>Data Buku Perpustakaan</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Buku</th>
                <th>Judul</th>
                <th>ISBN</th>
                <th>Kategori</th>
                <th>Pengarang</th>
                <th>Penerbit</th>
                <th>Tahun</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($books as $index => $book): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= $book['id_buku'] ?></td>
                    <td><?= $book['judul'] ?></td>
                    <td><?= $book['isbn'] ?></td>
                    <td><?= $book['kategori'] ?></td>
                    <td><?= $book['pengarang'] ?></td>
                    <td><?= $book['penerbit'] ?></td>
                    <td><?= $book['tahun'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>