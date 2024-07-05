<?php
    session_start();
    $connect = mysqli_connect("localhost", "root", "", "moonbeedb");

    // 检查数据库连接
    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // 查询订单信息
    $sql = "SELECT CONCAT(u.first_name, ' ', u.last_name) AS full_name, o.* FROM `order` o JOIN `user` u ON o.user_id = u.user_id";
    $result = mysqli_query($connect, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoonBees Staff | Order History</title>
    <link rel="stylesheet" href="manageproduct.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">

    <style>
        body {
            background-image: url("bg.jpg.png"); 
            background-size: cover;
            background-repeat: no-repeat; 
            background-attachment: fixed;
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

        .head_title, ul.head li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 25px;
            font-family: initial;
        }

        ul.head li.topcenter:hover {
            background-color: black;
        }

        ul.head li a,
        ul.head li a:hover,
        ul.head li a:focus,
        ul.head li a:active {
            background-color: black !important; /* 强制设置与导航栏相同的背景色 */
            color: white !important; /* 强制保持文字颜色不变 */
            outline: none !important; /* 移除所有 outline */
            border: none !important; /* 移除所有 border */
            box-shadow: none !important; /* 移除任何可能的 box-shadow */
        }

        h2 {
            text-align: center;
            color: #333;
            margin-top: -55px; /* Remove default margin */
            padding-top: 60px; 
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

        .content-wrapper {
            margin-left: 260px;
            padding: 20px;
            transition: margin-left 0.3s ease;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
        }

        .order-history {
            margin-top: 60px; /* Adjust based on your header height */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: black;
            color: white;
        }

        .left-align {
            text-align: left;
        }

        .center-align {
            text-align: center;
        }
    </style>
</head>
<body>
    <ul class="head">
        <li class="topleft">
            <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
            <a href="#home" style="background-color: black !important; color: white !important; outline: none !important; border: none !important; box-shadow: none !important;">MoonBees</a>
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
                        <li><a href="javascript:void(0)" onclick="location.href='contactus.php'">Contact Us History</a></li>
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
                        <th class="left-align">Total (RM)</th>
                        <th class="center-align">Products</th>
                    </tr>
                </thead>
                <tbody id="orderTable">
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($order_row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td class='left-align'>" . $order_row['full_name'] . "</td>";
                            echo "<td class='left-align'>RM " . $order_row['total_price'] . "</td>";
                            echo "<td class='center-align'>";
                            echo "<table>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>Product Name</th>";
                            echo "<th>Price</th>";
                            echo "<th>Quantity</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";

                            // 查询订单详细信息
                            $order_id = $order_row['order_id'];
                            $details_query = "SELECT p.product_name, d.* FROM order_detail d JOIN product p ON d.product_id = p.product_id WHERE order_id = $order_id";
                            $details_result = mysqli_query($connect, $details_query);

                            while ($detail = mysqli_fetch_assoc($details_result)) {
                                echo "<tr>";
                                echo "<td>" . $detail['product_name'] . "</td>";
                                echo "<td>RM " . $detail['price'] . "</td>";
                                echo "<td>" . $detail['quantity'] . "</td>";
                                echo "</tr>";
                            }

                            echo "</tbody>";
                            echo "</table>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No results found</td></tr>";
                    }

                    mysqli_close($connect);
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('collapsed');
            document.getElementById('content-wrapper').classList.toggle('collapsed');
        }
    </script>
</body>
</html>
