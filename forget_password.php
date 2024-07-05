<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Include PHPMailer files
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $connect = mysqli_connect("localhost", "root", "", "moonbeedb");

    if (!$connect) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    $email = mysqli_real_escape_string($connect, $_POST['email']);

    $sql = "SELECT user_id, password FROM user WHERE email='$email'";
    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $password = $user['password'];

        // Send email using PHPMailer
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'moonbees5431@gmail.com'; // Your Gmail address
            $mail->Password = 'dgjz zxiz hfwn cabp'; // Your Gmail password or app-specific password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('moonbees5431@gmail.com', 'MoonBees');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Your Password';
            $mail->Body    = 'Hello,<br><br>Your password is: ' . $password . '<br><br>Best regards,<br>MoonBees Team';


            $mail->send();
            echo '<script>alert("Password has been sent to your email.")</script>';
        } catch (Exception $e) {
            echo '<script>alert("Failed to send email. Mailer Error: ' . $mail->ErrorInfo . '")</script>';
        }
    } else {
        echo '<script>alert("Invalid Email Address")</script>';
    }

    mysqli_close($connect);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
    <link rel="icon" type="image/png" href="image/burger-removebg-preview.png">
    <link rel="stylesheet" href="head_footer.css">
    <link rel="stylesheet" href="login.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
</head>
<body>
    <ul class="head">
        <li class="topleft"><a href="#home" class="head_title">MoonBees</a></li>
        <div class="all_topcenter"></div>
        <div class="all_topright">
            <li class="help"><i class="ri-question-line" style="color: white; display: block; margin-top: 20px; padding-right: 15px;"> Help</i></li>
        </div>
    </ul>
    <main class="abc">
        <div class="video_container">
            <video autoplay muted loop src="video/11805691-hd_2048_1024_24fps.mp4" id="background_video"></video>
        </div>
        <div class="form_container">
            <form method="post" action="forget_password.php">
                <div class="container">
                    <h1>Forget Password</h1>
                    <input type="text" placeholder="Enter Email" name="email" required>
                    <button type="submit">Submit</button>
                    <a href="login.php" class="back_to_login">Back to Login</a>
                </div>
            </form>
        </div>
    </main>

    <br><br>
    <hr style="border: 1px solid rgb(255, 255, 255); margin: 0 300px;">

    <footer class="footer">
        <div id="footer-section">
            <ul>
                <li><h2><a href="">Track My Order</a></h2></li>
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
                <li><a href="#">Tiktokv</a></li>
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
