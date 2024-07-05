<?php
$connect = mysqli_connect("localhost", "root", "", "moonbeedb");

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET["id"])) {
    $product_id = intval($_GET["id"]);
    $query = "DELETE FROM product WHERE product_id = $product_id";
    if (mysqli_query($connect, $query)) {
        echo '<script>alert("Product deleted successfully.");</script>';
    } else {
        echo "Error: " . mysqli_error($connect);
    }
}

mysqli_close($connect);
echo '<script>window.location.href = "manageproduct.php";</script>';
?>
