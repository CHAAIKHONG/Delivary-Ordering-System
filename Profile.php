<?php
    session_start();
    $connect = mysqli_connect("localhost", "root", "", "moonbeedb");

    // 检查数据库连接
    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // 检查用户登录状态和获取用户信息
    $userPhoto = null;
    $userName = 'user';
    $user_id = $_SESSION['user_id'] ?? null;

    if (isset($_SESSION['photo'])) {
        $userPhoto = $_SESSION['photo'];
    }

    if (isset($_SESSION['fullname'])) {
        $userName = $_SESSION['fullname'];
    }

    // 初始化用户信息
    $firstName = '';
    $lastName = '';
    $email = '';
    $phoneNum = '';
    $place = '';
    $birthDate = '';

    // 获取用户信息
    $query = "SELECT first_name, last_name, email, phone_number, address FROM user WHERE user_id = '$user_id'";
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $firstName = $row['first_name'];
        $lastName = $row['last_name'];
        $email = $row['email'];
        $phoneNum = $row['phone_number'];
        $place = $row['address'];
    }

    // 处理表单提交
    if (isset($_POST['save_profile'])) {
        $firstName = mysqli_real_escape_string($connect, $_POST['first_name']);
        $lastName = mysqli_real_escape_string($connect, $_POST['last_name']);
        $email = mysqli_real_escape_string($connect, $_POST['email']);
        $phoneNum = mysqli_real_escape_string($connect, $_POST['phone_num']);
        $place = mysqli_real_escape_string($connect, $_POST['address']);
        $birthDate = mysqli_real_escape_string($connect, $_POST['birth_date']);

        // 更新数据库
        $update_query = "UPDATE user SET first_name = '$firstName', last_name = '$lastName', email = '$email', phone_number = '$phoneNum', address = '$place' WHERE user_id = '$user_id'";

        if (mysqli_query($connect, $update_query)) {
            // 更新成功，可以添加成功的消息或者重定向
            $_SESSION['fullname'] = $firstName . ' ' . $lastName;
            echo '<script>alert("Profile updated successfully!");</script>';
            echo '<script>window.location.href = "profile.php";</script>';
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($connect);
        }
    }

    mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoonBees | Profile</title>
    <link rel="icon" type="image/png" href="image/burger-removebg-preview.png">
    <link rel="stylesheet" href="head_footer.css">
    <link rel="stylesheet" href="menu.css">
    <script src="Profile.js" type="text/javascript"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
    <style>
        .profile_detail input[readonly] {
            background-color: #f0f0f0;
        }
    </style>
    <script>
        function enableEditing() {
            const inputs = document.querySelectorAll('.profile_detail input');
            inputs.forEach(input => {
                input.removeAttribute('readonly');
                input.style.backgroundColor = 'white';
            });
        }

        function saveProfile() {
            document.getElementById('profile_form').submit();
        }

    </script>
</head>
<body>
    <ul class="head">
        <li class="topleft"><a href="#home" class="head_title">MoonBees</a></li>
        <div class="all_topcenter">
            <li class="topcenter"><a href="menu.php" class="head_title">Menu</a></li>
            <li class="topcenter"><a href="ContactUs.php" class="head_title">Contact Us</a></li>
            <li class="topcenter"><a href="aboutus.php" class="head_title">About Us</a></li>
        </div>
        <div class="all_topright">
            <li class="shopping_card"><a href="shopping_cart.php"><i class="ri-shopping-cart-fill" style="color: white; display: block; margin-top: 20px; padding-right: 15px"></i></a></li>
            <li class="help"><i class="ri-question-line" style="color: white; display: block; margin-top: 20px; padding-right: 15px;"> Help</i></li>
            <li class="dropdown">
                <a href="profile.php" style="font-size: 15px; text-decoration: none;">
                    <?php if ($userPhoto) : ?>
                        <img src="image/user/<?php echo $userPhoto; ?>" alt="User Photo" style="width: 30px; height: 30px; border-radius: 50%; margin-right: 5px;"><?php echo $userName; ?>
                    <?php else : ?>
                        <i class="ri-user-5-line" style="color: white; display: block; margin-top: 20px;"><?php echo $userName; ?></i>
                    <?php endif; ?>
                </a>
            </li>
            <li class="logout"><a href="logout.php" style="color: white; display: block; margin-top: 20px; padding-left: 15px; text-decoration: none">Logout</a></li>
        </div>
    </ul>

<div class="all_infor">
    <div class="show_infor">
        <div class="all_information profile">
            <h2>My Profile</h2>
            <form id="profile_form" method="post">
                <div class="profile_detail">
                    <div class="profile_information">
                        <div class="all_name"> 
                            <input type="text" placeholder="First Name" name="first_name" value="<?php echo $firstName; ?>" readonly required>
                            <input type="text" placeholder="Last Name" name="last_name" value="<?php echo $lastName; ?>" readonly required>
                        </div>
                        <input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" readonly required>
                        <input type="text" placeholder="Phone number" name="phone_num" value="<?php echo $phoneNum; ?>" readonly required>
                    </div>
                    <hr style="margin: 50px 0px;">
                    <h2>Place</h2>
                    <input type="text" placeholder="Place" name="address" value="<?php echo $place; ?>" readonly required>
                </div>
                <div class="btnsave_container">
                    <button type="button" class="btnsave" onclick="enableEditing()">Edit</button>
                    <button type="submit" name="save_profile" class="btnsave">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<br>
<br>
<hr style="margin: 0px 300px; border: 1px solid black;">
<br><br>
<footer class="footer">
    <div id="footer-section">
        <ul>
            <li><h2><a href="#">Track My Order</a></h2></li>
        </ul>
    </div>
    <div id="footer-section">
        <h2>Service</h2>
        <ul>
            <li><a href="#">Gift Vouchers</a></li>
            <li><a href="#">Party</a></li>
            <li><a href="#">Delivery</a></li>
        </ul>
    </div>
    <div id="footer-section">
        <h2>FOLLOW US</h2>
        <ul>
            <li><a href="#">Facebook</a></li>
            <li><a href="#">Instagram</a></li>
            <li><a href="#">Tiktok</a></li>
        </ul>
    </div>
    <div id="footer-section">
        <h2>Help & Support</h2>
        <ul>
            <li><a href="ContactUs.html">Share Your Feedback</a></li>
            <li><a href="#">Terms & Conditions</a></li>
        </ul>
    </div>
</footer>
</body>
</html>