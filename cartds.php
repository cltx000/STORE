<?php
session_start();

// Ensure the cart is initialized
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Get product details from the form
$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$quantity = $_POST['quantity'];

// Add the product to the cart session
if (isset($_SESSION['cart'][$product_id])) {
    // If the product already exists in the cart, update the quantity
    $_SESSION['cart'][$product_id]['quantity'] += $quantity;
} else {
    // Otherwise, add the product to the cart
    $_SESSION['cart'][$product_id] = [
        'name' => $product_name,
        'price' => $product_price,
        'quantity' => $quantity
    ];
}

// Redirect to the cart page
header("Location: cart.php");
exit();
?>
