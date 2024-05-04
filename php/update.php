<?php
// Include the database connection file
require_once './connection.php';

// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $talentPoolID = mysqli_real_escape_string($conn, $_POST['talentPoolID']);
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

    // Attempt to update data in the database
    $sql = "UPDATE talentPool SET applicantID='$applicantID', fullName='$fullName', age='$age', gender='$gender', city='$city', email='$email', eduLevel='$eduLevel', course='$degreeObtained', skills='$skills', workExperience='$workExperience', salaryExpected='$salaryExpected' WHERE talentPoolID='$talentPoolID'";

    if (mysqli_query($conn, $sql)) {
        // Close connection
        mysqli_close($conn);

        // Redirect to the talent pool page with the updated talent pool ID
        header("Location: ./yourTalentPool.php?talentPoolID=$talentPoolID");
        exit();
    } else {
        // Output the error message
        echo "<div class='error-message'>";
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
        echo "</div>";
    }
}

// Close connection
mysqli_close($conn);
?>
