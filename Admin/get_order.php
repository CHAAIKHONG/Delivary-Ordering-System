<?php
$conn = new mysqli("localhost", "root", "", "moonbeedb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT order_id, user_id, total_price FROM orders";
$result = $conn->query($sql);

$orders = array();
while($row = $result->fetch_assoc()) {
    $orders[] = $row;
}

$conn->close();

echo json_encode($orders);
?>
