<?php
    session_start();
    $connect = mysqli_connect("localhost", "root", "", "moonbeedb");

    // 检查数据库连接
    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // 查询订单信息
    // $sql = "SELECT order_id, user_id, total_price FROM `order`";
    $sql = "SELECT CONCAT(u.first_name, ' ', u.last_name) AS full_name, u.email, u.phone_number, c.* FROM `contactus` c JOIN `user` u ON c.user_id = u.user_id";
    $result = mysqli_query($connect, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoonBees Staff | Contact Us History</title>
    <link rel="stylesheet" href="manageproduct.css">
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
                        <li><a href="javascript:void(0)" onclick="location.href='manageproduct.php'">Manage Products</a></li>
                        <li><a href="javascript:void(0)" onclick="location.href='report.html'">Report</a></li>
                        <li><a href="javascript:void(0)" onclick="location.href='managecategory.php'">Manage Category</a></li>

                    </ul>
                </li>
            </ul>
        </nav>
    </div>

    <div class="content-wrapper" id="content-wrapper">
        <div class="order-history">
            <h2>Order History</h2>
            <table>
                <thead>
                    <tr>
                        <th class="left-align">Customers</th>
                        <th class="left-align">Customers Email</th>
                        <th class="left-align">Customers Phone Number</th>
                        <th class="center-align">Comment</th>
                    </tr>
                </thead>
                <tbody id="orderTable">
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($order_row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td class='left-align'>" . $order_row['full_name'] . "</td>";
                            echo "<td class='left-align'>" . $order_row['email'] . "</td>";
                            echo "<td class='left-align'>" . $order_row['phone_number'] . "</td>";
                            echo "<td class='left-align'>" . $order_row['message'] . "</td>";
                            echo "</tr>";
                        }
                    }

                    mysqli_close($connect);
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function toggleOrderDetails(orderId) {
            const detailsDiv = document.getElementById(`orderDetails-${orderId}`);
            if (detailsDiv.style.display === 'none') {
                detailsDiv.style.display = 'block';
            } else {
                detailsDiv.style.display = 'none';
            }
        }

        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('collapsed');
            document.getElementById('content-wrapper').classList.toggle('collapsed');
        }
    </script>
</body>
</html>
