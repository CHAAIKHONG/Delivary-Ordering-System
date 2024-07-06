<?php
$connect = mysqli_connect("localhost", "root", "", "moonbeedb");

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $query = "SELECT * FROM product WHERE product_id = '$product_id'";
    $result = mysqli_query($connect, $query);
    $product = mysqli_fetch_assoc($result);
} else {
    die("Product ID is required.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = mysqli_real_escape_string($connect, $_POST['product_name']);
    $category_id = mysqli_real_escape_string($connect, $_POST['category_id']);
    $price = mysqli_real_escape_string($connect, $_POST['price']);
    $quantity = mysqli_real_escape_string($connect, $_POST['quantity']);
    $description = mysqli_real_escape_string($connect, $_POST['description']);
    
    $photo = $product['photo'];
    if (isset($_FILES['image']) && $_FILES['image']['name']) {
        $filename = $_FILES['image']['name'];
        $tmp_filename = $_FILES['image']['tmp_name'];
        $location = 'uploads/';
        if (!is_dir($location)) {
            mkdir($location, 0755, true);
        }
        if (move_uploaded_file($tmp_filename, $location . $filename)) {
            $photo = $location . $filename;
        }
    }
    
    $query = "UPDATE product SET product_name = '$product_name', category_id = '$category_id', price = '$price', stock = '$quantity', photo = '$photo', description = '$description' WHERE product_id = '$product_id'";
    
    if (mysqli_query($connect, $query)) {
        echo '<script>alert("Product updated successfully");</script>';
        echo '<script>window.location.href = "manage_product.php";</script>';
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($connect);
    }
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>
<body>
    <h2>Edit Product</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" value="<?php echo htmlspecialchars($product['product_name']); ?>" required><br>
        
        <label for="category_id">Category:</label>
        <select name="category_id" required>
            <?php
            $category_query = "SELECT * FROM category";
            $category_result = mysqli_query($connect, $category_query);
            while ($row = mysqli_fetch_assoc($category_result)) {
                $selected = $row['category_id'] == $product['category_id'] ? 'selected' : '';
                echo "<option value='" . htmlspecialchars($row['category_id']) . "' $selected>" . htmlspecialchars($row['category_name']) . "</option>";
            }
            ?>
        </select><br>

        <label for="price">Price:</label>
        <input type="text" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required><br>

        <label for="quantity">Quantity:</label>
        <input type="text" name="quantity" value="<?php echo htmlspecialchars($product['stock']); ?>" required><br>

        <label for="description">Description:</label>
        <textarea name="description"><?php echo htmlspecialchars($product['description']); ?></textarea><br>

        <label for="image">Image:</label>
        <input type="file" name="image"><br>
        <img src="<?php echo htmlspecialchars($product['photo']); ?>" alt="Product Image" style="width: 50px; height: 50px;"><br>

        <button type="submit">Update Product</button>
    </form>
</body>
</html>
