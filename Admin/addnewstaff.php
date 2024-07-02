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

.container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: calc(100vh - 80px); /* Adjusted for the header height */
    padding: 20px;
    box-sizing: border-box;
}

form {
    background-color: rgba(255, 255, 255, 0.8);
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    width: 100%;
    max-width: 900px; /* Adjusted to match staffdetails */
}

form h1 {
    text-align: center;
    margin-bottom: 20px;
}

form label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
}

form input,
form textarea {
    width: calc(100% - 20px);
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

form textarea {
    height: 100px;
}

form button {
    background-color: lightgrey;
    color: black;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
}

form button:hover {
    background-color: grey;
}

@media (max-width: 768px) {
    .container {
        padding: 10px;
    }

    form {
        padding: 20px;
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
            <button type="submit">Add Staff</button>
            <button type="button" class="back-button" onclick="location.href='managestaff.php'">Back</button>
        </form>
    </div>
</body>
</html>
