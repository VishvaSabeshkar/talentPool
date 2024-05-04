<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talent Application Form</title>
    <link rel="stylesheet" href="../css/talentPool.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <section class="container">
        <div class="icn">
            <h2> Application Form</h2>
            <img src="../css/icon.png" alt="Icon">
        </div>
        
        <form class="form" id="jobApplicationForm" method="post" action="./update.php" onsubmit="return validateForm()">
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

                    // Display existing data in input fields
                    echo "<input type='hidden' name='talentPoolID' value='" . $talentPoolID . "'>";

                    echo "<div class='input-box'>";
                    echo "<label for='applicantID'>Applicant ID:</label>";
                    echo "<div class='input-box'>";
                    echo "<input type='text' id='applicantID' name='applicantID' value='" . $row['applicantID'] . "' required>";
                    echo "</div>";
                    echo "</div>";

                    echo "<div class='input-box'>";
                    echo "<label for='fullName'>Full Name:</label>";
                    echo "<div class='input-box'>";
                    echo "<input type='text' id='fullName' name='fullName' value='" . $row['fullName'] . "' required>";
                    echo "</div>";
                    echo "</div>";

                    echo "<div class='input-box'>";
                    echo "<label for='age'>Age:</label>";
                    echo "<div class='input-box'>";
                    echo "<input type='number' id='age' name='age' value='" . $row['age'] . "' required>";
                    echo "</div>";
                    echo "</div>";

                    echo "<div class='gender-box'>";
                    echo "<h3>Gender</h3>";
                    echo "<div class='gender-option'>";
                    echo "<div class='gender'>";
                    echo "<input type='radio' id='male' value='Male' name='gender' " . ($row['gender'] == 'Male' ? 'checked' : '') . ">";
                    echo "<label for='male'>Male</label>";
                    echo "</div>";
                    echo "<div class='gender'>";
                    echo "<input type='radio' id='female' value='Female' name='gender' " . ($row['gender'] == 'Female' ? 'checked' : '') . ">";
                    echo "<label for='female'>Female</label>";
                    echo "</div>";
                    echo "<div class='gender'>";
                    echo "<input type='radio' id='other' value='Other' name='gender' " . ($row['gender'] == 'Other' ? 'checked' : '') . ">";
                    echo "<label for='other'>Other</label>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";

                    echo "<div class='input-box'>";
                    echo "<label for='city'>City:</label>";
                    echo "<div class='input-box'>";
                    echo "<input type='text' id='city' name='city' value='" . $row['city'] . "' required>";
                    echo "</div>";
                    echo "</div>";

                    echo "<div class='input-box'>";
                    echo "<label for='email'>Email:</label>";
                    echo "<div class='input-box'>";
                    echo "<input type='email' id='email' name='email' value='" . $row['email'] . "' required>";
                    echo "</div>";
                    echo "</div>";

                    echo "<div class='input-box'>";
                    echo "<label for='educationlevel'>Highest Level of Education</label>";
                    echo "<div class='column'>";
                    echo "<select id='educationlevel' name='educationlevel' required>";
                    $education_levels = array("High School", "Associate Degree", "Bachelor's Degree", "Master's Degree", "PhD");
                    foreach($education_levels as $level) {
                        echo "<option value='" . strtolower(str_replace("'", "", $level)) . "' " . ($row['eduLevel'] == strtolower(str_replace("'", "", $level)) ? 'selected' : '') . ">" . $level . "</option>";
                    }
                    echo "</select>";
                    echo "<div class='input-box'>";
                    echo "<input type='text' id='DegreeObtained' name='DegreeObtained' placeholder='Enter Degree Obtained' value='" . $row['course'] . "'>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";

                    echo "<div class='input-box'>";
                    echo "<label for='skills'>Skills:</label>";
                    echo "<div class='input-box'>";
                    echo "<textarea id='skills' name='skills' rows='4' cols='50' required>" . $row['skills'] . "</textarea>";
                    echo "</div>";
                    echo "</div>";

                    echo "<div class='input-box'>";
                    echo "<label for='workExperience'>Work Experience:</label>";
                    echo "<div class='input-box'>";
                    echo "<textarea id='workExperience' name='workExperience' rows='4' cols='50' required>" . $row['workExperience'] . "</textarea>";
                    echo "</div>";
                    echo "</div>";

                    echo "<div class='input-box'>";
                    echo "<label for='salaryExpected'>Salary Expected:</label>";
                    echo "<div class='input-box'>";
                    echo "<input type='number' id='salaryExpected' name='salaryExpected' value='" . $row['salaryExpected'] . "' required>";
                    echo "</div>";
                    echo "</div>";
                } else {
                    echo "No details found for the provided talent pool ID.";
                }
            } else {
                echo "Talent pool ID not provided.";
            }
            ?>

            <div class="input-box row">
                <button type="submit">Submit</button>
                <button type="button" onclick="clearForm()">Clear</button>
            </div>
        </form>
    </section>

    <script src="../js/script.js"></script>

</body>
</html>
