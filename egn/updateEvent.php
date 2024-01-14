<?php

require_once('functions.php');

// check if user is logged in
$login = new Login();
$user_data = $login->check_login($_SESSION['eng_userid'], false);

// Assuming you have the Database class defined in 'functions.php'
$db = new Database();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the selected event ID
    $selectedEventID = $_POST['selectedEventID'];

    // Validate and sanitize form data
    $eventTitle = htmlspecialchars($_POST['eventTitle']);
    $eventDescription = htmlspecialchars($_POST['eventDescription']);
    $eventStartDate = $_POST['eventStartDate'];
    $eventEndDate = $_POST['eventEndDate'];
    $eventPrice = $_POST['eventPrice'];

    $sqlUpdateEvent = "UPDATE EGN_events SET 
                    eventTitle = :eventTitle, 
                    eventDescription = :eventDescription, 
                    eventStartDate = :eventStartDate, 
                    eventEndDate = :eventEndDate, 
                    eventPrice = :eventPrice 
                    WHERE eventID = :eventID";

    $params = array(
        ':eventTitle' => $eventTitle,
        ':eventDescription' => $eventDescription,
        ':eventStartDate' => $eventStartDate,
        ':eventEndDate' => $eventEndDate,
        ':eventPrice' => $eventPrice,
        ':eventID' => $selectedEventID
    );

    $resultUpdateEvent = $db->update($sqlUpdateEvent, $params);

    if ($resultUpdateEvent) {
        echo "<div style='background:#fff;color:#000;padding:10px;'> Event updated successfully!</div>";
    } else {
        echo "<div style='background:#fff;color:#000;padding:10px;'> Error updating event. </div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Stytem AP | Successful</title>
    <link rel="stylesheet" href="edit_styles.css">
    <link rel="stylesheet" href="home_styles.css">
    <!-- Google Icons Link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0">
</head>

<body>
    <header style="margin-top: 10%;">
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
</body>

</html>