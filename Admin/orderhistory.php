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
                    <!-- Example Data -->
                    <tr>
                        <td class="left-align">John Doe</td>
                        <td class="left-align">RM 50.00</td>
                        <td class="center-align"><img src="car.png" alt="Shopping Cart" width="50" height="50" onclick="showOrderDetails(1)"></td>
                    </tr>
                    <tr>
                        <td class="left-align">Jane Smith</td>
                        <td class="left-align">RM 75.00</td>
                        <td class="center-align"><img src="car.png" alt="Shopping Cart" width="50" height="50" onclick="showOrderDetails(2)"></td>
                    </tr>
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
                <tbody>
                    <!-- Order details will be populated here using JavaScript -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetchOrders();
        });

        function fetchOrders() {
            fetch('get_orders.php')
                .then(response => response.json())
                .then(data => {
                    const orderTable = document.getElementById('orderTable');
                    orderTable.innerHTML = ''; // Clear previous contents

                    data.forEach(order => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td class="left-align">${order.customer_name}</td>
                            <td class="left-align">RM ${order.total_amount}</td>
                            <td class="center-align"><img src="car.png" alt="Shopping Cart" width="50" height="50" onclick="showOrderDetails(${order.id})"></td>
                        `;
                        orderTable.appendChild(row);
                    });
                })
                .catch(error => console.error('Error:', error));
        }

        function showOrderDetails(orderId) {
            fetch(`get_order_details.php?order_id=${orderId}`)
                .then(response => response.json())
                .then(data => {
                    const orderDetailsTableBody = document.getElementById('orderDetailsTable').querySelector('tbody');
                    orderDetailsTableBody.innerHTML = ''; // Clear previous contents

                    data.forEach(detail => {
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
                })
                .catch(error => console.error('Error:', error));
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('collapsed');
            document.getElementById('content-wrapper').classList.toggle('collapsed');
        }
    </script>
</body>
</html>



