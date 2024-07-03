<?php
// Check if a file was uploaded
if (isset($_FILES['file']) && $_FILES['file']['name']) {
    $filename = $_FILES['file']['name'];
    $tmp_filename = $_FILES['file']['tmp_name'];
    $location = 'images/';

    // Try to move the uploaded file to the target location
    if (move_uploaded_file($tmp_filename, $location . $filename)) {
        echo 'File uploaded successfully!<br>';
    } else {
        echo 'Error uploading file.<br>';
    }
} else {
    echo 'No file uploaded.<br>';
}

// Connect to your database (replace 'your_database' with your actual database name)
$connect = mysqli_connect("localhost", "root", "", "your_database");

// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get form data (ensure these variables exist and are properly retrieved from the form)
$product_name = isset($_POST['product_name']) ? $_POST['product_name'] : '';
$category = isset($_POST['category']) ? $_POST['category'] : '';
$price = isset($_POST['price']) ? $_POST['price'] : '';
$quantity = isset($_POST['quantity']) ? $_POST['quantity'] : '';

// Prepare insert statement (make sure to validate and sanitize input to prevent SQL injection)
$query = "INSERT INTO product (product_name, category, price, quantity) VALUES ('$product_name', '$category', '$price', '$quantity')";

// Execute query
if (mysqli_query($connect, $query)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($connect);
}

// Close database connection
mysqli_close($connect);
?>
