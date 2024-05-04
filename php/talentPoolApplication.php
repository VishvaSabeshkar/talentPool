<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Talent Pool</title>
    <link rel="stylesheet" href="../css/talentPool.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../css/index.css">
    <style>
        /* Styling for the modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }

        /* Modal content */
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            text-align: center;
        }

        /* Close button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
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

        // Age and salary limitations
        if ($age < 18 || $age > 70 || $salaryExpected < 15000) {
            echo "<div id='myModal' class='modal'>
                    <div class='modal-content'>
                        <span class='close' onclick='closeModal()'>&times;</span>
                        <p>Age must be between 18 and 70, and salary must be $15000 or more.</p>
                    </div>
                </div>";

            echo "<script>
                    // Display the modal
                    document.getElementById('myModal').style.display = 'block';

                    // Close the modal when the user clicks outside of it
                    window.onclick = function(event) {
                        if (event.target == document.getElementById('myModal')) {
                            closeModal();
                        }
                    };

                    // Function to close the modal
                    function closeModal() {
                        document.getElementById('myModal').style.display = 'none';
                    }
                </script>";
        } else {
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
                echo "<button class='input-box column' onclick=\"window.location.href='../index.php'\">Talent Pool Cards</button>";
                echo "</div>";
                exit();
            } else {
                // Output the error message
                echo "<div class='error-message'>";
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                echo "</div>";
            }
        }
    }

    // Close connection
    mysqli_close($conn);
    ?>
    <section class="container">
        <div class="icn">
            <h2> Application Form</h2>
            <img src="../css/icon.png" alt="Icon">
        </div>
        
        <form class="form" id="jobApplicationForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="input-box">
                <label for="applicantID">Applicant ID:</label>
                <div class="input-box">
                    <input type="text" id="applicantID" name="applicantID" required>
                </div>
            </div>

            <div class="input-box">
                <label for="fullName">Full Name:</label>
                <div class="input-box">
                    <input type="text" id="fullName" name="fullName" required>
                </div>
            </div>

            <div class="input-box">
                <label for="age">Age:</label>
                <div class="input-box">
                    <input type="number" id="age" name="age" required>
                </div>
            </div>

            <div class="gender-box">
                <h3>Gender</h3>
                <div class="gender-option">
                    <div class="gender">
                        <input type="radio" id="male" value='Male' name="gender">
                        <label for="male">Male</label>
                    </div>
                    <div class="gender">
                        <input type="radio" id="female" value='Female' name="gender">
                        <label for="female">Female</label>
                    </div>
                    <div class="gender">
                        <input type="radio" id="other" value='Other' name="gender">
                        <label for="other">Other</label>
                    </div>
                </div>
            </div>

            <div class="input-box">
                <label for="city">City:</label>
                <div class="input-box">
                    <input type="text" id="city" name="city" required>
                </div>
            </div>

            <div class="input-box">
                <label for="email">Email:</label>
                <div class="input-box">
                    <input type="email" id="email" name="email" required>
                </div>
            </div>

            <div class="input-box ">
                <label for="educationlevel">Highest Level of Education</label>

                <div class="column">
                    <select id="educationlevel" name="educationlevel" required>
                        <option value="high-school">High School</option>
                        <option value="associate-degree">Associate Degree</option>
                        <option value="bachelors-degree">Bachelor's Degree</option>
                        <option value="masters-degree">Master's Degree</option>
                        <option value="phd">PhD</option> 
                    </select>
                    <div class="input-box">
                        <input type="text" id="DegreeObtained" name="DegreeObtained" placeholder="Enter Degree Obtained">
                    </div>
                </div>
                
            </div>

            <div class="input-box">
                <label for="skills">Skills:</label>
                <div class="input-box">
                    <textarea id="skills" name="skills" rows="4" cols="50" required></textarea>
                </div>
            </div>
            
            <div class="input-box">
                <label for="workExperience">Work Experience:</label>
                <div class="input-box">
                    <textarea id="workExperience" name="workExperience" rows="4" cols="50" required></textarea>
                </div>
            </div>
            

            <div class="input-box">
                <label for="salaryExpected">Salary Expected:</label>
                <div class="input-box">
                    <input type="number" id="salaryExpected" name="salaryExpected" required>
                </div>
            </div>

            <div class="input-box row">
                <button type="submit">Submit</button>
                <button type="button" onclick="clearForm()">Clear</button>
            </div>
            </form>
    </section>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <p>Age must be between 18 and 70, and salary must be $15000 or more.</p>
        </div>
    </div>

    <script>
        function closeModal() {
            document.getElementById('myModal').style.display = 'none';
        }
    </script>
</body>
</html>