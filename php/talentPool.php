<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Talent Pool</title>
    <link rel="stylesheet" href="../css/talentPool.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../css/index.css">
</head>
<body>
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
        // Get the last inserted ID
        $last_id = mysqli_insert_id($conn);
        // Close connection
        mysqli_close($conn);

        // Output the message with links
        echo "<div class='success-message'>";
        echo "Where do you want to go?<br>";
        echo "<button class='input-box column' onclick=\"window.location.href='./yourTalentPool.php?talentPoolID=$last_id'\">Your Talent Pool</button><br>";
echo "<button class='input-box column' onclick=\"window.location.href='../index.html'\">Talent Pool Cards</button>";

        echo "</div>";
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
</body>
</html>
