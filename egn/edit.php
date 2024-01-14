<?php
require_once('functions.php');

// check if user is logged in
$login = new Login();
$user_data = $login->check_login($_SESSION['eng_userid'], false);

// Get database connection using PDO
$dbConn = getConnection();

// Fetch events for the dropdown list
$sqlEvents = 'SELECT eventID, eventTitle, eventStartDate, eventEndDate, catDesc, venueName FROM EGN_events e 
              INNER JOIN EGN_categories c ON e.catID = c.catID 
              INNER JOIN EGN_venues v ON e.venueID = v.venueID 
              ORDER BY eventTitle';
$resultEvents = $dbConn->query($sqlEvents);

// Fetch all events
if ($resultEvents !== false) {
    // Check if $resultEvents is an array
    $events = is_array($resultEvents) ? $resultEvents : $resultEvents->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Handle the case when no events are found
    $events = array();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Stytem AP | Edit</title>
    <link rel="stylesheet" href="edit_styles.css">
    <link rel="stylesheet" href="home_styles.css">
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

    <h1>Edit Event Details</h1>

    <select id="eventsDropdown">
        <option value="">Select Event</option>
        <?php foreach ($events as $event) : ?>
            <option value="<?= $event['eventID'] ?>"><?= htmlspecialchars($event['eventTitle']) ?></option>
        <?php endforeach; ?>
    </select>

    <!-- Popup for editing event details -->
    <div id="editFormContainer" class="popup">
        <div class="close-button" onclick="closeForm()">X</div>
        <form method="post" action="updateEvent.php">
            <input type="submit" value="Update Event">
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var eventsDropdown = document.getElementById('eventsDropdown');
            var editFormContainer = document.getElementById('editFormContainer');

            eventsDropdown.addEventListener('change', function() {
                var selectedEventID = eventsDropdown.value;
                if (selectedEventID !== '') {
                    // Fetch and display the edit form for the selected event
                    fetchEditForm(selectedEventID);
                } else {
                    // Clear the edit form container
                    editFormContainer.innerHTML = '';
                }
            });

            function fetchEditForm(eventID) {
                // Make an AJAX request to get the edit form
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Display the edit form in the popup
                        editFormContainer.innerHTML = xhr.responseText;
                        editFormContainer.style.display = 'block';
                    }
                };

                xhr.open('GET', 'editForm.php?eventID=' + eventID, true);
                xhr.send();
            }

            function closeForm() {
                editFormContainer.style.display = 'none';
            }
        });
    </script>
</body>

</html>