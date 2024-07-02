<?php
session_start();
$connect = mysqli_connect("localhost", "root", "", "moonbeedb");

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_SESSION['user_id']) && isset($_POST['newAddress'])) {
    $user_id = $_SESSION['user_id'];
    $newAddress = $_POST['newAddress'];

    $query = "UPDATE user SET address = ? WHERE user_id = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("si", $newAddress, $user_id);

    if ($stmt->execute()) {
        echo "Address saved successfully";
    } else {
        echo "Failed to save address";
    }
    

    $stmt->close();
} else {
    echo "Address is missing or user not logged in";
}

mysqli_close($connect);
?>
