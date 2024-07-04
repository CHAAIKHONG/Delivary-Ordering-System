<?php
session_start();
$connect = mysqli_connect("localhost", "root", "", "moonbeedb");

// Check database connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $requests = $_POST['requests'] ?? '';

    // Insert the order details into the orders table
    $query = "INSERT INTO orders (user_id, requests) VALUES (?, ?)";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("is", $user_id, $requests);
    
    if ($stmt->execute()) {
        // Order details saved successfully
        // Redirect to a success page or display a success message
        header("Location: order_success.php");
    } else {
        // Error occurred
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    // User not logged in, redirect to login page
    header("Location: login.php");
    exit();
}

mysqli_close($connect);
?>