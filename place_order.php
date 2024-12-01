<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'technopreneurs');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data
$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$customer_name = $_POST['customer_name'];
$customer_phone = $_POST['customer_phone'];
$delivery_address = $_POST['delivery_address'];
$quantity = $_POST['quantity'];

// Check stock
$sql = "SELECT price, quantity FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

$message = "";
$message_type = "";
$order_total = 0;

if ($product && $product['quantity'] >= $quantity) {
    // Calculate total price
    $order_total = $product['price'] * $quantity;

    // Deduct stock
    $new_quantity = $product['quantity'] - $quantity;
    $update_sql = "UPDATE products SET quantity = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ii", $new_quantity, $product_id);
    $update_stmt->execute();

    // Insert order
    $order_sql = "INSERT INTO orders (product_name, customer_name, customer_phone, delivery_address, quantity, total_amount) 
    VALUES (?, ?, ?, ?, ?, ?)";
$order_stmt = $conn->prepare($order_sql);
$order_stmt->bind_param("ssssis", $product_name, $customer_name, $customer_phone, $delivery_address, $quantity, $order_total);
$order_stmt->execute();


    // Order placed successfully
    $message = "Order placed successfully!";
    $message_type = "success";
} else {
    $message = "Sorry, the requested quantity is out of stock!";
    $message_type = "danger";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Receipt</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <!-- Alert Message -->
        <div class="alert alert-<?= $message_type ?>" role="alert">
            <?= $message ?>
        </div>

        <?php if ($message_type === "success") { ?>
        <h3>Order Receipt</h3>
        <table class="table">
            <tbody>
                <tr>
                    <th>Product Name:</th>
                    <td><?= htmlspecialchars($product_name) ?></td>
                </tr>
                <tr>
                    <th>Quantity:</th>
                    <td><?= htmlspecialchars($quantity) ?></td>
                </tr>
                <tr>
                    <th>Customer Name:</th>
                    <td><?= htmlspecialchars($customer_name) ?></td>
                </tr>
                <tr>
                    <th>Phone Number:</th>
                    <td><?= htmlspecialchars($customer_phone) ?></td>
                </tr>
                <tr>
                    <th>Delivery Address:</th>
                    <td><?= nl2br(htmlspecialchars($delivery_address)) ?></td>
                </tr>
                <tr>
                    <th>Total Amount:</th>
                    <td>₱<?= number_format($order_total, 2) ?></td>
                </tr>
            </tbody>
        </table>
        <hr>
        <p class="text-center">Thank you for shopping with us!</p>
        <div class="text-center">
            <a href="index.php" class="btn btn-primary">Back to Products</a>
        </div>
        <?php } ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
