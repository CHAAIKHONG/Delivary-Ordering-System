<?php
session_start();
$connect = mysqli_connect("localhost", "root", "", "moonbeedb");

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!isset($_SESSION['user_id'])) {
    echo "You need to log in to add items to your cart.";
    exit;
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // 检查产品是否存在
    $product_check_query = "SELECT * FROM product WHERE product_id = ?";
    $stmt = $connect->prepare($product_check_query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $product_result = $stmt->get_result();

    if ($product_result->num_rows > 0) {
        // 插入购物车项
        $insert_query = "INSERT INTO cartitem (user_id, product_id, quantity) VALUES (?, ?, 1)";
        $stmt = $connect->prepare($insert_query);
        $stmt->bind_param("ii", $user_id, $product_id);
        if ($stmt->execute()) {
            echo "Item added to cart successfully.";
        } else {
            echo "Failed to add item to cart.";
        }
    } else {
        echo "Product not found.";
    }

    $stmt->close();
} else {
    echo "Product ID is missing.";
}

mysqli_close($connect);
?>
