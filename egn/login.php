<?php

include("php/classes.php");

$username = "";
$password = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $login = new Login();
  $result = $login->evaluate($_POST);

  if ($result != "") {
  } else {
    header("Location:index.php");
    die;
  }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link rel="stylesheet" href="style.css">
    <title>Booking Stytem AP | Signup</title>
</head>

<body>
    <div class="container">
        <div class="signin-signup">
            <form method="post" class="sign-in-form">
                <h2 class="title">Login</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" placeholder="Username">
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password">
                </div>
                <input type="submit" value="Login" class="btn">
            </form>
            <?php
            if ($result != "") {
                echo ' <span class="error">'.$result.'</span> ';
                die;
              }
           
            ?>
        </div>
    </div>
</body>

</html>