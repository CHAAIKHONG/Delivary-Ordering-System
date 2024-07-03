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
    <link rel="stylesheet" href="manageproduct.css">
</head>
<body>
    <ul class="head">
        <li class="topleft">
            <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
            <a href="#home">MoonBees</a>
        </li>
        <div class="all_topright">
            <li class="help"><i class="ri-question-line" style="color: white; display: block; margin-top: 20px; padding: 0px 15px;"> Help</i></li>
            <li class="user"><a href="staff_login.html" style="font-size: 15px; text-decoration: none; padding: 0;"><i class="ri-user-5-line" style="color: white; display: block; margin-top: 20px;"> Login</a></i></li>
        </div>
    </ul>

    <div class="sidebar" id="sidebar">
        <nav>
            <ul>
                <li>
                    <a href="javascript:void(0)" onclick="location.href='mainmenu.html'">Admin</a>
                    <ul>
                        <li><a href="javascript:void(0)" onclick="location.href='managestaff.html'">Manage Staff</a></li>
                        <li><a href="javascript:void(0)" onclick="location.href='manageproduct.html'">Manage Products</a></li>
                        <li><a href="javascript:void(0)" onclick="location.href='report.html'">Report</a></li>
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
                    echo "<button onclick=\"filterCategory('" . $row['category_name'] . "')\">" . $row['category_name'] . "</button>";
                }
                ?>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="productTable">
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        $image_path = !empty($row['image_path']) ? $row['image_path'] : 'images/default.png';
                        echo "<tr>
                            <td><img src='$image_path' alt='Product Image' width='50' height='50'></td>
                            <td>" . $row['product_name'] . "</td>
                            <td>" . $row['category_name'] . "</td>
                            <td>" . $row['price'] . "</td>
                            <td>" . $row['quantity'] . "</td>
                            <td>" . $row['description'] . "</td>
                            <td class='actions'>
                                <button onclick=\"showEditProductModal(" . $row['product_id'] . ")\">Edit</button>
                                <button onclick=\"deleteProduct(" . $row['product_id'] . ")\">Delete</button>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>

            <button class="add-product-btn" onclick="showAddProductModal()">Add Product</button>
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
                        echo "<option value='" . $row["category_id"] . "'>" . $row["category_name"] . "</option>";
                    }
                    ?>
                </select><br>

                <label for="price">Price:</label>
                <input type="text" name="price" required><br>

                <label for="quantity">Quantity:</label>
                <input type="text" name="quantity" required><br>

                <label for="description">Description:</label>
                <textarea name="description" required></textarea><br>

                <label for="image_path">Image:</label>
                <input type="file" name="image_path" required><br>

                <button type="submit">Add Product</button>
            </form>
        </div>
    </div>

    <div id="editProductModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('editProductModal')">&times;</span>
            <h2>Edit Product</h2>
            <form action="edit_product.php" method="POST">
                <input type="hidden" id="edit_product_id" name="product_id">

                <label for="edit_product_name">Product Name:</label>
                <input type="text" id="edit_product_name" name="product_name" required><br>
                
                <label for="edit_category_id">Category:</label>
                <select id="edit_category_id" name="category_id" required>
                    <?php
                    $category_query = "SELECT * FROM category";
                    $category_result = mysqli_query($connect, $category_query);
                    while ($row = mysqli_fetch_assoc($category_result)) {
                        echo "<option value='" . $row["category_id"] . "'>" . $row["category_name"] . "</option>";
                    }
                    ?>
                </select><br>

                <label for="edit_price">Price:</label>
                <input type="text" id="edit_price" name="price" required><br>

                <label for="edit_quantity">Quantity:</label>
                <input type="text" id="edit_quantity" name="quantity" required><br>

                <label for="edit_description">Description:</label>
                <textarea id="edit_description" name="description" required></textarea><br>

                <button type="submit">Update Product</button>
            </form>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('collapsed');
            document.getElementById('content-wrapper').classList.toggle('collapsed');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        function showAddProductModal() {
            document.getElementById('addProductModal').style.display = 'block';
        }

        function showEditProductModal(id) {
            const product_name = document.getElementById('product_name_' + id).textContent;
            const category_id = document.getElementById('category_id_' + id).value;
            const price = document.getElementById('price_' + id).textContent;
            const quantity = document.getElementById('quantity_' + id).textContent;
            const description = document.getElementById('description_' + id).textContent;

            document.getElementById('edit_product_id').value = id;
            document.getElementById('edit_product_name').value = product_name;
            document.getElementById('edit_category_id').value = category_id;
            document.getElementById('edit_price').value = price;
            document.getElementById('edit_quantity').value = quantity;
            document.getElementById('edit_description').value = description;

            document.getElementById('editProductModal').style.display = 'block';
        }

        function deleteProduct(id) {
            if (confirm("Are you sure you want to delete this product?")) {
                window.location.href = 'delete_product.php?id=' + id;
            }
        }

        function filterCategory(category) {
            const rows = document.querySelectorAll('#productTable tr');
            rows.forEach(row => {
                const categoryCell = row.querySelector('td:nth-child(3)');
                if (category === 'all' || categoryCell.textContent.trim() === category) {
                    row.style.display = 'table-row';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>
