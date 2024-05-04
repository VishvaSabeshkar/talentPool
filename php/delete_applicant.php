<?php
// Include the database connection file
require_once 'connection.php';

// Check if the talentPoolID is provided via GET request
if(isset($_GET['talentPoolID'])) {
    // Sanitize the input to prevent SQL injection
    $talentPoolID = filter_var($_GET['talentPoolID'], FILTER_SANITIZE_NUMBER_INT);

    // Prepare and execute a SQL statement to delete the record based on the talentPoolID
    $sql = "DELETE FROM talentPool WHERE talentPoolID = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param("i", $talentPoolID);
    
    if ($statement->execute()) {
        // Redirect to the talentPoolCards.html page
        header("Location: ../index.php");
        exit(); // Make sure to exit after redirecting
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Talent pool ID not provided.";
}
?>
