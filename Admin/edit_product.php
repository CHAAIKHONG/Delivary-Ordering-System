<?php
$connect = mysqli_connect("localhost", "root", "", "moonbeedb");

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET["id"])) {
    $product_id = intval($_GET["id"]);
    $query = "SELECT * FROM product WHERE product_id = $product_id";
    $result = mysqli_query($connect, $query);
    $product = mysqli_fetch_assoc($result);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST["product_id"];
    $product_name = $_POST["product_name"];
    $category_id = $_POST["category_id"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $description = $_POST["description"];
    
    $query = "UPDATE product SET product_name = '$product_name', category_id = $category_id, price = $price, quantity = $quantity, description = '$description' WHERE product_id = $product_id";
    if (mysqli_query($connect, $query)) {
        echo "Product updated successfully.";
    } else {
        echo "Error: " . mysqli_error($connect);
    }

    mysqli_close($connect);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>
<body>
    <form action="edit_product.php" method="POST">
        <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">

        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" value="<?php echo $product['product_name']; ?>" required><br>
        
        <label for="category_id">Category:</label>
        <select name="category_id" required>
            <?php
            $category_query = "SELECT * FROM category";
            $category_result = mysqli_query($connect, $category_query);
            while ($row = mysqli_fetch_assoc($category_result)) {
                $selected = $row["category_id"] == $product["category_id"] ? "selected" : "";
                echo "<option value='" . $row["category_id"] . "' $selected>" . $row["category_name"] . "</option>";
            }
            ?>
        </select><br>

        <label for="price">Price:</label>
        <input type="text" name="price" value="<?php echo $product['price']; ?>" required><br>

        <label for="quantity">Quantity:</label>
        <input type="text" name="quantity" value="<?php echo $product['quantity']; ?>" required><br>

        <label for="description">Description:</label>
        <textarea name="description" required><?php echo $product['description']; ?></textarea><br>

        <button type="submit">Update Product</button>
    </form>
</body>
</html>
