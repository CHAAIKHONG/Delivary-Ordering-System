<?php
$photo = '';
if (isset($_FILES['image']) && $_FILES['image']['name']) {
    $filename = $_FILES['image']['name'];
    $tmp_filename = $_FILES['image']['tmp_name'];
    $location = 'uploads/';

    if (!is_dir($location)) {
        mkdir($location, 0755, true);
    }

    if (move_uploaded_file($tmp_filename, $location . $filename)) {
        $photo = $location . $filename;
        echo 'File uploaded successfully!<br>';
    } else {
        echo 'Error uploading file.<br>';
    }
} else {
    echo 'No file uploaded.<br>';
}

$connect = mysqli_connect("localhost", "root", "", "moonbeedb");

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

$product_name = isset($_POST['product_name']) ? mysqli_real_escape_string($connect, $_POST['product_name']) : '';
$category_id = isset($_POST['category_id']) ? mysqli_real_escape_string($connect, $_POST['category_id']) : '';
$price = isset($_POST['price']) ? mysqli_real_escape_string($connect, $_POST['price']) : '';
$quantity = isset($_POST['quantity']) ? mysqli_real_escape_string($connect, $_POST['quantity']) : '';
$description = isset($_POST['description']) ? mysqli_real_escape_string($connect, $_POST['description']) : '';

$category_check_query = "SELECT * FROM category WHERE category_id = '$category_id'";
$category_check_result = mysqli_query($connect, $category_check_query);

if (mysqli_num_rows($category_check_result) > 0) {
    $query = "INSERT INTO product (product_name, category_id, price, stock, photo, description) VALUES ('$product_name', '$category_id', '$price', '$quantity', '$photo', '$description')";

    if (mysqli_query($connect, $query)) {
        echo '<script>alert("New record created successfully");</script>';
        echo '<script>window.location.href = "manageproduct.php";</script>';
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($connect);
    }
} else {
    echo "Invalid category ID.";
}
mysqli_close($connect);
?>





