<?php 
$connect = mysqli_connect("localhost","root","","moonbeedb"); 

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    $query = "DELETE FROM staff WHERE id=$id";

    if (mysqli_query($connect, $query)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($connect);
    }
}

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
    body 
    {
        background-image: url("bg.jpg.png"); 
        background-size: cover;
        background-repeat: no-repeat; 
        background-attachment:fixed;
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
    
    body, html 
    {
        height: 100%;
        margin: 0;
        position: relative;
        font-family: Arial, sans-serif;
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

    .staffbox 
    {
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

    .staffbox2 
    {
        padding: 20px; 
        margin: 20px auto 20px; 
        border-radius: 50px;
        width: 100%; 
        max-width: 950px; 
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        align-items: center.
    }

    .staff-member 
    {
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

    .staff-member:hover 
    {
        transform: scale(1.05);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .staff-member img 
    {
        width: 100%;
        border-radius: 10px;
        cursor: pointer;
    }

    .staff-member img.add 
    {
        width: 70%;
    }

    .staff-member:hover .details 
    {
        display: flex;
    }

    .details 
    {
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

    .details button 
    {
        margin: 5px;
        padding: 5px 10px;
        font-size: 14px;
        cursor: pointer;
        background-color: black;
        color: white;
        border: none;
        border-radius: 5px;
    }

    .details button:hover 
    {
        background-color: #575757;
    }

    .details button:nth-child(1):hover 
    {
        background-color: #ffcc00;
    }

    .details button:nth-child(2):hover 
    {
        background-color: red;
    }

    .logout 
    {
        margin-right: 20px;
    }

    .logout a 
    {
        font-size: 15px;
        text-decoration: none;
        color: white;
        display: block;
        padding: 14px 16px;
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
                        <li><a href="javascript:void(0)" onclick="location.href='Manageproduct.php'">Manage Products</a></li>
                        <li><a href="javascript:void(0)" onclick="location.href='report.html'">Report</a></li>
                        <li><a href="javascript:void(0)" onclick="location.href='orderhistory.php'">Order History</a></li>
                        <li><a href="javascript:void(0)" onclick="location.href='managecategory.php'">Manage Category</a></li>
                        <li><a href="javascript:void(0)" onclick="location.href='contactus.php'">Contact Us History</a></li>
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
                        <img src="'.$row['photo'].'" alt="'.$row['fullname'].'">
                        <p>'.$row['fullname'].'</p>
                        <div class="details">
                            <button onclick="location.href=\'staffdetails.php?id='.$row['id'].'\'">Staff Details</button>
                            <button onclick="if(confirm(\'Are you sure you want to delete this staff member?\')) location.href=\'managestaff.php?delete_id='.$row['id'].'\'">Remove</button>
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
                <button type="button"  onclick="location.href='addnewstaff.php'">Add New Staff</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() 
        {
            document.getElementById('sidebar').classList.toggle('collapsed');
            document.getElementById('content-wrapper').classList.toggle('collapsed');
        }
    </script>
</body>
</html>
