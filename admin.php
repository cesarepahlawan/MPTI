<?php
require 'function.php';
session_start();
if (!isset($_SESSION["login"])) {
    header("location:login.php");
    exit;
}

$produk1 = query("SELECT * FROM produk");

// Define the number of items per page
$itemsPerPage = 4;

// Get the current page or set it to 1 if not set
$currentpage = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset for the SQL query
$offset = ($currentpage - 1) * $itemsPerPage;

// Fetch products for the current page
$produk1 = query("SELECT * FROM produk LIMIT $offset, $itemsPerPage");

// Count total number of products
$totalProducts = count(query("SELECT * FROM produk"));

// Check if there are any products before paginating
if ($totalProducts > 0) {
    // Calculate total pages
    $totalPages = ceil($totalProducts / $itemsPerPage);

    // Ensure the current page is within valid range
    $currentpage = max(1, min($currentpage, $totalPages));
} else {
    // If there are no products, set total pages to 1
    $totalPages = 1;
    $currentpage = 1;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brave ADV Lightbox</title>
    <link href="assets/img/brave-icon.png" rel="icon">
    <link href="assets/img/brave-icon.png" rel="apple-touch-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="assets/css/style.css" rel="stylesheet">
    <style>
        
    </style>
</head>

<body>
<section id="topbar" class="d-flex align-items-center">
<div class="contact-info d-flex align-items-center">
            <img src="assets/img/bravera-logo.jpg" alt="Your Logo" height="40" style="margin-right: 40px; margin-left:40px;">
            <span>
                <i class="bi"></i> Brave ADV Lightbox - Gunung Kidul - DIY
            </span>
        </div>
      <!--
      <div class="social-links d-none d-md-block">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
      -->
    </div>
  </section>
    <div class="container-fluid text-center">
        <div class="row">
            <!-- Left Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar">
                <div class="position-sticky">
                    <!-- Profile Picture -->
                    <div class="text-center mt-3">
                        <img src="assets\img\profilepic.png" alt="Profile Picture" class="rounded-circle" width="80">
                    </div><br>

                    <!-- Sidebar Menu -->
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="pill" href="dashboard.php">
                                Dasbor
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="pill" href="tambahproduk.php">
                                Tambah
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="pill" href="admin.php">
                                Produk
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="pill" href="editadmin.php">
                                Pengaturan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="pill" href="logout.php">
                                Keluar
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main id="main-admin" class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100 overflow-auto">

                        <!-- Bagian tampil data -->
            <div class="row align-items-center">
                <?php foreach ($produk1 as $row) : ?>
                    <div class="col-md-3 mb-4">
                        <img src="assets/img/<?= $row["gambar"]; ?>" class="img-fluid" style="width:100%;"><br>
                        <strong>Jenis:</strong> <?= $row["jenis"]; ?>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <strong>Nama Produk:</strong> <?= $row["nama"]; ?><br>
                        <strong>Harga:</strong> <?=formatRupiah($row["harga"]); ?><br>
                        <strong>Deskripsi:</strong> <?= $row["deskripsi"]; ?>
                    </div>
                    
                    <div class="col-md-3 mb-4">
                        <a href="editproduk.php?id=<?= $row["produkid"]; ?>" class="btn btn-warning text-dark">Edit</a><br>
                        <a href="hapusproduk.php?id=<?= $row["produkid"]; ?>" class="btn btn-danger text-dark">Hapus</a>
                    </div>
                <?php endforeach; ?>
            </div>


                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                            <li class="page-item <?php if ($i == $currentpage) echo 'active'; ?>">
                                <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>
