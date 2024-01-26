<?php
session_start();

if (isset($_SESSION["login"])) {
    header("location: dashboard.php");
    exit;
}

require 'function.php'; 

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Use prepared statement to prevent SQL injection
    $stmt = $koneksi->prepare("SELECT * FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Verify the password directly in the SQL query
        if (password_verify($password, $row['password'])) {
            $_SESSION["login"] = $username;
            header("location: dashboard.php");
            exit;
        } else {
            echo "<script>
                alert('Username atau password salah');
                </script>";
        }
    } else {
        echo "<script>
            alert('Username atau password salah');
            </script>";
    }

    $stmt->close();
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
    <link href="assets/img/brave-icon.png" rel="apple-touch-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/3a675effe7.js" crossorigin="anonymous"></script>
    <link href="assets/css/style.css" rel="stylesheet">
    <style>
        #loginpage {
    background: url("assets/img/bravera-logo.jpg") center;
    background-size: center;
    background-repeat: no-repeat;
    padding-top: 5%; /* Adjust the top padding to create space */
    padding-bottom: 10%;
    position: relative;
    z-index: 1;
    overflow: hidden;
}

#loginpage::before {
    content: "";
    background-color: rgba(255, 255, 255, 0.8); /* Adjust opacity as needed */
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: -1;
}

#loginform {
    padding: 20px;
    border-radius: 10px;
    position: relative;
    z-index: 1;
}

#loginform input {
    margin-bottom: 10px;
    background-color: #FFD98D;
    color: black;
    border: 1px solid #000;
}

#loginform button {
    width: 100%;
    background-color: #BCA37F;
    color: black;
    border: 1px solid #000;
}

    </style>
    <title>Login</title>
</head>
<body>

<section id="topbar" class="d-flex align-items-center">
<div class="contact-info d-flex align-items-center" style="margin-right: auto;">
    <img src="assets/img/bravera-logo.jpg" alt="Your Logo" height="40" style="margin-right: 40px; margin-left: 40px;">
    <span>
      <i class="bi"></i> Brave ADV Lightbox - Gunung Kidul - DIY
    </span>
  </div>
  <!-- Add the "LOGIN ADMIN" button with additional styling -->
  <button onclick="location.href='index.php'" class="btn btn-warning btn-sm" style="margin-right: 40px;">Halaman Utama</button>

      <!--
      <div class="social-links d-none d-md-block">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
      -->
  </section>

<section id="loginpage" class="container text-center">
    <div class="row justify-content-center">
        <h1>Halo Admin</h1>
        <h3>Selamat Datang</h3>
        <div class="col-lg-6" id="loginform">
            <h2><b>LOGIN</b></h2>
            <form action="" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>
                <!-- <a href="forgot-password.php">Lupa Password?</a> -->
                <button class="btn btn-dark" type="submit" name="submit">Login</button>
            </form>
        </div>
    </div>
</section>

</body>
</html>