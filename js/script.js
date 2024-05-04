

function clearForm() {
    document.getElementById("jobApplicationForm").reset();
}

function validateForm() {
    var fullName = document.getElementById("fullName").value;
    var age = document.getElementById("age").value;
    var gender = document.querySelector('input[name="gender"]:checked');
    var city = document.getElementById("city").value;
    var email = document.getElementById("email").value;
    var eduLevel = document.getElementById("educationlevel").value;
    var skills = document.getElementById("skills").value;
    var workExperience = document.getElementById("workExperience").value;
    var salaryExpected = document.getElementById("salaryExpected").value;

    if (fullName === "" || age === "" || gender === null || city === "" || email === "" || eduLevel === "" || skills === "" || workExperience === "" || salaryExpected === "") {
        alert("All fields are required.");
        return false;
    }

    handleSuccessfulSubmission();

    // Returning true indicates that the form submission should proceed
    return true;
}

function handleSuccessfulSubmission() {
    // Display a success message or perform any other actions
    alert("Form submitted successfully!");
}

