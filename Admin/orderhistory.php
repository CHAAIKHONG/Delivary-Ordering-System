<?php
    session_start();
    $connect = mysqli_connect("localhost", "root", "", "moonbeedb");

    // 检查数据库连接
    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // 查询订单信息
    // $sql = "SELECT order_id, user_id, total_price FROM `order`";
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
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            vertical-align: middle; /* Center text vertically */
        }
        th {
            background-color: #f2f2f2;
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
                            // echo "<button onclick='toggleOrderDetails(" . $order_row['id'] . ")'>Show Details</button>";
                            // echo "<div id='orderDetails-" . $order_row['id'] . "' style='display: none;'>";
                            echo "<table>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>Product Name</th>";
                            // echo "<th>Category</th>";
                            echo "<th>Price</th>";
                            echo "<th>Quantity</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";

                            // 查询订单详细信息
                            $order_id = $order_row['order_id'];
                            $details_query = "SELECT p.product_name, d.* FROM order_detail d JOIN product p ON d.product_id = p.product_id WHERE order_id = $order_id ";
                            // $details_query = "SELECT product_id, price, quantity FROM order_detail WHERE order_id = $order_id";
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
                            echo "</div>";
                            echo "</td>";
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
    </script>
</body>
</html>
