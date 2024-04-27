<?php
// Include the database connection file
require_once 'connection.php';

// Check if the talentPoolID is provided via GET request
if(isset($_GET['talentPoolID'])) {
    // Sanitize the input to prevent SQL injection
    $talentPoolID = filter_var($_GET['talentPoolID'], FILTER_SANITIZE_NUMBER_INT);

    try {
        // Prepare and execute a SQL statement to fetch the applicant's name based on the talentPoolID
        $statement = $pdo->prepare("SELECT fullName FROM talentPool WHERE talentPoolID = :talentPoolID");
        $statement->execute(array(':talentPoolID' => $talentPoolID));
        
        // Fetch the applicant's name
        $applicantName = $statement->fetch(PDO::FETCH_ASSOC);
        
        // Check if a row was returned
        if($applicantName) {
            // Return the applicant's name as JSON response
            echo json_encode(array('success' => true, 'fullName' => $applicantName['fullName']));
            exit();
        } else {
            // If no row was found, return an error message
            echo json_encode(array('success' => false, 'message' => 'No applicant found for the provided talentPoolID.'));
            exit();
        }
    } catch (PDOException $e) {
        // Handle database errors
        echo json_encode(array('success' => false, 'message' => 'Database error: ' . $e->getMessage()));
        exit();
    }
} else {
    // If talentPoolID is not provided, return an error message
    echo json_encode(array('success' => false, 'message' => 'Talent pool ID not provided.'));
    exit();
}
?>
