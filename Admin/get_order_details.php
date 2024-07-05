<?php
$conn = new mysqli("localhost", "root", "", "moonbeedb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$order_id = $_GET['order_id'];
$sql = "SELECT product_name, category, price, quantity FROM order_details WHERE order_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();

$order_details = array();
while($row = $result->fetch_assoc()) {
    $order_details[] = $row;
}

$stmt->close();
$conn->close();

echo json_encode($order_details);
?>
