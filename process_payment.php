<?php
session_start();
$connect = mysqli_connect("localhost", "root", "", "moonbeedb");

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $total = $_POST['total'];
    // $requests = isset($_POST['requests']) ? str_replace(' ', '_', $_POST['requests']) : ''; 
    // $payment_method = 'Cash On Delivery';
    // $payment_status = 'Pending'; // 或其他默认状态
    // $delivery_status = 'Pending'; // 或其他默认状态

    // 插入订单到 order 表
    $query = "INSERT INTO `order` (user_id, total_price, payment_status, payment_method) VALUES ($user_id, $total, 'DONE', 'Cash_On_Delivery')";
    // $stmt = $connect->prepare($query);
    // $stmt->bind_param("idss", $user_id, $total, $payment_status, $delivery_status);
    // $stmt->execute();
    // $order_id = $stmt->insert_id; // 获取插入的订单 ID
    // $stmt->close();
    mysqli_query($connect, $query);
    $order_id = mysqli_insert_id($connect);

    // 插入订单详情到 order_detail 表
    // foreach ($_POST['order_items'] as $item) {
    //     $product_id = $item['product_id'];
    //     $price = $item['price'];
    //     $quantity = $item['quantity'];

    //     $sql = "INSERT INTO order_detail (order_id, product_id, price, quantity) VALUES ($order_id, $product_id, $price, $quantity)";
    //     // $stmt = $connect->prepare($query);
    //     // $stmt->bind_param("iidi", $order_id, $product_id, $price, $quantity);
    //     // $stmt->execute();
    //     // $stmt->close();
    //     mysqli_query($connect, $sql);
    // }
    $order_items = json_decode($_POST['order_items'], true); // 解码为关联数组

    if (is_array($order_items)) {
        // 插入订单详情到 order_detail 表
        foreach ($order_items as $item) {
            $product_id = $item['product_id'];
            $price = $item['price'];
            $quantity = $item['quantity'];

            $sql = "INSERT INTO order_detail (order_id, product_id, price, quantity) VALUES ($order_id, $product_id, $price, $quantity)";
            // $stmt = $connect->prepare($query);
            // $stmt->bind_param("iidi", $order_id, $product_id, $price, $quantity);
            // $stmt->execute();
            // $stmt->close();
            mysqli_query($connect, $sql);
        }
        // echo "<script>alert(Order placed successfully!)</script>";
        echo "<script>alert(Order placed successfully!)</script>";
        header("Location: menu.php");
        exit();
    } else {
        echo "<script>alert(Error: Invalid order items data.)</script>";
    }
} else {
    echo "<script>alert(User not logged in.)</script>";
}
?>