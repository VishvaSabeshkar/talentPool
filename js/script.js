// Fetch data from backend (PHP script)
fetch('php/fetch_talent_pool_data.php') 
    .then(response => response.json())
    .then(data => {
        // Render cards for each talent pool applicant
        const cardContainer = document.querySelector('.card-container');
        data.forEach(applicant => {
            const card = document.createElement('div');
            card.classList.add('card');

            // Create a form within each card to display applicant's details
            card.innerHTML = `
                <form class="applicant-form">
                    <h2>${applicant.fullName}</h2>
                    <p>Age: ${applicant.age}</p>
                    <p>Gender: ${applicant.gender}</p>
                    <p>City: ${applicant.city}</p>
                    <p>Email: ${applicant.email}</p>
                    <p>Education Level: ${applicant.eduLevel}</p>
                    <p>Course: ${applicant.course}</p>
                    <p>Skills: ${applicant.skills}</p>
                    <p>Work Experience: ${applicant.workExperience}</p>
                    <p>Salary Expected: ${applicant.salaryExpected}</p>
                    <!-- Add more details as needed -->
                </form>
            `;
            cardContainer.appendChild(card);
        });
    })
    .catch(error => console.error('Error fetching data:', error));

// Add event listener to the button
const createButton = document.getElementById('createButton');
createButton.addEventListener('click', () => {
    // Redirect to index.html
    window.location.href = './talentPoolApplication.html';
});



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

