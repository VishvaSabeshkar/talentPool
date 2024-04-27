<?php
// Include the database connection file
require_once 'connection.php';

// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize an empty array to store fetched data
$data = [];

// Attempt to fetch data from the talentPool table
$sql = "SELECT * FROM talentPool";
$result = mysqli_query($conn, $sql);

// Check if any rows were returned
if (mysqli_num_rows($result) > 0) {
    // Fetch each row as an associative array
    while ($row = mysqli_fetch_assoc($result)) {
        // Add each row to the $data array
        $data[] = $row;
    }
}

// Close the database connection
mysqli_close($conn);

// Set the response content type to JSON
header('Content-Type: application/json');

// Output the $data array as JSON
echo json_encode($data);
?>
