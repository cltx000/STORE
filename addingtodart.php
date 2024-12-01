<?php
session_start();

// Ensure the cart is initialized
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Check if product_id is provided
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $quantity = $_POST['quantity'];

    // Add product to cart
    $_SESSION['cart'][$product_id] = [
        'name' => $product_name,
        'price' => $product_price,
        'quantity' => $quantity
    ];




    // Set success message
    $_SESSION['success_message'] = "Success adding to your cart";

    // Redirect back to the product page or cart page
    header('Location: cart.php'); // Update with your product page filename
    exit;
}
?>
