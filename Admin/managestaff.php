<?php 
$connect = mysqli_connect("localhost","root","","moonbeedb"); 

$query = "SELECT * FROM staff";
$result = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MoonBees | Manage Staff</title>
<link rel="icon" href="burger.png" type="image/png">
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
    }

    ul.head li {
        float: left;
    }

    ul.head li.topleft {
        margin-left: 100px;
        display: flex;
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

    ul.head li.topcenter:hover {
        background-color: green;
    }

    .all_topcenter {
        margin-left: 37%;
    }

    .all_topright {
        margin-left: 80%;
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
        font-family: Arial, sans-serif;
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

    .staffbox {
        padding: 20px;
        margin: 80px auto 50px; 
        border-radius: 50px;
        width: 100%; 
        max-width: 950px; 
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        align-items: center;
    }

    .staffbox2 {
        padding: 20px; 
        margin: 20px auto 20px; 
        border-radius: 50px;
        width: 100%; 
        max-width: 950px; 
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        align-items: center;
    }

    .staff-member {
        background-color: white;
        border: 5px solid black;
        border-radius: 15px;
        padding: 10px;
        margin: 10px;
        text-align: center;
        width: 200px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s, box-shadow 0.3s;
        position: relative;
    }

    .staff-member:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .staff-member img {
        width: 100%;
        border-radius: 10px;
        cursor: pointer;
    }

    .staff-member img.add {
        width: 70%;
    }

    .staff-member:hover .details {
        display: flex;
    }

    .details {
        display: none;
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        background-color: rgb(0, 0, 0);
        border: 1px solid black;
        border-radius: 10px;
        padding: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        flex-direction: row;
        justify-content: center;
        gap: 5px;
    }

    .details button {
        margin: 5px;
        padding: 5px 10px;
        font-size: 14px;
        cursor: pointer;
        background-color: black;
        color: white;
        border: none;
        border-radius: 5px;
    }

    .details button:hover {
        background-color: green;
    }

</style>
</head>
<body>
    <div class="all_container">
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
                            <li><a href="javascript:void(0)" onclick="location.href='manageproduct.html'">Manage Products</a></li>
                            <li><a href="javascript:void(0)" onclick="location.href='report.html'">Report</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="staffbox">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="staff-member">
                        <img src="image/staff/'.$row['photo'].'" alt="'.$row['fullname'].'">
                        <p>'.$row['name'].'</p>
                        <div class="details">
                            <button onclick="location.href=\'staffdetails.php?id='.$row['id'].'\'">Staff Details</button>
                            <button>Remove</button>
                        </div>
                    </div>';
                }
            }
            mysqli_close($connect);
            ?>
            <div class="staff-member">
                <img src="add.png" alt="Add Staff" class="add">
                <p>Add</p>
                <div class="details">
                    <button>Add New Staff</button>
                </div>
            </div>
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
