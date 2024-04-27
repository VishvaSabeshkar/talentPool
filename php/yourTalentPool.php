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
    <section class="container">
        <div class="icn">
            <h2>Your Talent Pool</h2>
            <img src="../css/icon.png" alt="Icon">
        </div>
        <div class="talent-pool-info">
            <p id="talentPoolID">
                <?php
                // Include the database connection file
                require_once './connection.php';

                // Check if the talentPoolID is provided via GET request
                if(isset($_GET['talentPoolID'])) {
                    // Sanitize the input to prevent SQL injection
                    $talentPoolID = filter_var($_GET['talentPoolID'], FILTER_SANITIZE_NUMBER_INT);

                    // Prepare and execute a SQL statement to fetch all details based on the talentPoolID
                    $sql = "SELECT * FROM talentPool WHERE talentPoolID = ?";
                    $statement = $conn->prepare($sql);
                    $statement->bind_param("i", $talentPoolID);
                    $statement->execute();
                    $result = $statement->get_result();

                    // Check if a row was returned
                    if ($result->num_rows > 0) {
                        // Fetch the details
                        $row = $result->fetch_assoc();
                        ?>
        <strong>Full Name:</strong> <?php echo $row['fullName'] ?><br>
        <strong>Age:</strong> <?php echo $row['age'] ?><br>
        <strong>Gender:</strong> <?php echo $row['gender'] ?><br>
        <strong>City:</strong> <?php echo $row['city'] ?><br>
        <strong>Email:</strong> <?php echo $row['email'] ?><br>
        <strong>Education Level:</strong> <?php echo $row['eduLevel'] ?><br>
        <strong>Course:</strong> <?php echo $row['course'] ?><br>
        <strong>Skills:</strong> <?php echo $row['skills'] ?><br>
        <strong>Work Experience:</strong> <?php echo $row['workExperience'] ?><br>
        <strong>Salary Expected:</strong> $<?php echo $row['salaryExpected'] ?><br>

        <div>
<!-- Button to update the applicant -->
<div class="button-container">
            <form action='./update_applicant.php' method='get'>
                <input type='hidden' name='talentPoolID' value='<?php echo $talentPoolID ?>'>
                <button class='update-button' type='submit' id='updateButton'>Update</button>
            </form>
        </div>

        <!-- Form to delete the applicant with a confirmation prompt -->
        <div class="button-container">
            <form id='deleteForm' action='./delete_applicant.php' method='get'>
                <input type='hidden' name='talentPoolID' value='<?php echo $talentPoolID ?>'>
                <button class='delete-button' type='button' id='deleteButton'>Delete</button>
            </form>
        </div>
                    </div>
        
        <?php
                        
                    } else {
                        echo "No details found for the provided talent pool ID.";
                    }
                } else {
                    echo "Talent pool ID not provided.";
                }
                ?>
            </p>
        </div>
    </section>

    <script>
        // Add event listener to the delete button
        document.getElementById('deleteButton').addEventListener('click', function() {
            // Display confirmation prompt
            if(confirm('Are you sure you want to delete this applicant?')) {
                // Submit the form if user confirms
                document.getElementById('deleteForm').submit();
            }
        });
    </script>
</body>
</html>
