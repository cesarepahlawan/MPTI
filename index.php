<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Brave ADV Lightbox</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/brave-icon.png" rel="icon">
  <link href="assets/img/brave-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Top Bar ======= -->
  
<section id="topbar" class="d-flex align-items-center">
<div class="contact-info d-flex align-items-center" style="margin-right: auto;">
    <img src="assets/img/bravera-logo.jpg" alt="Your Logo" height="40" style="margin-right: 40px; margin-left: 40px;">
    <span>
      <i class="bi"></i> Brave ADV Lightbox - Gunung Kidul - DIY
    </span>
  </div>
  <!-- Add the "LOGIN ADMIN" button with additional styling -->
  <button onclick="location.href='login.php'" class="btn btn-success btn-sm" style="margin-right: 40px;">Login Admin</button>

      <!--
      <div class="social-links d-none d-md-block">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
      -->
  </section>

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li class="dropdown"><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#services">Produk Kami</a></li>
          <li><a class="nav-link scrollto" href="#services2">Cara Pemesanan</a></li>
          <li><a class="nav-link scrollto" href="#footer">Contact</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container position-relative" data-aos="fade-up" data-aos-delay="500">
      <h1>Selamat Datang</h1>
      <h1>Di Brave ADV Lightbox</h1>
      <a href="#about" class="btn-get-started scrollto">Tentang Kami</a>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content" data-aos="fade-up">
            <h3>Tentang Kami</h3>
            <p class="">
          Kami adalah Pengrajin Banner, Neonbox, dan Acrilic. 
          Kami berlokasi di Gunung Kidul.
          Bahan yang kami gunakan menggunakan bahan-bahan berkualitas dengan harga terjangkau.
            </p>
          </div>
        </div>

      </div>
      
    </section><!-- End About Section -->

<!-- ======= Produk ======= -->
<section id="services" class="services">
  <div class="container">

    <div class="section-title">
      <span>Produk Kami</span>
      <h2>Produk Kami</h2>
      <h3>Berikut Produk-Produk Yang Kami Sediakan</h3>
    </div>

    <!-- <?php
    require 'function.php';

    $jenis = $_GET['jenis'] ?? 'all';
    $produk = getProductsByType($jenis);

    $jenis_produk = array();
    foreach ($produk as $row) {
        // Fetch the admin's phone number from the database
        $adminPhoneNumber = getAdminPhoneNumber(); // Implement this function to fetch the admin's phone number

        $pesan = 'Halo, saya tertarik dengan produk ' . $row['nama'] . '. Mohon informasi lebih lanjut.';
        $pesan_url = generateWhatsAppLink($adminPhoneNumber, $pesan);
        $jenis_produk[] = $row['jenis'];
    }
    $jenis_produk = array_unique($jenis_produk);
    sort($jenis_produk);
?> -->


<!-- Filter Form - Button Group -->
<div class="row mb-3" align="center">
  <form method="get" class="w-100">
    <div class="btn-group" role="group" aria-label="Filter by jenis">
      <button type="submit" class="btn <?= $jenis === 'all' ? 'btn-success' : 'btn-secondary'; ?>" name="jenis" value="all">Semua produk</button>
      <?php foreach ($jenis_produk as $jenis_option): ?>
        <button type="submit" class="btn <?= $jenis === $jenis_option ? 'btn-success' : 'btn-secondary'; ?>" name="jenis" value="<?= $jenis_option; ?>"><?= $jenis_option; ?></button>
      <?php endforeach; ?>
    </div>
  </form>
</div>

  </div>
</section><!-- End Produk Section -->

<!-- Carousel -->
<div id="produkCarousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <?php $active = true; ?>
    <!-- Loop produk -->
<?php foreach ($produk as $index => $row): ?>
  <?php if ($index % 3 == 0): ?>
    <div class="carousel-item<?= $active ? ' active' : '' ?>">
      <div class="container">
        <div class="row justify-content-center">
  <?php endif; ?>

  <div class="col">
    <div class="card" style="width: 18rem;">
      <img src="assets/img/<?= $row['gambar']; ?>" class="card-img-top" alt="..." data-bs-toggle="modal" data-bs-target="#detailProdukModal<?= $index; ?>">
      <div class="card-body">
        <!-- Menampilkan detail produk -->
        <h4 class="card-title"><?= $row['nama']; ?></h4>
        <h5 class="card-title"><?= $row['jenis']; ?></h5>
        <p class="card-text"><?= formatRupiah($row['harga']); ?></p>
        <p class="card-text"><?= $row['deskripsi']; ?></p>
        <button class="btn btn-success pesan-btn" data-bs-toggle="modal" data-bs-target="#detailProdukModal<?= $index; ?>">Pesan di WhatsApp</button>

      </div>
    </div>
  </div>

  <!-- Modal Detail Produk untuk setiap produk -->
  <div class="modal fade" id="detailProdukModal<?= $index; ?>" tabindex="-1" aria-labelledby="detailProdukModalLabel<?= $index; ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailProdukModalLabel<?= $index; ?>">Detail Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Konten detail produk -->
                    <h4><?= $row['nama']; ?></h4>
                    <h5><?= $row['jenis']; ?></h5>
                    <p><?= formatRupiah($row['harga']); ?></p>
                    <p><?= $row['deskripsi']; ?></p>
                    <!-- Add the quantity input field -->
                    <form method="post" action="order.php">
                        <label for="quantity">Jumlah Pesanan:</label>
                        <input type="number" name="quantity" id="quantity" value="1" min="1">
                        <input type="hidden" name="product_name" value="<?= $row['nama']; ?>">
                        <input type="hidden" name="product_quantity" value="<?= $row['jenis']; ?>">
                        <input type="hidden" name="product_price" value="<?= $row['harga']; ?>">
                        <button type="submit" class="btn btn-success">Pesan di WhatsApp</button>
                    </form>
                    <!-- End of quantity input field -->
                </div>
            </div>
        </div>
    </div>

  <?php if (($index + 1) % 3 == 0 || $index == count($produk) - 1): ?>
        </div>
      </div>
    </div>
    <?php $active = false; ?>
  <?php endif; ?>
<?php endforeach; ?>

  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#produkCarousel" data-bs-slide="prev">
  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
  <span class="visually-hidden">Previous</span>
</button>
<button class="carousel-control-next" type="button" data-bs-target="#produkCarousel" data-bs-slide="next">
  <span class="carousel-control-next-icon" aria-hidden="true"></span>
  <span class="visually-hidden">Next</span>
</button>

</div>





        <!-- ======= Cara Pemesanan ======= -->
<section id="services2" class="services2">
  <div class="container">

    <div class="section-title">
      <h3>Cara Pemesanan</h3>
    </div>

    <section id="about" class="about">
      <div class="container">
        <div class="">
          <h4>Tahap Pemesanan</h4>
          <p>
              1. Pilih produk di atas.<br>
              2. Klik "Pesan di WhatsApp" pada produk pilihan.<br> 
              3. Kirimkan pesan untuk pemesanan.<br>
              4. Tim kami akan merespons dan memberikan informasi lebih lanjut.<br>
              5. Tunggu konfirmasi dan ikuti langkah selanjutnya.
          </p>
        </div>
      </div>
    </section><!-- End Cara Pemesanan-->

  </div>
</section>


  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-4 col-md-6">
            <div class="footer-info">
            <h3>Brave ADV Lightbox</h3>
                        <p>
                            <strong>No. HP :</strong> <?php echo getAdminPhoneNumber(); ?><br>
                            <strong>Alamat Kami :</strong> 
                            <a href="https://maps.app.goo.gl/9gkPerJ7RpEv4pFt7" target="_blank">
                            2948+5HM, Jl. Parang Tritis Panggang, Trasih, Giriasih, Kec. Purwosari, Kabupaten Gunung Kidul, Daerah Istimewa Yogyakarta 55872                            </a>
                        </p>
              <div class="social-links mt-3">
              <a href="https://wa.me/<?php echo getAdminPhoneNumber(); ?>" class="whatsapp" target="_blank"><i class="bx bxl-whatsapp"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#hero">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#about">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#services">Services</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#services">Huruf timbul akrilik menyala</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#services">Neon Box</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#services">Kusen almunium</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#services">Stempel</a></li>

            </ul>
          </div>
          <!--
          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>

          </div>
          -->

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; 2023 <strong><span>Brave ADV</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/day-multipurpose-html-template-for-free/ -->
        Develop by </a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  
<!-- Modal Detail Produk -->
<div class="modal fade" id="detailProdukModal" tabindex="-1" aria-labelledby="detailProdukModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailProdukModalLabel">Detail Produk</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Tempatkan konten detail produk di sini -->
        <div id="detailProdukContent"></div>
      </div>
    </div>
  </div>
</div>

</body>

</html>