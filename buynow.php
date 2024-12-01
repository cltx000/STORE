<?php
session_start();

// Ensure the cart is initialized
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<div class='container mt-5'>
            <div class='alert alert-warning'>Your cart is empty. <a href='landing.php'>Go back to shop</a>.</div>
          </div>";
    exit;
}

// Handle deletion of selected items
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_items'])) {
    $selectedItems = $_POST['selected_items'] ?? [];
    foreach ($selectedItems as $index) {
        unset($_SESSION['cart'][$index]); // Remove the selected items from the cart
    }
    $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex the cart array
    header('Location: buynow.php'); // Refresh the page
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Now</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Your Cart</h2>
    <form action="buynow.php" method="POST">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Select</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (!empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $index => $item) {
                    $productName = htmlspecialchars($item['name']);
                    $quantity = (int)$item['quantity'];
                    $price = (float)$item['price'];
                    $total = $quantity * $price;

                    echo "<tr>
                            <td>
                                <input 
                                    type='checkbox' 
                                    class='item-checkbox' 
                                    data-total='$total' 
                                    name='selected_items[]' 
                                    value='$index'
                                >
                            </td>
                            <td>$productName</td>
                            <td>$quantity</td>
                            <td>\$$price</td>
                            <td>\$$total</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='text-center'>No items in cart</td></tr>";
            }
            ?>
            </tbody>
        </table>
        <div class="text-end">
            <h4>
                Selected Total Amount: 
                $<span id="selectedTotal">0.00</span>
            </h4>
        </div>
        <div class="mt-4 d-flex justify-content-between">
            <a href="landing.html" class="btn btn-secondary">Continue Shopping</a>
            <button type="submit" name="delete_items" class="btn btn-danger">Delete Selected Items</button>
            <button type="submit" formaction="checkout.php" class="btn btn-primary">Proceed to Checkout</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Update the total amount when items are selected or deselected
    document.querySelectorAll('.item-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            let total = 0;
            document.querySelectorAll('.item-checkbox:checked').forEach(selected => {
                total += parseFloat(selected.getAttribute('data-total'));
            });
            document.getElementById('selectedTotal').textContent = total.toFixed(2);
        });
    });
</script>
</body>
</html>
