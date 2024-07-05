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
                        <li><a href="javascript:void(0)" onclick="location.href='managestaff.php'">Manage Staff</a></li>
                        <li><a href="javascript:void(0)" onclick="location.href='manage_product.php'">Manage Products</a></li>
                        <li><a href="javascript:void(0)" onclick="location.href='managecategory.php'">Manage Category</a></li>
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
                <textarea name="description" ></textarea><br>

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
            sidebar.classList.toggle('active');
            contentWrapper.classList.toggle('active');
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
<?php mysqli_close($connect); ?>







