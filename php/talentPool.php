<?php
// Include the database connection file
require_once 'connection.php';

// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $applicantID = mysqli_real_escape_string($conn, $_POST['applicantID']);
    $fullName = mysqli_real_escape_string($conn, $_POST['fullName']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $eduLevel = mysqli_real_escape_string($conn, $_POST['educationlevel']);
    $degreeObtained = mysqli_real_escape_string($conn, $_POST['DegreeObtained']);
    $skills = mysqli_real_escape_string($conn, $_POST['skills']);
    $workExperience = mysqli_real_escape_string($conn, $_POST['workExperience']);
    $salaryExpected = mysqli_real_escape_string($conn, $_POST['salaryExpected']);

    // Attempt to insert data into database
    $sql = "INSERT INTO talentPool (applicantID, fullName, age, gender, city, email, eduLevel, course, skills, workExperience, salaryExpected)
            VALUES ('$applicantID', '$fullName', '$age', '$gender', '$city', '$email', '$eduLevel', '$degreeObtained', '$skills', '$workExperience', '$salaryExpected')";

    if (mysqli_query($conn, $sql)) {
        echo "Records added successfully.";
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }
}

// Close connection
mysqli_close($conn);
?>
