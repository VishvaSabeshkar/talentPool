<?php
// Include the database connection file
require_once './connection.php';

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talent Pool Cards</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="../css/talentPoolCards.css"> 
</head>
<body>
    <section class="pool">
        <div class="icn">
            <img src="../css/icon.png" alt="Icon">
            <h1>Talent Pool </h1>
        </div>
        
        <div class="card-container">
            <?php
            // Render cards for each talent pool applicant
            foreach ($data as $applicant) {
                echo '<div class="card">';
                echo '<form class="applicant-form">';
                echo '<h2>' . $applicant['fullName'] . '</h2>';
                echo '<p>Age: ' . $applicant['age'] . '</p>';
                echo '<p>Gender: ' . $applicant['gender'] . '</p>';
                echo '<p>City: ' . $applicant['city'] . '</p>';
                echo '<p>Email: ' . $applicant['email'] . '</p>';
                echo '<p>Education Level: ' . $applicant['eduLevel'] . '</p>';
                echo '<p>Course: ' . $applicant['course'] . '</p>';
                echo '<p>Skills: ' . $applicant['skills'] . '</p>';
                echo '<p>Work Experience: ' . $applicant['workExperience'] . '</p>';
                echo '<p>Salary Expected: ' . $applicant['salaryExpected'] . '</p>';
                echo '</form>';
                echo '</div>';
            }
            ?>
        </div>
        <div class="input-box column">
            <button id="createButton" type="button">Create Yours</button>
        </div>
    </section>

    <script>
        // Add event listener to the button
        const createButton = document.getElementById('createButton');
        createButton.addEventListener('click', () => {
            // Redirect to index.html
            window.location.href = '../index.php';
        });
    </script>
</body>
</html>
