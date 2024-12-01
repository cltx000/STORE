<?php
session_start();

// Fetch submitted data
if (!isset($_POST['name'], $_POST['email'], $_POST['address'], $_POST['selected_products'])) {
    echo "<div class='container mt-5'>
            <div class='alert alert-danger'>Invalid checkout data. <a href='checkout.php'>Try again</a>.</div>
          </div>";
    exit;
}

// Simulate order processing
$selectedProducts = json_decode($_POST['selected_products'], true);
$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$address = htmlspecialchars($_POST['address']);


$_SESSION['cart'] = [];

echo "<div class='container mt-5'>
        <div class='alert alert-success'>Thank you, $name! Your order has been placed successfully. A confirmation email has been sent to $email.</div>
        <a href='landing.html' class='btn btn-primary'>Back to Shop</a>
      </div>";
?>
