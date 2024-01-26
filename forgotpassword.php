<?php
require 'vendor/autoload.php'; // Load PHPMailer

// Initialize PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Your database connection code
require 'function.php'; // Include your database connection and other necessary functions

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the user's email from the form
    $email = $_POST['email'] ?? '';

    // Check if the email exists in the database
    $stmt = $koneksi->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // Generate a unique token
        $token = bin2hex(random_bytes(32));

        // Store the token and timestamp in the password_reset table
        $timestamp = time();
        $stmt = $koneksi->prepare("INSERT INTO password_reset (email, token, timestamp) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $email, $token, $timestamp);
        $stmt->execute();

        // Send the password reset email
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->SMTPDebug = 0; // Enable verbose debug output
            $mail->isSMTP(); // Set mailer to use SMTP
            $mail->Host = 'smtp.example.com'; // Specify main and backup SMTP servers
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = 'your@example.com'; // SMTP username
            $mail->Password = 'your_password'; // SMTP password
            $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587; // TCP port to connect to

            // Recipients
            $mail->setFrom('your@example.com', 'Your Name');
            $mail->addAddress($email); // Add a recipient

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = 'Password Reset';
            $mail->Body = 'Click the following link to reset your password: <a href="http://yourwebsite.com/reset-password.php?token=' . $token . '">Reset Password</a>';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    } else {
        echo 'Email not found';
    }
}
?>
