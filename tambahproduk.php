<?php
require 'function.php';
session_start();
if (!isset($_SESSION["login"])) {
    header("location:login.php");
    exit;
}

$produk = "SELECT COLUMN_TYPE AS num FROM INFORMATION_SCHEMA.COLUMNS WHERE COLUMN_NAME = 'jenis'";
$enum = enum($produk);
if (isset($_POST["submit"])) {
    $nama = $_POST["nama"];
    $harga = $_POST["harga"];
    $jenis = $_POST["jenis"];
    $deskripsi = $_POST["deskripsi"];

    // Additional server-side validation
    if (!validateName($nama)) {
        echo "<script>
            alert('Invalid name. Please enter a valid name.');
            </script>";
    } elseif (!validatePrice($harga)) {
        echo "<script>
            alert('Invalid price. Please enter a valid numeric value.');
            </script>";
    } elseif (!validateType($jenis, $enum)) {
        echo "<script>
            alert('Invalid product type. Please select a valid type.');
            </script>";
    } elseif (!validateDescription($deskripsi)) {
        echo "<script>
            alert('Description cannot be empty. Please provide a description.');
            </script>";
    } else {
        // If all validations pass, proceed with database operation
        if (tambahproduk($_POST) > 0) {
            echo "<script>
                alert('Produk baru berhasil ditambahkan');
                document.location.href='admin.php';
                </script>";
        } else {
            echo "<script>
                alert('Produk gagal ditambahkan');
                document.location.href='admin.php';
                </script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brave ADV Lightbox</title>
    <!-- Favicons -->
    <link href="assets/img/brave-icon.png" rel="icon">
    <link href="assets/img/brave-icon.png" rel="apple-touch-icon">    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- Add this in the head section of your HTML -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>


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
                            <a class="nav-link active" data-bs-toggle="pill" href="tambahproduk.php">
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

            <!-- Main Content -->
            <main id="main-admin" class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100 overflow-auto">
                <div class="container text-center">
                    <h2>Tambah Produk</h2>
                    <!-- Form tambah produk -->
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nama" style="float:left;">Nama</label><input class="form-control" type="text" id="nama" name="nama" pattern="[A-Za-z ]+" title="[A-Za-z ]" placeholder="Nama Produk" required>
                            <br><label for="harga" style="float:left;">Harga</label><input class="form-control" type="number" id="harga" name="harga" placeholder="Harga Produk" min="0" required>
                            <br><label for="jenis" style="float:left;">Jenis</label>
                            <select class="form-select" id="jenis" name="jenis" style="width: 100%;">
                                <?php foreach ($enum as $value) : ?>
                                    <option value="<?= $value; ?>"><?= $value; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <br><label for="deskripsi" style="float:left;">Deskripsi</label><textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi Produk" rows="5" cols="50" required></textarea>
                            <br><label for="gambar" style="float:left;">Gambar</label><input class="form-control" type="file" id="gambar" name="gambar" placeholder="Gambar"><small class="text-muted">Upload hanya file PNG, JPG, atau JPEG.</small>
                            <br>
                            <button class="btn btn-success" type="submit" name="submit">Tambah</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
</body>

</html>
