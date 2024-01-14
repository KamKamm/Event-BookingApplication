<?php
require_once('functions.php');
// check if user is logged in
$login = new Login();
$user_data = $login->check_login($_SESSION['eng_userid'], false);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="credit_style.css">
    <link rel="stylesheet" href="home_styles.css">
    <title>Booking Stytem AP | Credits</title>
    <!-- Google Icons Link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0">
</head>

<body>
    <header>
        <nav class="navbar">
            <a href="index.php" class="logo">
                BookING SYS
            </a>
            <ul class="menu-links">
                <li><a href="bookEventsForm.php">Book an Event</a></li>
                <?php if ($user_data == true) : ?>
                    <li class="join-btn"><a href="logout.php">Logout</a></li>
                <?php else : ?>
                    <li><a href="login.php">Sign In</a></li>
                <?php endif; ?>
                <span id="close-menu-btn" class="material-symbols-outlined">close</span>
            </ul>
            <span id="hamburger-btn" class="material-symbols-outlined">menu</span>
        </nav>
    </header>
    <div class="container_main">
        <div class="item">
            <p class="name">My Name:</p>
            <span class="actual_name">Jonathan Sanderson</span>
        </div>
        <div class="item">
            <p class="student">My Id</p>
            <span class="id"></span>
        </div>
    </div>
    <script>
        const header = document.querySelector("header");
        const hamburgerBtn = document.querySelector("#hamburger-btn");
        const closeMenuBtn = document.querySelector("#close-menu-btn");

        // Toggle mobile menu on hamburger button click
        hamburgerBtn.addEventListener("click", () => header.classList.toggle("show-mobile-menu"));

        // Close mobile menu on close button click
        closeMenuBtn.addEventListener("click", () => hamburgerBtn.click());
    </script>
</body>

</html>