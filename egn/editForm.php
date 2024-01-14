<?php

require_once('functions.php');
// Assuming you have the Database class defined in 'functions.php'
$db = new Database();

// Get the selected event ID
$selectedEventID = $_GET['eventID'];

// Retrieve the current details of the selected event
$sqlEventDetails = "SELECT * FROM EGN_events WHERE eventID = :eventID";
$params = array(':eventID' => $selectedEventID);

$resultEventDetails = $db->query($sqlEventDetails, $params);

// Check if the query was successful
if ($resultEventDetails !== false) {
    // Fetch the event details as an associative array
    $eventDetails = (!empty($resultEventDetails)) ? $resultEventDetails[0] : false;

    // Check if any data was fetched
    if ($eventDetails !== false) {
        // Assuming there is only one row for the selected event
        $firstEventDetails = $eventDetails;
    } else {
        // Handle the case when no event is found
        echo "Event not found.";
    }
}
?>



<form method="post" action="updateEvent.php">
    <input type="hidden" name="selectedEventID" value="<?= $selectedEventID ?>">

    <label for="eventTitle">Title:</label>
    <input type="text" name="eventTitle" value="<?= htmlspecialchars($eventDetails['eventTitle']) ?>" required>

    <label for="eventTitle">Description:</label>
    <input type="text" name="eventDescription" value="<?= htmlspecialchars($eventDetails['eventDescription']) ?>" required>

    <label for="eventStartDate">Start Date:</label>
    <input type="date" name="eventStartDate" value="<?= $eventDetails['eventStartDate'] ?>" required>

    <label for="eventEndDate">End Date:</label>
    <input type="date" name="eventEndDate" value="<?= $eventDetails['eventEndDate'] ?>" required>

    <label for="eventEndDate">Price:</label>
    <input type="text" name="eventPrice" value="<?= $eventDetails['eventPrice'] ?>" required>

    <input type="submit" value="Update Event">
</form>