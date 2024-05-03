document.getElementById("registration-form").addEventListener("submit", function (event) {
    if (!validateForm()) {
        event.preventDefault();
    }
});
function validateForm() {
    clearErrors();

    var firstName = document.getElementById("first-name").value;
    var lastName = document.getElementById("last-name").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var phone = document.getElementById("phone").value;
    var isValid = true;
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        displayError("email", "Please enter a valid email address.");
        isValid = false;
    }
    var passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=]).{8,20}$/;
    if (!passwordPattern.test(password)) {
        displayError("password", "Password must meet the specified criteria.");
        isValid = false;
    }
    if (firstName === "") {
        displayError("first-name", "First name is required.");
        isValid = false;
    }
    if (lastName === "") {
        displayError("last-name", "Last name is required.");
        isValid = false;
    }
    if (phone !== "" && phone.length !== 10) {
        displayError("phone", "Phone number must be 10 digits.");
        isValid = false;
    }
    return isValid;
}

function displayError(fieldId, errorMessage) {
    var errorDiv = document.getElementById(fieldId + "-error");
    errorDiv.textContent = errorMessage;
    errorDiv.style.display = "block";
}

function clearErrors() {
    var errorDivs = document.querySelectorAll(".invalid-feedback");
    errorDivs.forEach(function (errorDiv) {
        errorDiv.textContent = "";
        errorDiv.style.display = "none";
    });
}
