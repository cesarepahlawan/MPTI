<?php
require 'function.php';
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

// Fetch the current admin details
$currentUsername = $_SESSION["login"];
$currentAdmin = query("SELECT * FROM admin WHERE username = ?", 's', $currentUsername);

// Check if any result is returned
if (!$currentAdmin || empty($currentAdmin)) {
    // Handle the case where the current admin details are not found
    echo "Error: Current admin details not found.";
    exit;
}

// Use the first row (assuming there's only one admin with a given username)
$currentAdmin = $currentAdmin[0];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get new password and password confirmation from the form
    $newPassword = $_POST["new_password"];
    $confirmPassword = $_POST["confirm_password"];

    // Validate and update the admin details
    if (!empty($newPassword)) {
        // Check if the new password and confirmation match
        if ($newPassword == $confirmPassword) {
            // Update password (you might want to hash it before storing in the database)
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $updatePasswordResult = query("UPDATE admin SET password = ? WHERE adminid = ?", 'si', $hashedPassword, $currentAdmin['adminid']);

            if ($updatePasswordResult === false) {
                // Handle the error if the update fails
                echo "Error updating password.";
            } else {
                // Bootstrap alert for successful password update
                echo '<script>alert("Password updated successfully.");</script>';
                header("Refresh: 1");

            }
        } else {
            // Bootstrap alert for password mismatch
            echo '<script>alert("Password and confirmation do not match.");</script>';
        }
    }

    // Check if WhatsApp number is submitted and different from the current value
    $newWhatsAppNumber = $_POST["whatsapp_number"];
    if (!empty($newWhatsAppNumber) && $newWhatsAppNumber != $currentAdmin['whatsapp_number']) {
        // Update WhatsApp number
        $updateWhatsAppNumberResult = query("UPDATE admin SET whatsapp_number = ? WHERE adminid = ?", 'si', $newWhatsAppNumber, $currentAdmin['adminid']);

        if ($updateWhatsAppNumberResult === false) {
            // Handle the error if the update fails
            echo '<div class="alert alert-danger" role="alert">Error updating WhatsApp number.</div>';
        } else {
            // Bootstrap alert for successful WhatsApp number update
            echo '<script>alert("WhatsApp number updated successfully.");</script>';
            header("Refresh: 1");

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
                            <a class="nav-link" data-bs-toggle="pill" href="admin.php">
                                Produk
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="pill" href="editadmin.php">
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
                    <h2>Pengaturan Akun</h2>
                    <form method="post" action="">
                
                <!-- Add an oninput event to the WhatsApp number input field -->
                <div class="mb-3">
                    <label for="whatsapp_number" class="form-label">Nomor Whatsapp</label>
                    <div class="input-group">
                        <!-- Display the fixed prefix as text -->
                        <span class="input-group-text">+62</span>
                        <!-- Input field for the phone number -->
                        <input placeholder="contoh: 8186009833" type="number" class="form-control" id="whatsapp_number" name="whatsapp_number" oninput="addPrefix(this)" value="<?php echo htmlspecialchars(substr($currentAdmin['whatsapp_number'], 2)); ?>">
                    </div>
                </div>
                <!-- Add JavaScript function to automatically add the prefix -->
                <script>
                    function addPrefix(input) {
                        // Ensure the input always begins with "62"
                        if (!input.value.startsWith('62')) {
                            input.value = '62' + input.value;
                        }
                    }
                </script>
                <div class="mb-3">
                    <label for="new_password" class="form-label">Password Baru</label>
                    <input placeholder="masukkan password baru" type="password" class="form-control" id="new_password" name="new_password">
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Konfirmasi Password Baru</label>
                    <input placeholder="masukkan konfirmasi password baru" type="password" class="form-control" id="confirm_password" name="confirm_password">
                </div>
                <button type="submit" class="btn btn-warning">Simpan</button>
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
