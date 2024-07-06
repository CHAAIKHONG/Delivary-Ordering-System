<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

$connect = mysqli_connect("localhost", "root", "", "moonbeedb");

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $total = $_POST['total'];

    // 插入订单到 order 表
    $query = "INSERT INTO `order` (user_id, total_price, payment_status, payment_method) VALUES ($user_id, $total, 'DONE', 'Cash_On_Delivery')";
    mysqli_query($connect, $query);
    $order_id = mysqli_insert_id($connect);

    $order_items = json_decode($_POST['order_items'], true); // 解码为关联数组

    if (is_array($order_items)) {
        // 插入订单详情到 order_detail 表
        foreach ($order_items as $item) {
            $product_id = $item['product_id'];
            $price = $item['price'];
            $quantity = $item['quantity'];

            $sql = "INSERT INTO order_detail (order_id, product_id, price, quantity) VALUES ($order_id, $product_id, $price, $quantity)";
            mysqli_query($connect, $sql);
        }
        $cartitem = "DELETE FROM cartitem WHERE user_id = $user_id";
        mysqli_query($connect, $cartitem);

        // 发送确认邮件
        $userEmailQuery = "SELECT email FROM user WHERE user_id = $user_id";
        $userEmailResult = mysqli_query($connect, $userEmailQuery);

        if (mysqli_num_rows($userEmailResult) > 0) {
            $user = mysqli_fetch_assoc($userEmailResult);
            $email = $user['email'];

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
                $mail->Subject = 'Order Confirmation';
                $mail->Body    = 'Hello,<br><br>Your order has been placed successfully. <br>Your order ID is: ' . $order_id . '<br><br>Best regards,<br>MoonBees Team';

                $mail->send();
                echo '<script>alert("Order placed successfully! Confirmation email has been sent.");</script>';
            } catch (Exception $e) {
                echo '<script>alert("Order placed successfully, but failed to send email. Mailer Error: ' . $mail->ErrorInfo . '")</script>';
            }
        }

        echo '<script>window.location.href = "menu.php";</script>';
        exit();
    } else {
        echo '<script>alert("Error: Invalid order items data.")</script>';
    }
} else {
    echo '<script>alert("User not logged in.")</script>';
}
?>
