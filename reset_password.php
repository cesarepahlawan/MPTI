<?php
// reset_password.php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

session_start();

require 'function.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];

    // Validasi alamat email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Generate token reset password
        $token = bin2hex(random_bytes(32));

        // Simpan token ke database bersamaan dengan email dan timestamp
        $timestamp = time();
        $query = "INSERT INTO password_reset (email, token, timestamp) VALUES (?, ?, ?)";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("ssi", $email, $token, $timestamp);
        $stmt->execute();
        $stmt->close();

        // Kirim email reset password menggunakan PHPMailer
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF; // You can set this to DEBUG_SERVER, DEBUG_OFF, etc.
        $mail->isSMTP();
        $mail->Host       = 'smtp.example.com'; // Your SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'your_username@example.com'; // Your SMTP username
        $mail->Password   = 'your_smtp_password'; // Your SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587; // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('admin@example.com', 'Brave ADV Lightbox');
        $mail->addAddress($email); // Add a recipient

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Reset Password - Brave ADV Lightbox';
        $mail->Body    = "Halo Admin,\n\nJika Anda meminta reset password, silakan klik link berikut:\n$reset_link\n\nJika Anda tidak merasa melakukan permintaan ini, abaikan pesan ini.";

        $mail->send();
        // Set pesan sukses
        $_SESSION['success'] = "Instruksi reset password telah dikirim ke alamat email Anda.";
    } catch (Exception $e) {
        // Set pesan error
        $_SESSION['error'] = "Pesan tidak dapat dikirim. Error: {$mail->ErrorInfo}";
    }

    header("Location: reset_password.php");
    exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="assets/img/brave-icon.png" rel="icon">
    <link href="assets/img/brave-icon.png" rel="apple-touch-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/3a675effe7.js" crossorigin="anonymous"></script>
    <link href="assets/css/style.css" rel="stylesheet">
    <style>
        #resetpasswordpage {
            background: url("assets/img/bravera-logo.jpg") center;
            background-size: center;
            background-repeat: no-repeat;
            padding-top: 5%;
            padding-bottom: 10%;
            position: relative;
            z-index: 1;
            overflow: hidden;
        }

        #resetpasswordpage::before {
            content: "";
            background-color: rgba(255, 255, 255, 0.8);
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: -1;
        }

        #resetpasswordform {
            padding: 20px;
            border-radius: 10px;
            position: relative;
            z-index: 1;
        }

        #resetpasswordform input {
            margin-bottom: 10px;
            background-color: #FFD98D;
            color: black;
            border: 1px solid #000;
        }

        #resetpasswordform button {
            width: 100%;
            background-color: #BCA37F;
            color: black;
            border: 1px solid #000;
        }
    </style>
</head>
<body>

<section id="resetpasswordpage" class="container text-center">
    <div class="row justify-content-center">
        <h1>Lupa Password?</h1>
        <h3>Masukkan alamat email Anda untuk reset password.</h3>
        <div class="col-lg-6" id="resetpasswordform">
            <!-- Tampilkan pesan sukses/error jika ada -->
            <?php if (isset($_SESSION['success'])) : ?>
                <div class="alert alert-success" role="alert">
                    <?= $_SESSION['success']; ?>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= $_SESSION['error']; ?>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <!-- Form reset password -->
            <form action="" method="post">
                <div class="form-group">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Alamat Email" required>
                </div>
                <button class="btn btn-dark" type="submit" name="submit">Reset Password</button>
            </form>
        </div>
    </div>
</section>

</body>
</html>
            