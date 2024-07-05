<?php
$connect = mysqli_connect("localhost", "root", "", "moonbeedb");

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT p.*, c.category_name FROM product p JOIN category c ON p.category_id = c.category_id";
$result = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoonBees Staff | Manage Product</title>
    <link rel="icon" href="burger.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">

    <style>
body {
        background-image: url("bg.jpg.png"); 
        background-size: cover;
        background-repeat: no-repeat; 
        background-attachment:fixed;
    }

    ul.head {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: black;
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    ul.head li {
        float: left;
    }

    ul.head li.topleft {
        display: flex;
        align-items: center;
    }

    .head_title, .head li a {
        display: block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 25px;
        font-family: initial;
    }

        .toggle-btn {
            background-color: black;
            color: white;
            border: none;
            padding: 14px 16px;
            cursor: pointer;
            font-size: 25px;
            margin-right: 10px;
        }
        
        body, html {
            height: 100%;
            margin: 0;
            position: relative;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            width: 250px;
            background-color: #333;
            color: white;
            padding: 20px;
            padding-top: 60px;
            box-sizing: border-box;
            position: fixed;
            top: 0;
            bottom: 0;
            overflow-y: auto;
            transition: transform 0.3s ease;
        }

        .sidebar.collapsed {
            transform: translateX(-100%);
        }

        .sidebar nav ul {
            padding: 0;
            list-style: none;
        }

        .sidebar nav ul li {
            padding: 10px 0;
        }

        .sidebar nav ul li a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            transition: background-color 0.3s ease;
        }

        .sidebar nav ul li a:hover {
            background-color: #575757;
        }

        .content-wrapper {
            margin-left: 260px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        .content-wrapper.collapsed {
            margin-left: 0;
        }

        .manage-products h2 {
            text-align: center;
            color: white;
        }

        .categories {
            text-align: center;
            margin-bottom: 20px;
        }

        .categories button {
            background-color: black;
            color: white;
            border: none;
            padding: 10px 20px;
            margin: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border-radius: 10px;
        }

        .categories button:hover {
            background-color: yellow;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
        }

        table th, table td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: black;
            color: white;
        }

        .actions button {
            background-color: black;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border-radius: 10px;

        }

        .actions button:hover {
            background-color: yellow;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: white;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 10px;
        }

        .modal-content span.close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .modal-content span.close:hover, .modal-content span.close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        
    .logout {
        margin-right: 20px;
    }

    .logout a {
        font-size: 15px;
        text-decoration: none;
        color: white;
        display: block;
        padding: 14px 16px;
    }
    </style>
</head>
<body>
<ul class="head">
    <li class="topleft">
        <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
        <a href="#home">MoonBees</a>
    </li>
    <li class="logout">
        <a href="logout2.php"><i class="ri-user-5-line"></i> Logout</a>
    </li>
</ul>

    <div class="sidebar" id="sidebar">
        <nav>
            <ul>
                <li>
                    <a href="javascript:void(0)" onclick="location.href='mainmenu.html'">Admin</a>
                    <ul>
                        <li><a href="javascript:void(0)" onclick="location.href='managestaff.php'">Manage Staff</a></li>
                        <li><a href="javascript:void(0)" onclick="location.href='report.html'">Report</a></li>
                        <li><a href="javascript:void(0)" onclick="location.href='orderhistory.php'">Order History</a></li>
                        <li><a href="javascript:void(0)" onclick="location.href='managecategory.php'">Manage Category</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>

    <div class="content-wrapper" id="content-wrapper">
        <div class="manage-products">
            <h2>Manage Products</h2>

            <div class="categories">
                <button onclick="filterCategory('all')">All</button>
                <?php
                $category_query = "SELECT * FROM category";
                $category_result = mysqli_query($connect, $category_query);
                while ($row = mysqli_fetch_assoc($category_result)) {
                    echo "<button onclick=\"filterCategory('" . htmlspecialchars($row['category_name']) . "')\">" . htmlspecialchars($row['category_name']) . "</button>";
                }
                ?>
                <button class="add-product-btn" onclick="showAddProductModal()">Add Product</button>
            </div>
            
            <table>
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="productTable">
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        $image_path = !empty($row['photo']) ? $row['photo'] : 'images/default.png';
                        $quantity = isset($row['stock']) ? $row['stock'] : 0;
                        echo '<tr>
                            <td><img src="' . htmlspecialchars($image_path) . '" alt="' . htmlspecialchars($row['product_name']) . '" style="width: 50px; height: 50px;"></td>
                            <td>' . htmlspecialchars($row['product_name']) . '</td>
                            <td>' . htmlspecialchars($row['category_name']) . '</td>
                            <td>' . htmlspecialchars($row['price']) . '</td>
                            <td>' . htmlspecialchars($quantity) . '</td>
                            <td>' . $row['description'] . '</td>
                            <td class="actions">
                                <button onclick="deleteProduct(' . htmlspecialchars($row['product_id']) . ')">Delete</button>
                            </td>
                        </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="addProductModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('addProductModal')">&times;</span>
            <h2>Add Product</h2>
            <form action="add_product.php" method="POST" enctype="multipart/form-data">
                <label for="product_name">Product Name:</label>
                <input type="text" name="product_name" required><br>
                
                <label for="category_id">Category:</label>
                <select name="category_id" required>
                    <?php
                    $category_query = "SELECT * FROM category";
                    $category_result = mysqli_query($connect, $category_query);
                    while ($row = mysqli_fetch_assoc($category_result)) {
                        echo "<option value='" . htmlspecialchars($row['category_id']) . "'>" . htmlspecialchars($row['category_name']) . "</option>";
                    }
                    ?>
                </select><br>

                <label for="price">Price:</label>
                <input type="text" name="price" required><br>

                <label for="quantity">Quantity:</label>
                <input type="text" name="quantity" required><br>

                <label for="description">Description:</label>
                <textarea name="description"></textarea><br>

                <label for="image">Image:</label>
                <input type="file" name="image" required><br>

                <button type="submit">Add Product</button>
            </form>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            var contentWrapper = document.getElementById('content-wrapper');
            sidebar.classList.toggle('collapsed');
            contentWrapper.classList.toggle('collapsed');
        }

        function filterCategory(category) {
            var rows = document.querySelectorAll("#productTable tr");
            rows.forEach(function(row) {
                if (category === 'all' || row.cells[2].innerText === category) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        function showAddProductModal() {
            document.getElementById('addProductModal').style.display = 'block';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        function deleteProduct(productId) {
            if (confirm("Are you sure you want to delete this product?")) {
                window.location.href = "delete_product.php?id=" + productId;
            }                   
        }
    </script>
</body>
</html>
