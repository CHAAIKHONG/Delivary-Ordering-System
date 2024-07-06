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
body, html 
{
    height: 100%;
    margin: 0;
    position: relative;
    font-family: Arial, sans-serif;
}

body 
{
    background-image: url("bg.jpg.png"); 
    background-size: cover;
    background-repeat: no-repeat; 
    background-attachment: fixed;
}



ul.head 
{
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

ul.head li 
{
    float: left;
}

ul.head li.topleft 
{
    display: flex;
    align-items: center;
}

.head_title, .head li a 
{
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 25px;
    font-family: initial;
}

.toggle-btn 
{
    background-color: black;
    color: white;
    border: none;
    padding: 14px 16px;
    cursor: pointer;
    font-size: 25px;
    margin-right: 10px;
}

.sidebar 
{
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

.sidebar.collapsed 
{
    transform: translateX(-100%);
}

.sidebar nav ul 
{
    padding: 0;
    list-style: none;
}

.sidebar nav ul li 
{
    padding: 10px 0;
}

.sidebar nav ul li a 
{
    color: white;
    text-decoration: none;
    display: block;
    padding: 10px;
    transition: background-color 0.3s ease;
}

.sidebar nav ul li a:hover 
{
    background-color: #575757;
}

.content-wrapper 
{
    margin-left: 260px;
    padding: 20px;
    transition: margin-left 0.3s ease;
}

.content-wrapper.collapsed 
{
    margin-left: 0;
}

.manage-products h2 
{
    text-align: center;
    color: black;
    margin-top: 0;
    padding-top: 60px;
}

.categories 
{
    text-align: center;
    margin-bottom: 20px;
}

.categories button 
{
    background-color: black;
    color: white;
    border: none;
    padding: 10px 20px;
    margin: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    border-radius: 10px;
}

.categories button:hover 
{
    background-color: #ffcc00;
}

table 
{
    width: 100%;
    border-collapse: collapse;
    background-color: white;
    border-radius: 10px;
    overflow: hidden;
}

table th, table td 
{
    padding: 10px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

table th 
{
    background-color: black;
    color: white;
}

.actions button 
{
    background-color: black;
    color: white;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    border-radius: 10px;
}

.actions button:hover 
{
    background-color: red;
}

.modal 
{
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

.modal-content 
{
    background-color: #fff;
    margin: 5% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 500px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    animation: fadeIn 0.3s ease;
    overflow-y: auto; 
    max-height: 80vh;
    padding-right: 15px;
    -ms-overflow-style: none; 
    scrollbar-width: none; 

.modal-content::-webkit-scrollbar 
{
    display: none; 
}

@keyframes fadeIn 
{
    from { opacity: 0; transform: scale(0.9); }
    to { opacity: 1; transform: scale(1); }
}

.close 
{
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover, .close:focus 
{
    color: black;
    text-decoration: none;
    cursor: pointer;
}

.form 
{
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.form h2 
{
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
    text-align: center;
}

.input 
{
    padding: 10px;
    margin: 5px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
}

.input:focus 
{
    outline: none;
    border-color: #000;
}

.button-confirm 
{
    padding: 10px;
    background-color: black;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

.button-confirm:hover 
{
    background-color: #444;
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
                        <li><a href="javascript:void(0)" onclick="location.href='contactus.php'">Contact Us History</a></li>

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
        <form class="form" action="add_product.php" method="POST" enctype="multipart/form-data">
            <input type="text" placeholder="Product Name" name="product_name" class="input" required><br>

            <select name="category_id" class="input" required>
                <?php
                $category_query = "SELECT * FROM category";
                $category_result = mysqli_query($connect, $category_query);
                while ($row = mysqli_fetch_assoc($category_result)) {
                    echo "<option value='" . htmlspecialchars($row['category_id']) . "'>" . htmlspecialchars($row['category_name']) . "</option>";
                }
                ?>
            </select><br>

            <input type="text" placeholder="Price" name="price" class="input" required><br>
            <input type="text" placeholder="Quantity" name="quantity" class="input" required><br>
            <textarea placeholder="Description" name="description" class="input"></textarea><br>
            <input type="file" name="image" class="input" required><br>

            <button type="submit" class="button-confirm">Save</button>
        </form>
    </div>
</div>

<script>
    function toggleSidebar() 
    {
        var sidebar = document.getElementById('sidebar');
        var contentWrapper = document.getElementById('content-wrapper');
        sidebar.classList.toggle('collapsed');
        contentWrapper.classList.toggle('collapsed');
    }

    function filterCategory(category) 
    {
        var rows = document.querySelectorAll("#productTable tr");
        rows.forEach(function(row) {
            if (category === 'all' || row.cells[2].innerText === category) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    function showAddProductModal() 
    {
        document.getElementById('addProductModal').style.display = 'block';
    }

    function closeModal(modalId) 
    {
        document.getElementById(modalId).style.display = 'none';
    }

    function deleteProduct(productId) 
    {
        if (confirm("Are you sure you want to delete this product?")) {
            window.location.href = "delete_product.php?id=" + productId;
        }
    }
</script>

</body>
</html>
