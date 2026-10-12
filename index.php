<?php
require 'koneksi.php';
/** @var mysqli $koneksi */

$query = "SELECT * FROM produk";
$hasil_query = mysqli_query($koneksi, $query);

if (!$hasil_query) {
    die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
        " - " . mysqli_error($koneksi));
}

$jumlah_data = mysqli_num_rows($hasil_query);
?>
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - satamart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        .sidebar {
            position: fixed;
            top: 48px;
            bottom: 0;
            left: 0;
            width: 220px;
            background: #f8f9fa;
            border-right: 1px solid #dee2e6;
            padding-top: 1rem;
        }

        .sidebar .nav-link {
            font-size: .875rem;
            font-weight: 500;
            color: #0d6efd;
        }

        .sidebar .nav-link i {
            margin-right: 6px;
        }

        main {
            margin-left: 220px;
            padding-top: 64px;
        }

        @media (max-width: 767px) {
            .sidebar {
                display: none;
            }

            main {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>

    <!-- Navbar atas -->
    <header class="navbar navbar-dark bg-dark fixed-top px-3" style="height:48px">
        <a class="navbar-brand fs-6" href="#">xsatamart</a>
    </header>

    <!-- Sidebar -->
    <nav class="sidebar">
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link active" href="#"><i class="bi bi-house-fill"></i>Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-file-earmark"></i>Orders</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-cart"></i>Products</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-people"></i>Customers</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-graph-up"></i>Reports</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-puzzle"></i>Integrations</a></li>
        </ul>
        <hr>
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-door-closed"></i>Sign out</a></li>
        </ul>
    </nav>

    <!-- Konten -->
    <main class="px-4">
        <h2 class="h3 pt-3 pb-2 mb-3 border-bottom">Dashboard</h2>

        <h3 class="h4">Data Produk</h3>
        <a href="#" class="btn btn-secondary btn-sm mb-1">Add Product</a>

        <div class="table-responsive">
            <table class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($jumlah_data > 0): ?>
                        <?php $no = 1; ?>
                        <?php while ($data = mysqli_fetch_assoc($hasil_query)): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= htmlspecialchars($data['nama_barang']); ?></td>
                                <td>Rp <?= number_format($data['harga'], 0, ',', '.'); ?></td>
                                <td><?= $data['stok']; ?></td>
                                <td><a href="#">Edit</a> | <a href="#">Hapus</a></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data produk</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

</body>

</html>
<?php

mysqli_free_result($hasil_query);
mysqli_close($koneksi);
