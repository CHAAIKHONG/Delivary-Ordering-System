<?php
$connect = mysqli_connect("localhost", "root", "", "moonbeedb");

$update_success = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['Name'];
    $years = $_POST['years'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $salary = $_POST['Salary'];
    $address = $_POST['address'];
    $experience = $_POST['experience'];
    $skills = $_POST['skills'];
    $position = $_POST['position'];

    $photo_destination = ''; 

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $photo = $_FILES['photo'];
        $photo_name = $photo['name'];
        $photo_tmp_name = $photo['tmp_name'];
        $photo_size = $photo['size'];
        $photo_error = $photo['error'];
        $photo_type = $photo['type'];

        $photo_ext = explode('.', $photo_name);
        $photo_actual_ext = strtolower(end($photo_ext));
        $allowed = array('jpg', 'jpeg', 'png');

        if (in_array($photo_actual_ext, $allowed)) {
            if ($photo_error === 0) {
                if ($photo_size < 5000000) { 
                    $photo_new_name = uniqid('', true) . "." . $photo_actual_ext;
                    $photo_destination = 'uploads/' . $photo_new_name;

                    if (!is_dir('uploads')) {
                        mkdir('uploads', 0777, true);
                    }

                    if (move_uploaded_file($photo_tmp_name, $photo_destination)) {
                        
                        echo '<script>alert("File uploaded successfully.")</script>';
                    } else {
                        echo '<script>alert("Failed to move the uploaded file.")</script>'; 
                    }
                } else {
                    echo '<script>alert("Your file is too big!")</script>'; 
                }
            } else {
                echo '<script>alert("There was an error uploading your file!")</script>'; 
            }
        } else {
            echo '<script>alert("You cannot upload files of this type!")</script>'; 
        }
    } else {
        echo '<script>alert("No file uploaded or there was an error!")</script>'; 
    }

    $query = "INSERT INTO staff (fullname, yearsold, email, phone, salary, address, workexperience, skill, photo, position) VALUES ('$fullname', '$years', '$email', '$phone', '$salary', '$address', '$experience', '$skills', '$photo_destination', '$position')";

    if (mysqli_query($connect, $query)) {
        echo '<script>window.location.href = "managestaff.php";</script>';
        exit();
    } else {
        echo "Error adding new record: " . mysqli_error($connect);
    }
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MoonBees | Add New Staff</title>
<link rel="icon" href="burger.png" type="image/png">
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
<style>
body 
{
    background-image: url("bg.jpg.png"); 
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
    height: 100vh;
    margin: 0;
    overflow: hidden; 
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
}

ul.head li 
{
    float: left;
}

ul.head li.topleft 
{
    margin-left: 20px;
    display: flex;
    align-items: center;
}

ul.head li a 
{
    display: block;
    color: rgb(255, 255, 255);
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 25px;
    font-family: initial;
}

ul.head li.topright:hover 
{
    background-color: green;
}

ul.head li.topright 
{
    float: right;
}

.all_topright 
{
    margin-left: 80%;
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

.container 
{
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 80px; 
    height: calc(100vh - 80px); 
    overflow: hidden; 
}

.scrollable-content 
{
    width: 100%;
    max-width: 900px;
    overflow-y: auto; 
    padding: 20px;
    box-sizing: border-box;
    height: 100%;
    scrollbar-width: none; 
    -ms-overflow-style: none;  
}

.scrollable-content::-webkit-scrollbar 
{ 
    display: none;  
}

.profile-container 
{
    display: flex;
    align-items: center;
    background-color: rgba(255, 255, 255, 0.8);
    border-radius: 15px;
    padding: 50px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    margin-bottom: 20px;
    position: relative; 
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

.staff-profile 
{
    text-align: center;
    margin-right: 20px;
}

.staff-profile img 
{
    border-radius: 50%;
    width: 150px;
    height: 150px;
    object-fit: cover;
    margin-bottom: 10px;
    border: 5px solid rgba(0, 0, 0, 0.2); /* Adjusted border size */
}

.staff-profile h2 
{
    margin: 10px 0;
    font-size: 30px;
}

.position 
{
    font-size: 20px;
}

.staff-details 
{
    width: 100%;
    position: relative;
}

.staff-details h3 
{
    margin-bottom: 15px;
    font-size: 30px;
    border-bottom: 1px solid #ddd;
    padding-bottom: 5px;
}

.staff-details .form-group 
{
    margin: 10px 0;
}

.staff-details .form-group label 
{
    display: block;
    font-weight: bold;
}

.staff-details .form-group input,
.staff-details .form-group textarea 
{
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    border-radius: 5px;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

.staff-details .form-row 
{
    display: flex;
    justify-content: space-between;
}

.staff-details .form-row .form-group 
{
    width: 48%;
}

.staff-details .form-group input[type="text"],
.staff-details .form-group input[type="email"],
.staff-details .form-group input[type="tel"] 
{
    height: 30px;
}

.staff-details .form-group textarea 
{
    height: 80px;
    resize: vertical;
}

.button-container 
{
    display: flex;
    justify-content: flex-end; 
    gap: 10px;
    position: absolute;
    right: 10px;
}

.add-button,
.back-button 
{
    padding: 10px 20px;
    font-size: 16px;
    color: black;
    background-color: lightgrey;
    border: 1px solid #ccc;
    border-radius: 5px;
    cursor: pointer;
}

.add-button:hover,
.back-button:hover 
{
    background-color: grey;
}
</style>
</head>
<body>
<?php if (isset($_GET['success'])): ?>
    <script>alert('Staff added successfully!');</script>
<?php endif; ?>

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

<div class="container">
    <div class="scrollable-content">
        <div class="profile-container">
            <div class="staff-details">
                <h3>Staff Details</h3>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="Name">Full Name:</label>
                            <input type="text" id="Name" name="Name" required>
                        </div>
                        <div class="form-group">
                            <label for="years">Years Old:</label>
                            <input type="text" id="years" name="years" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone:</label>
                            <input type="tel" id="phone" name="phone" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="Salary">Salary:</label>
                            <input type="text" id="Salary" name="Salary" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" id="address" name="address" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="experience">Work Experience:</label>
                        <textarea id="experience" name="experience" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="skills">Skills:</label>
                        <textarea id="skills" name="skills" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="position">Position:</label>
                        <input type="text" id="position" name="position" required>
                    </div>
                    <div class="form-group">
                        <label for="photo">Upload Photo:</label>
                        <input type="file" id="photo" name="photo" accept="image/*">
                    </div>
                    <div class="button-container">
                        <button type="submit" class="add-button">Add</button>
                        <button type="button" class="back-button" onclick="location.href='managestaff.php'">Back</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function toggleSidebar() 
{
    document.getElementById('sidebar').classList.toggle('collapsed');
}
</script>
</body>
</html>

