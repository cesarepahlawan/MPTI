<?php
// order.php
require 'function.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $quantity = $_POST['quantity'] ?? 1;
    $product_name = $_POST['product_name'] ?? '';
    $product_quantity = $_POST['product_quantity'] ?? '';
    $product_price = $_POST['product_price'] ?? '';

    // Convert the quantity and price to numeric values
    $quantity = intval($quantity);
    $product_price = floatval($product_price);

    // Calculate the total price
    $total_price = $quantity * $product_price;

    // Create the WhatsApp message with total price
    $pesan = "Halo, saya ingin memesan {$quantity} buah {$product_name}. Total harga: " . formatRupiah($total_price);

    // Redirect to the WhatsApp API link
    $whatsapp_link = generateWhatsAppLink(getAdminPhoneNumber(), $pesan);
    header("Location: $whatsapp_link");
    exit();
} else {
    // If someone tries to access order.php directly without submitting the form, redirect them to the homepage
    header("Location: index.php");
    exit();
}
?>
