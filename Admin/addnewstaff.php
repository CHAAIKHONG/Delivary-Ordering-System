<?php
$connect = mysqli_connect("localhost", "root", "", "moonbeedb");
// hihihihihihi
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

    $photo_destination = ''; // 初始化变量以避免未定义错误


    // 处理上传的照片
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
                if ($photo_size < 5000000) { // 文件大小限制为 5MB
                    $photo_new_name = uniqid('', true) . "." . $photo_actual_ext;
                    $photo_destination = 'uploads/' . $photo_new_name;

                    if (!is_dir('uploads')) {
                        mkdir('uploads', 0777, true);
                    }

                    if (move_uploaded_file($photo_tmp_name, $photo_destination)) {
                        // 文件上传成功
                        echo "File uploaded successfully.<br>";
                    } else {
                        echo "Failed to move the uploaded file.<br>";
                    }
                } else {
                    echo "Your file is too big!";
                }
            } else {
                echo "There was an error uploading your file!";
            }
        } else {
            echo "You cannot upload files of this type!";
        }
    } else {
        echo "No file uploaded or there was an error!";
    }

    // 插入数据到数据库
    $query = "INSERT INTO staff (fullname, yearsold, email, phone, salary, address, workexperience, skill, photo, position) VALUES ('$fullname', '$years', '$email', '$phone', '$salary', '$address', '$experience', '$skills', '$photo_destination', '$position')";

    if (mysqli_query($connect, $query)) {
        $update_success = true;
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
body {
    background-image: url("bg.jpg.png"); 
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
    height: 100vh;
    margin: 0;
    overflow: hidden; 
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

ul.head li.topright:hover {
    background-color: green;
}

ul.head li.topright {
    float: right;
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

.container {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 80px; /* Adjust to avoid navbar */
    height: calc(100vh - 80px); /* Adjust container height to avoid header */
    overflow: hidden; 
}

.scrollable-content {
    width: 100%;
    max-width: 900px;
    overflow-y: auto; /* Allow vertical scrolling */
    padding: 20px;
    box-sizing: border-box;
    height: 100%;
    scrollbar-width: none; /* Firefox */
    -ms-overflow-style: none;  /* IE 10+ */
}

.scrollable-content::-webkit-scrollbar { 
    display: none;  /* Safari and Chrome */
}

.profile-container {
    display: flex;
    align-items: center;
    background-color: rgba(255, 255, 255, 0.8);
    border-radius: 15px;
    padding: 50px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    margin-bottom: 20px;
    position: relative; /* For positioning the button */
}

.staff-profile {
    text-align: center;
    margin-right: 20px;
}

.staff-profile img {
    border-radius: 50%;
    width: 150px;
    height: 150px;
    object-fit: cover;
    margin-bottom: 10px;
    border: 5px solid rgba(0, 0, 0, 0.2); /* Adjusted border size */
}

.staff-profile h2 {
    margin: 10px 0;
    font-size: 30px;
}

.position {
    font-size: 20px;
}

.staff-details {
    width: 100%;
    position: relative;
}

.staff-details h3 {
    margin-bottom: 15px;
    font-size: 30px;
    border-bottom: 1px solid #ddd;
    padding-bottom: 5px;
}

.staff-details .form-group {
    margin: 10px 0;
}

.staff-details .form-group label {
    display: block;
    font-weight: bold;
}

.staff-details .form-group input,
.staff-details .form-group textarea {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    border-radius: 5px;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

.staff-details .form-row {
    display: flex;
    justify-content: space-between;
}

.staff-details .form-row .form-group {
    width: 48%;
}

.staff-details .form-group input[type="text"],
.staff-details .form-group input[type="email"],
.staff-details .form-group input[type="tel"] {
    height: 30px;
}

.staff-details .form-group textarea {
    height: 80px;
    resize: vertical;
}

.back-button {
    position: absolute;
    top: 10px;
    right: 10px;
    background-color: #f44336;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    font-size: 18px;
    cursor: pointer;
    text-decoration: none;
}

.staff-details .form-group input[type="submit"] {
    width: auto;
    background-color: green;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 18px;
    cursor: pointer;
    border-radius: 5px;
}

.staff-details .form-group input[type="submit"]:hover {
    background-color: #45a049;
}
</style>
</head>
<body>
    <ul class="head">
        <li class="topleft">
            <a href="javascript:void(0);" onclick="toggleMenu()">&#9776;</a>
            <a href="staffdetails.php">Staff Details</a>
        </li>
        <li class="topright">
            <a href="index.php" class="all_topright">Home</a>
        </li>
        <li class="topright">
            <a href="logout.php">Logout</a>
        </li>
    </ul>

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
                        <div class="form-group">
                            <input type="submit" value="Add Staff">
                        </div>
                    </form>
                    <button type="button" class="back-button" onclick="location.href='managestaff.php'">Back</button>
                </div>
            </div>
        </div>
    </div>

<script>
function toggleMenu() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
</script>
</body>
</html>
