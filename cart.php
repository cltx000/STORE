<?php
session_start();

// Ensure the cart is initialized
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Check for success message and store it in a variable
$successMessage = '';
if (isset($_SESSION['success_message'])) {
    $successMessage = $_SESSION['success_message'];
    unset($_SESSION['success_message']); // Clear the message after showing it
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'technopreneurs');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <!-- Success Alert -->
    <?php if (!empty($successMessage)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($successMessage); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <h2 class="text-center mb-4">Our Products</h2>
    <div class="row">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "
                <div class='col-md-4 mb-4'>
                    <div class='card'>
                        <div class='card-body'>
                            <h5 class='card-title'>{$row['name']}</h5>
                            <p class='card-text'>Price: \${$row['price']}</p>
                            <p class='card-text'>Available: {$row['quantity']} in stock</p>
                            <!-- Button to trigger modal -->
                            <button class='btn btn-success' data-bs-toggle='modal' data-bs-target='#quantityModal' data-product-id='{$row['id']}' data-product-name='{$row['name']}' data-product-price='{$row['price']}'>
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>";
            }
        } else {
            echo "<p>No products found</p>";
        }

        $conn->close();
        ?>
    </div>
    <hr>
    <a href="buynow.php" class="btn btn-primary">View Cart</a>
</div>

<!-- Modal for Quantity Input -->
<div class="modal fade" id="quantityModal" tabindex="-1" aria-labelledby="quantityModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="addingtodart.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="quantityModalLabel">Select Quantity</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="product_id" id="product_id">
                    <input type="hidden" name="product_name" id="product_name">
                    <input type="hidden" name="product_price" id="product_price">

                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" min="1" value="1" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Set the product details when the "Add to Cart" button is clicked
    const quantityModal = document.getElementById('quantityModal');
    quantityModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget;
        const productId = button.getAttribute('data-product-id');
        const productName = button.getAttribute('data-product-name');
        const productPrice = button.getAttribute('data-product-price');

        document.getElementById('product_id').value = productId;
        document.getElementById('product_name').value = productName;
        document.getElementById('product_price').value = productPrice;
    });
</script>

</body>
</html>
