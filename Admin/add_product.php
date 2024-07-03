<?php
// 检查是否有文件上传
if ($_FILES['file']['name']) {
    $filename = $_FILES['file']['name'];
    $tmp_filename = $_FILES['file']['tmp_name'];
    $location = 'images/';

    // 尝试移动上传的文件到目标位置
    if (move_uploaded_file($tmp_filename, $location . $filename)) {
        echo 'File uploaded successfully!';
    } else {
        echo 'Error uploading file.';
    }
} else {
    echo 'No file uploaded.';
}

// 连接数据库
$connect = mysqli_connect("localhost", "root", "", "your_database");

// 检查连接是否成功
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// 获取表单提交的数据
$product_name = $_POST['product_name'];
$category = $_POST['category'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];  // 确保这个变量存在并从表单中正确获取

// 准备插入语句
$query = "INSERT INTO product (product_name, category, price, quantity) VALUES ('$product_name', '$category', '$price', '$quantity')";

// 执行查询
if (mysqli_query($connect, $query)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($connect);
}

// 关闭数据库连接
mysqli_close($connect);
?>
