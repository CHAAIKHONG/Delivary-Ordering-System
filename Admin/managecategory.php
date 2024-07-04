<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories</title>
    <style>
        body {
            display: flex;
            margin: 0;
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
        }

        ul.head li {
            float: left;
        }

        ul.head li.topleft {
            margin-left: 20px;
            display: flex;
            align-items: center;
        }

        ul.head li a {
            display: block;
            color: rgb(255, 255, 255);
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 25px;
            font-family: initial;
        }

        ul.head li:hover {
            background-color: green;
        }

        .all_topright {
            margin-left: 80%;
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

        .toggle-btn {
            background-color: black;
            color: white;
            border: none;
            padding: 14px 16px;
            cursor: pointer;
            font-size: 25px;
            margin-right: 10px;
        }

        .content-wrapper {
            margin-left: 250px;
            flex: 1;
            padding: 20px;
            padding-top: 60px;
            background-color: #f4f4f4;
            transition: margin-left 0.3s ease;
        }

        .content-wrapper.collapsed {
            margin-left: 0;
        }

        .categories {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .categories button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            margin-right: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .categories button:hover {
            background-color: #0056b3;
        }

        .add-product-btn {
            margin-left: auto;
            margin-right: 0;
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .add-product-btn:hover {
            background-color: #218838;
        }

        .edit-product-btn {
            margin-left: auto;
            margin-right: 0;
            background-color: #ffc107;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .edit-product-btn:hover {
            background-color: #e0a800;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .actions button {
            margin-right: 5px;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .actions button:hover {
            background-color: #ffc107;
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
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <ul class="head">
        <li class="topleft"><a href="#"></a></li>
        <li><a href="#"></a></li>
        <li><a href="#"></a></li>
    </ul>

    <div class="sidebar">
        <nav>
            <ul>
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
            </ul>
        </nav>
    </div>

    <div class="content-wrapper">
        <h2>Manage Categories</h2>
        <form method="POST" action="">
            <input type="hidden" name="id" id="category_id">
            <input type="text" name="name" id="category_name" placeholder="Category Name">
            <button type="submit" name="save" class="add-product-btn">Add Category</button>
            <button type="submit" name="update" class="edit-product-btn" style="display: none;" id="update-btn">Done</button>
            <button type="button" onclick="cancelEdit()" class="add-product-btn" style="display: none;" id="cancel-btn">Cancel</button>
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

        if (isset($_GET['edit'])) {
            $id = $_GET['edit'];
            $result = $conn->query("SELECT * FROM category WHERE category_id=$id");

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<script>
                    document.getElementById('category_id').value = " . $row['category_id'] . ";
                    document.getElementById('category_name').value = '" . $row['category_name'] . "';
                    document.getElementById('update-btn').style.display = 'inline-block';
                    document.getElementById('cancel-btn').style.display = 'inline-block';
                    document.getElementById('category_name').focus();
                </script>";
            }
        }

        echo "<table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>";

        $sql = "SELECT * FROM category";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['category_id'] . "</td>";
                echo "<td>" . $row['category_name'] . "</td>";
                echo "<td class='actions'>";
                echo "<a href='?delete=" . $row['category_id'] . "' onclick='return confirm(\"Are you sure you want to delete this category?\")'>Delete</a>";
                echo "<a href='?edit=" . $row['category_id'] . "'>Edit</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No categories found</td></tr>";
        }

        echo "</tbody>
        </table>";

        $conn->close();
        ?>
    </div>

    <script>
        function cancelEdit() {
            document.getElementById('category_id').value = '';
            document.getElementById('category_name').value = '';
            document.getElementById('update-btn').style.display = 'none';
            document.getElementById('cancel-btn').style.display = 'none';
        }
    </script>
</body>
</html>
