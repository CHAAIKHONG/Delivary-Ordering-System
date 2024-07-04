<?php
$connect = mysqli_connect("localhost", "root", "", "moonbeedb");

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch order history
$orderHistoryQuery = "SELECT o.order_id, u.user_id, o.total_price FROM `order` o
                      JOIN user u ON o.user_id = u.user_id";
$orderHistoryResult = mysqli_query($connect, $orderHistoryQuery); 

$orderDetails = [];

if ($orderHistoryResult) {
    while ($order = mysqli_fetch_assoc($orderHistoryResult)) {
        $orderDetails[] = $order;
    }
}

// Fetch order details if order_id is set
if (isset($_GET['order_id'])) {
    $orderId = intval($_GET['order_id']);
    $orderDetailsQuery = "SELECT p.product_name, p.category, d.price, d.quantity 
                          FROM order_detail d
                          JOIN products p ON d.product_id = p.product_id
                          WHERE d.order_id = $orderId";
    $orderDetailsResult = mysqli_query($connect, $orderDetailsQuery);

    $orderDetails = [];
    if ($orderDetailsResult) {
        while ($detail = mysqli_fetch_assoc($orderDetailsResult)) {
            $orderDetails[] = $detail;
        }
    }

    echo json_encode($orderDetails);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoonBees Staff | Order History</title>
    <link rel="stylesheet" href="manageproduct.css">
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
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
                        <th class="center-align">Actions</th>
                    </tr>
                </thead>
                <tbody id="orderTable">
                    <?php foreach ($orderDetails as $order): ?>
                    <tr>
                        <td class="left-align"><?= htmlspecialchars($order['user_id']) ?></td>
                        <td class="left-align">RM <?= htmlspecialchars($order['total_price']) ?></td>
                        <td class="center-align">
                            <img src="car.png" alt="Shopping Cart" width="50" height="50" onclick="showOrderDetails(<?= htmlspecialchars($order['order_id']) ?>)">
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="orderDetailsModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('orderDetailsModal')">&times;</span>
            <h2>Order Details</h2>
            <table id="orderDetailsTable">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
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

        function showOrderDetails(orderId) {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'order_history.php?order_id=' + orderId, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const orderDetails = JSON.parse(xhr.responseText);
                    const orderDetailsTableBody = document.getElementById('orderDetailsTable').querySelector('tbody');
                    orderDetailsTableBody.innerHTML = ''; // Clear previous contents

                    orderDetails.forEach(detail => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${detail.product_name}</td>
                            <td>${detail.category}</td>
                            <td>${detail.price}</td>
                            <td>${detail.quantity}</td>
                        `;
                        orderDetailsTableBody.appendChild(row);
                    });

                    document.getElementById('orderDetailsModal').style.display = 'block';
                }
            };
            xhr.send();
        }

        window.onclick = function(event) {
            if (event.target === document.getElementById('orderDetailsModal')) {
                closeModal('orderDetailsModal');
            }
        };
    </script>
</body>
</html>
