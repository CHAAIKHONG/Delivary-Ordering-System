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
    margin-bottom: 20px;
}

.staff-details .form-group label {
    display: block;
    font-weight: bold;
}

.staff-details .form-group input,
.staff-details .form-group textarea {
    width: 100%;
    padding: 12px; /* Increased padding for better touch feel */
    margin-top: 8px; /* Adjusted margin */
    border-radius: 8px; /* Rounded corners */
    border: 1px solid #ccc;
    box-sizing: border-box;
    font-size: 16px; /* Slightly increased font size */
}

.staff-details .form-row {
    display: flex;
    justify-content: space-between;
}

.staff-details .form-row .form-group {
    width: 48%;
}

.staff-details .form-group textarea {
    height: 120px; /* Increased height */
    resize: vertical;
}

.back-button, .add-button {
    position: absolute;
    right: 10px;
    bottom: 10px; /* Adjusted to bottom */
    padding: 12px 24px; /* Increased padding */
    font-size: 18px; /* Increased font size */
    color: black;
    background-color: lightgrey;
    border: 1px solid #ccc;
    border-radius: 8px; /* Rounded corners */
    cursor: pointer;
}

.add-button {
    right: 140px; /* Adjusted position */
}

.back-button:hover, .add-button:hover {
    background-color: grey; /* Hover color */
}

@media (max-width: 768px) {
    .container {
        padding: 10px;
    }
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

    <div class="container">
        <form action="" method="post">
            <h1>Add New Staff</h1>
            <div class="profile-container">
                <div class="staff-profile">
                    <img src="default_profile.jpg" alt="Profile Picture">
                </div>
                <div class="staff-details">
                    <div class="form-group">
                        <label for="Name">Full Name:</label>
                        <input type="text" id="Name" name="Name" required>
                    </div>
                    <div class="form-group">
                        <label for="years">Years old:</label>
                        <input type="text" id="years" name="years" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="tel" id="phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="Salary">Salary:</label>
                        <input type="text" id="Salary" name="Salary" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" id="address" name="address" required>
                    </div>
                    <div class="form-group">
                        <label for="experience">Work Experience:</label>
                        <textarea id="experience" name="experience" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="skills">Skills:</label>
                        <textarea id="skills" name="skills" required></textarea>
                    </div>
                </div>
            </div>
            <button type="submit" class="add-button">Add Staff</button>
            <button type="button" class="back-button" onclick="location.href='managestaff.php'">Back</button>
        </form>
    </div>
</body>
</html>
