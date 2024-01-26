<?php
// reset_password_confirmation.php
session_start();

require 'function.php';

if (isset($_GET['email']) && isset($_GET['token'])) {
    $email = $_GET['email'];
    $token = $_GET['token'];

    // Validate email and token (you should check these against your database)
    // If valid, proceed with updating the password or any other necessary action

    // Display a confirmation message
    $confirmationMessage = "Your password has been successfully reset. You can now log in with your new password.";
} else {
    // If email or token is not set, redirect to the reset password page
    header("Location: reset_password.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Confirmation</title>
    <link href="assets/img/brave-icon.png" rel="icon">
    <link href="assets/img/brave-icon.png" rel="apple-touch-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/3a675effe7.js" crossorigin="anonymous"></script>
    <link href="assets/css/style.css" rel="stylesheet">
    <style>
        #confirmationpage {
            background: url("assets/img/bravera-logo.jpg") center;
            background-size: center;
            background-repeat: no-repeat;
            padding-top: 5%;
            padding-bottom: 10%;
            position: relative;
            z-index: 1;
            overflow: hidden;
        }

        #confirmationpage::before {
            content: "";
            background-color: rgba(255, 255, 255, 0.8);
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: -1;
        }

        #confirmationcontent {
            padding: 20px;
            border-radius: 10px;
            position: relative;
            z-index: 1;
        }

        #confirmationcontent button {
            width: 100%;
            background-color: #BCA37F;
            color: black;
            border: 1px solid #000;
        }
    </style>
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
    </section>

    <section id="confirmationpage" class="container text-center">
        <div class="row justify-content-center">
            <h1>Password Reset Confirmation</h1>
            <div class="col-lg-6" id="confirmationcontent">
                <?php if (isset($confirmationMessage)) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= $confirmationMessage; ?>
                    </div>
                <?php else : ?>
                    <div class="alert alert-danger" role="alert">
                        Invalid email or token. Please try resetting your password again.
                    </div>
                <?php endif; ?>
                <button onclick="location.href='index.php'" class="btn btn-dark">Back to Homepage</button>
            </div>
        </div>
    </section>
</body>
</html>
