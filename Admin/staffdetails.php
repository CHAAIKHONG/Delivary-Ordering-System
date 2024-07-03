<?php
$connect = mysqli_connect("localhost", "root", "", "moonbeedb");

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

$update_success = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $fullname = $_POST['Name'];
    $years = $_POST['years'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $salary = $_POST['Salary'];
    $address = $_POST['address'];
    $experience = $_POST['experience'];
    $skills = $_POST['skills'];

    $query = "UPDATE staff SET fullname='$fullname', yearsold='$years', email='$email', phone='$phone', salary='$salary', address='$address', workexperience='$experience', skill='$skills' WHERE id='$id'";

    if (mysqli_query($connect, $query)) {
        $update_success = true;
    } else {
        echo "Error updating record: " . mysqli_error($connect);
    }

    // Refresh the staff details after update
    $query = "SELECT * FROM staff WHERE id = $id";
    $result = mysqli_query($connect, $query);
    $staff = mysqli_fetch_assoc($result);
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
    right: 10px;
    padding: 10px 20px;
    font-size: 16px;
    color: black;
    background-color: lightgrey;
    border: 1px solid #ccc;
    border-radius: 5px;
    cursor: pointer;
}

.save-button {
    position: absolute;
    right: 100px;
    padding: 10px 20px;
    font-size: 16px;
    color: black;
    background-color: lightgrey;
    border: 1px solid #ccc;
    border-radius: 5px;
    cursor: pointer;
}

.back-button:hover {
    background-color: grey;
}

.back-button:hover {
    background-color: grey;
}
</style>

<script>
<?php if ($update_success): ?>
    alert("Staff details updated successfully.");
<?php endif; ?>
</script>

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
                        <img src="<?php echo $staff['photo']; ?>" alt="<?php echo $staff['fullname']; ?>">
                        <h2><?php echo $staff['fullname']; ?></h2>
                        <p class="position"><?php echo $staff['position']; ?></p>
                    </div>
                    <div class="staff-details">
                        <form action="" method="post">
                            <h3>Personal Information</h3>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="Name">Full Name</label>
                                    <input type="text" id="Name" name="Name" value="<?php echo $staff['fullname']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="years">Years old</label>
                                    <input type="text" id="years" name="years" value="<?php echo $staff['yearsold']; ?>">
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
                                <textarea id="experience" name="experience"><?php echo $staff['workexperience']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="skills">Skills</label>
                                <textarea id="skills" name="skills"><?php echo $staff['skill']; ?></textarea>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $staff['id']; ?>">
                            <button type="submit" class="save-button" style="background-color: lightgrey;">Save</button>
                            <button type="button" class="back-button" onclick="location.href='managestaff.php'">Back</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
