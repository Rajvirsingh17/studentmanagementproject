function hideMessages() {
    var successMessage = document.getElementById("success-message");
    var errorMessage = document.getElementById("error-message");

    if (successMessage) {
        setTimeout(function() {
            successMessage.style.display = "none";
        }, 5000); // 5000 milliseconds (5 seconds)
    }

    if (errorMessage) {
        setTimeout(function() {
            errorMessage.style.display = "none";
        }, 5000); // 5000 milliseconds (5 seconds)
    }
}

// Call the function to hide messages when the page loads
window.onload = hideMessages;


var form = document.getElementById("addstudent-form");

form.addEventListener("submit", function(event) {
if (!validateForm()) {
    event.preventDefault();
}
});
function validateForm() {
    clearErrors();
    var email = document.getElementById("email").value;
    var phone = document.getElementById("phone").value;
    var isValid = true;
    var grade12=document.getElementById("grade12").value;
    var grade10=document.getElementById("grade10").value;

    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        displayError("email", "Please enter a valid email address.");
        isValid = false;
    }
    if (phone !== "" && phone.length !== 10) {
        displayError("phone", "Phone number must be 10 digits.");
        isValid = false;
    }
    var grade10p = parseInt(grade10);
    if (grade10p < 0 || grade10p > 100){
      displayError("grade10","Value should be between 0 - 100");
      isValid=false;}
    var grade12p = parseInt(grade12);
    if (grade12p < 0 || grade12p > 100){
    displayError("grade12","Value should be between 0 - 100");
    isValid=false;}
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