<?php
require 'function.php';
session_start();
if (!isset($_SESSION["login"])) {
    header("location:login.php");
    exit;
}

$produk1 = query("SELECT * FROM produk");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brave ADV Lightbox</title>
    <!-- Favicons -->
    <link href="assets/img/brave-icon.png" rel="icon">
    <link href="assets/img/brave-icon.png" rel="apple-touch-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="assets/css/style.css" rel="stylesheet">
    <style>
    .welcome-container {
        margin-top: 50px; /* Adjust margin as needed */
        border: 5px solid #ECE1E1; /* Border color */
        padding: 20px;
        border-radius: 10px;
    }

    .welcome-heading {
        color: #bca37f; /* Text color */
    }

    .img-fluid {
        max-width: 60%;
        height: auto;
    }
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
                            <a class="nav-link active" data-bs-toggle="pill" href="dashboard.php">
                                Dasbor
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="pill" href="tambahproduk.php">
                                Tambah
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="pill" href="admin.php">
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
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100 overflow-auto">
    <!-- Add your dashboard content here -->
    <div class="welcome-container text-center">
        <div class="row">
            <div class="col-md-6">
                <h1 class="welcome-heading">Halo</h1>
                <h1 class="welcome-heading">Selamat Datang Admin!</h1>
            </div>
            <div class="col-md-4">
                <img src="assets/img/dashboardhelo.png" alt="Your Image" class="img-fluid">
            </div>
        </div>
        
    </div>
    <div class="welcome-container text-center">
        <div class="row">
            <div class="col-md-8">
                <h2 class="welcome-heading">Sebagai Admin, Anda mempunyai akses untuk mengupload, edit, dan menghapus konten</h1>
            </div>
        </div>
        
    </div>
</main>

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>
