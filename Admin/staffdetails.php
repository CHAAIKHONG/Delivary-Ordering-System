<?php
$connect = mysqli_connect("localhost","root","","moonbeedb");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM staff WHERE id = $id";
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) > 0) {
        $staff = mysqli_fetch_assoc($result);
    } else {
        echo "No staff found with this ID.";
        exit;
    }
} else {
    echo "No ID provided.";
    exit;
}
mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MoonBees | Staff Details</title>
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
    overflow: hidden; /* Prevent scrolling on the body */
}

/* Additional CSS styles here */

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
    

        <div class="container">
            <div class="scrollable-content">
                <div class="profile-container">
                    <div class="staff-profile">
                        <img src="image/staff/<?php echo $staff['photo']; ?>" alt="<?php echo $staff['name']; ?>">
                        <h2><?php echo $staff['name']; ?></h2>
                        <p class="position"><?php echo $staff['position']; ?></p>
                    </div>
                    <div class="staff-details">
                        <h3>Personal Information</h3>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="Name">Full Name</label>
                                <input type="text" id="Name" name="Name" value="<?php echo $staff['name']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="years">Years old</label>
                                <input type="text" id="years" name="years" value="<?php echo $staff['years']; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" value="<?php echo $staff['email']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="tel" id="phone" name="phone" value="<?php echo $staff['phone']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Salary">Salary</label>
                            <input type="text" id="Salary" name="Salary" value="<?php echo $staff['salary']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" id="address" name="address" value="<?php echo $staff['address']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="experience">Work Experience</label>
                            <textarea id="experience" name="experience"><?php echo $staff['experience']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="skills">Skills</label>
                            <textarea id="skills" name="skills"><?php echo $staff['skills']; ?></textarea>
                        </div>
                        <button class="back-button" onclick="location.href='managestaff.php'">Back</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
