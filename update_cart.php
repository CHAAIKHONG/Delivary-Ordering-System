<?php
session_start();
$connect = mysqli_connect("localhost", "root", "", "moonbeedb");

// 检查数据库连接
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['action']) && isset($_POST['product_id'])) {
    $action = $_POST['action'];
    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['user_id'];

    if ($action === 'remove') {
        $query = "DELETE FROM cartitem WHERE user_id = ? AND product_id = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("ii", $user_id, $product_id);
    } elseif ($action === 'increase') {
        $query = "UPDATE cartitem SET quantity = quantity + 1 WHERE user_id = ? AND product_id = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("ii", $user_id, $product_id);
    } elseif ($action === 'decrease') {
        // 如果数量大于1，则减少数量；否则，直接删除该商品
        $query = "SELECT quantity FROM cartitem WHERE user_id = ? AND product_id = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("ii", $user_id, $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if ($row['quantity'] > 1) {
            $query = "UPDATE cartitem SET quantity = quantity - 1 WHERE user_id = ? AND product_id = ?";
        } else {
            $query = "DELETE FROM cartitem WHERE user_id = ? AND product_id = ?";
        }
        $stmt = $connect->prepare($query);
        $stmt->bind_param("ii", $user_id, $product_id);
    }

    $stmt->execute();
    $stmt->close();
}
?>
