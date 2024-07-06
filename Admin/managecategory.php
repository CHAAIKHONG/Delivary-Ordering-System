<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories</title>
    <link rel="icon" href="burger.png" type="image/png">

    
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">

    <style>
        body {
            background-image: url("bg.jpg.png"); 
            background-size: cover;
            background-repeat: no-repeat; 
            background-attachment: fixed;
            font-family: Arial, sans-serif;
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
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
        }

        .content-wrapper.collapsed {
            margin-left: 0;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-top: 0; /* Remove default margin */
            padding-top: 60px; 
        }

        form {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin-bottom: 20px;
        }

        form input[type="text"] {
            padding: 10px;
            margin: 10px 0;
            width: 80%;
            border: 1px solid #ccc;
            border-radius: 10px;
            border-color:black;
        }

        form button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #0056b3;
        }

        form .add-product-btn {
            background-color: black;
        }

        form .add-product-btn:hover {
            background-color: yellow;
        }

        form .edit-product-btn {
            background-color: #ffc107;
            color: black;
        }

        form .edit-product-btn:hover {
            background-color: #e0a800;
        }

        form .cancel-btn {
            background-color: red;
            color: white;
        }

        form .cancel-btn:hover {
            background-color: darkred;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: black;
            color: white;
        }

        .actions a {
            margin-right: 5px;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none; /* remove underline */
            color: white;
            border-radius: 5px;
        }

        .actions a.delete {
            background-color: red;
        }

        .actions a.delete:hover {
            background-color: darkred;
        }

        .actions a.edit {
            background-color: #ffc107;
            color: black;
        }

        .actions a.edit:hover {
            background-color: #e0a800;
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
                        <li><a href="javascript:void(0)" onclick="location.href='Manageproduct.php'">Manage Products</a></li>
                        <li><a href="javascript:void(0)" onclick="location.href='report.html'">Report</a></li>
                        <li><a href="javascript:void(0)" onclick="location.href='orderhistory.php'">Order History</a></li>
                        <li><a href="javascript:void(0)" onclick="location.href='contactus.php'">Contact Us History</a></li>

                    </ul>
                </li>
            </ul>
        </nav>
    </div>

    <div class="content-wrapper" id="content-wrapper">
        <h2>Manage Categories</h2>
        <form method="POST" action="">
            <input type="hidden" name="id" id="category_id">
            <input type="text" name="name" id="category_name" placeholder="Category Name">
            <button type="submit" name="save" class="add-product-btn">Add Category</button>
            <button type="submit" name="update" class="edit-product-btn" style="display: none;" id="update-btn">Done</button>
            <button type="button" onclick="cancelEdit()" class="cancel-btn" style="display: none;" id="cancel-btn">Cancel</button>
        </form>

        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "moonbeedb";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if (isset($_POST['save'])) {
            $name = $_POST['name'];

            if (!empty($name)) {
                $sql = "INSERT INTO category (category_name) VALUES ('$name')";

                if ($conn->query($sql) === TRUE) {
                    echo "New category created successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Please enter a category name";
            }
        }

        if (isset($_POST['update'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];

            if (!empty($name)) {
                $sql = "UPDATE category SET category_name='$name' WHERE category_id=$id";

                if ($conn->query($sql) === TRUE) {
                    echo "Category updated successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Please enter a category name";
            }
        }

        if (isset($_GET['delete'])) {
            $id = $_GET['delete'];

            $sql = "DELETE FROM category WHERE category_id=$id";

            if ($conn->query($sql) === TRUE) {
                echo "Category deleted successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        $sql = "SELECT * FROM category";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>Category ID</th>
                        <th>Category Name</th>
                        <th>Actions</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["category_id"] . "</td>
                        <td>" . $row["category_name"] . "</td>
                        <td class='actions'>
                            <a href='javascript:void(0)' class='edit' onclick='editCategory(" . $row["category_id"] . ", \"" . $row["category_name"] . "\")'>Edit</a>
                            <a href='?delete=" . $row["category_id"] . "' class='delete' onclick='return confirm(\"Are you sure you want to delete this category?\")'>Delete</a>
                        </td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }

        $conn->close();
        ?>
    </div>

    <script>
        function editCategory(id, name) {
            document.getElementById('category_id').value = id;
            document.getElementById('category_name').value = name;
            document.getElementById('update-btn').style.display = 'inline-block';
            document.getElementById('cancel-btn').style.display = 'inline-block';
            document.getElementById('add-btn').style.display = 'none';
        }

        function cancelEdit() {
            document.getElementById('category_id').value = '';
            document.getElementById('category_name').value = '';
            document.getElementById('update-btn').style.display = 'none';
            document.getElementById('cancel-btn').style.display = 'none';
            document.getElementById('add-btn').style.display = 'inline-block';
        }

        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('collapsed');
            document.getElementById('content-wrapper').classList.toggle('collapsed');
        }
    </script>
</body>
</html>
