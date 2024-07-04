<?php
session_start();
$connect = mysqli_connect("localhost", "root", "", "moonbeedb");

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $total = $_POST['total'];

    // 插入订单到 order 表
    $query = "INSERT INTO `order` (user_id, total_price, payment_status, payment_method) VALUES ($user_id, $total, 'DONE', 'Cash_On_Delivery')";
    mysqli_query($connect, $query);
    $order_id = mysqli_insert_id($connect);

    $order_items = json_decode($_POST['order_items'], true); // 解码为关联数组

    

    if (is_array($order_items)) {
        // 插入订单详情到 order_detail 表
        foreach ($order_items as $item) {
            $product_id = $item['product_id'];
            $price = $item['price'];
            $quantity = $item['quantity'];

            $sql = "INSERT INTO order_detail (order_id, product_id, price, quantity) VALUES ($order_id, $product_id, $price, $quantity)";
            mysqli_query($connect, $sql);
        }
        $cartitem = "DELETE FROM cartitem WHERE user_id = $user_id";
        mysqli_query($connect, $cartitem);

        // echo "<script>alert(Order placed successfully!)</script>";
        echo '<script>alert("Order placed successfully!");</script>';
        echo '<script>window.location.href = "menu.php";</script>';
        exit();
    } else {
        echo "<script>alert(Error: Invalid order items data.)</script>";
    }
} else {
    echo "<script>alert(User not logged in.)</script>";
}
?>