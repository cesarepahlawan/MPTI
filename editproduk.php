<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("location:login.php");
    exit;
}
require 'function.php';

$id = $_GET["id"];
$produk = query("SELECT * FROM produk WHERE produkid = ?", "i", $id);

$produks = "SELECT COLUMN_TYPE AS num FROM INFORMATION_SCHEMA.COLUMNS WHERE COLUMN_NAME = 'jenis'";
$enum = enum($produks);
$i = 0;
if (isset($_POST["submit"])) {
    // Validasi CSRF Token di sini
    if ($_POST['csrf_token'] === $_SESSION['csrf_token']) {
        $result = editproduk($_POST);
        if ($result > 0) {
            echo "<script>
                alert('Data berhasil diubah');
                window.location.href='admin.php';
                </script>";
        } else {
            echo "<script>
                alert('Gagal mengubah data. Silakan coba lagi atau hubungi administrator.');
                </script>";
        }
    } else {
        echo "<script>
            alert('CSRF token tidak valid.');
            window.location.href='editproduk.php?id=$id';
            </script>";
    }
}

$csrf_token = bin2hex(random_bytes(32));
$_SESSION['csrf_token'] = $csrf_token;
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Brave ADV Lightbox</title>
    <!-- Favicons -->
    <link href="assets/img/brave-icon.png" rel="icon">
    <link href="assets/img/brave-icon.png" rel="apple-touch-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/3a675effe7.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="assets/css/style.css" rel="stylesheet">
 
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

            <main id="main-admin" class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100 overflow-auto">
                <div class="container text-center">
                <div>
                    <div>
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Bagian formulir untuk Edit Produk -->
                                <form action="" method="post" enctype="multipart/form-data">
                                    <?php foreach ($produk as $row) : ?>
                                        <input type="hidden" name="old" value="<?= $row["gambar"]; ?>">
                                        <input type="hidden" name="id" value="<?= $row["produkid"]; ?>">

                                        <!-- Menampilkan gambar produk -->
                                        <img src="assets/img/<?= $row['gambar'];?>" class="card-img-top img-fluid img-thumbnail"  alt="...">

                                        <!-- Form Group untuk Nama -->
                                        <div class="form-group py-1">
                                            <label for="nama" style="float:left;">Nama</label>
                                            <input class="form-control" type="text" name="nama" value="<?= $row["nama"]; ?>" required>
                                        </div>

                                        <!-- Form Group untuk Harga -->
                                        <div class="form-group py-1">
                                            <label for="harga" style="float:left;">Harga</label>
                                            <input class="form-control" type="number" min="0" name="harga" value="<?= $row["harga"]; ?>" required>
                                        </div>

                                        <!-- Form Group untuk Deskripsi -->
                                        <div class="form-group py-1">
                                            <label for="deskripsi" style="float:left;">Deskripsi</label>
                                            <textarea class="form-control" name="deskripsi" rows="5" cols="50" required><?= $row["deskripsi"]; ?></textarea>
                                        </div>

                                        <!-- Form Group untuk Gambar -->
                                        <div class="form-group py-1">
                                            <label for="deskripsi" style="float:left;">Gambar</label>
                                            <input class="form-control" type="file" id="gambar" name="gambar" placeholder="gambar">
                                        </div>

                                        <!-- Form Group untuk Jenis -->
                                        <div class="form-group py-2">
                                            <label for="jenis" style="float:left;">Jenis</label>
                                            <select class="form-select" aria-label="Default select example" name="jenis" id="jenis">
                                                <?php for($i = 0; $i < count($enum); $i++){
                                                    if($enum[$i] == $jenis){?>
                                                        <option value="<?= $enum[$i];?>" Selected><?= $enum[$i];?></option>
                                                    <?php } else { ?>
                                                        <option value="<?= $enum[$i];?>"><?= $enum[$i];?></option>
                                                    <?php }}?>
                                            </select>
                                        </div>

                                        <!-- Hidden CSRF Token -->
                                        <input type="hidden" name="csrf_token" value="<?= $csrf_token; ?>">

                                        <!-- Tombol Edit -->
                                        <button class="btn btn-warning" type="submit" name="submit">Edit</button>
                                    <?php endforeach; ?>
                                </form>

                            </div>
                        </div>
                    </div>
                    
            </main>
        </div>
    </div>
   
    <script>
    inputfile.onchange = function(){
        if(this.files[0].size > 41000000){
            alert("Batas ukuran size 40MB");
            this.value = "";
        };
    };
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
</body>

</html>