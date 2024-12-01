<?php
session_start();

// Ensure selected items are provided
if (!isset($_POST['selected_items']) || empty($_POST['selected_items'])) {
    echo "<div class='container mt-5'>
            <div class='alert alert-warning'>No items selected. <a href='buynow.php'>Go back to cart</a>.</div>
          </div>";
    exit;
}

// Fetch selected items
$selectedItems = $_POST['selected_items'];
$selectedProducts = [];

foreach ($selectedItems as $index) {
    if (isset($_SESSION['cart'][$index])) {
        $selectedProducts[] = $_SESSION['cart'][$index];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Checkout</h2>
    <h4>Selected Items:</h4>
    <ul class="list-group mb-4">
        <?php foreach ($selectedProducts as $product): ?>
            <li class="list-group-item">
                <?= htmlspecialchars($product['name']) ?> - <?= htmlspecialchars($product['quantity']) ?> x $<?= htmlspecialchars($product['price']) ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <form action="process_checkout.php" method="POST">
        <h4>Personal Details</h4>
        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <h4>Shipping Address</h4>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="mb-3">
            <label for="city" class="form-label">City</label>
            <input type="text" class="form-control" id="city" name="city" required>
        </div>
        <div class="mb-3">
            <label for="zip" class="form-label">ZIP Code</label>
            <input type="text" class="form-control" id="zip" name="zip" required>
        </div>
        <div class="mb-3">
            <label for="country" class="form-label">Country</label>
            <input type="text" class="form-control" id="country" name="country" required>
        </div>

        <input type="hidden" name="selected_products" value='<?= json_encode($selectedProducts) ?>'>

        <div class="mt-4 d-flex justify-content-between">
            <a href="buynow.php" class="btn btn-secondary">Back to Cart</a>
            <button type="submit" class="btn btn-success">Confirm Order</button>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
