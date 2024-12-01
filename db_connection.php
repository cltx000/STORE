<?php
// db_connection.php

// Database credentials
$servername = "localhost"; // Database server (host)
$username = "root";        // Database username
$password = "";            // Database password (empty for local development)
$dbname = "technopreneurs"; // Database name

// Set the DSN (Data Source Name)
$dsn = "mysql:host=$servername;dbname=$dbname;charset=utf8";

// Create a PDO instance
$pdo = new PDO($dsn, $username, $password);

// Set the PDO error mode to exception for better error handling (still set, but not caught)
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// If you want to test the connection, uncomment the line below
// echo "Connected successfully to the database.";

// Function to get product details by its ID
function getProductById($productId) {
    global $pdo;

    // Prepare a SQL statement to get the product by ID
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
    $stmt->bindParam(':id', $productId, PDO::PARAM_INT);
    
    // Execute the statement
    $stmt->execute();
    
    // Fetch the product details (returns associative array)
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if product exists, otherwise return null
    return $product ? $product : null;
}
?>
