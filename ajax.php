<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get parameters from the AJAX request
$search = isset($_GET['search']) ? $_GET['search'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';
$price = isset($_GET['price']) ? $_GET['price'] : '1000';

// Build the SQL query
$query = "SELECT * FROM products WHERE price <= ?";

if ($search != '') {
    $query .= " AND name LIKE ?";
}

if ($category != '') {
    $query .= " AND category = ?";
}

// Prepare and execute the query
$stmt = $conn->prepare($query);
$searchTerm = "%" . $search . "%";
if ($category != '') {
    $stmt->bind_param("iss", $price, $searchTerm, $category);
} else {
    $stmt->bind_param("is", $price, $searchTerm);
}

$stmt->execute();
$result = $stmt->get_result();

// Display the products
while ($row = $result->fetch_assoc()) {
    echo "<div class='product-item'>";
    echo "<img src='" . $row['image'] . "' alt='" . $row['name'] . "' />";
    echo "<h3>" . $row['name'] . "</h3>";
    echo "<p>" . $row['description'] . "</p>";
    echo "<p><strong>$" . $row['price'] . "</strong></p>";
    echo "</div>";
}

$stmt->close();
$conn->close();
?>
