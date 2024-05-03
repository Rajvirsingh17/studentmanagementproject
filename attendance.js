

  var targetdiv1=document.getElementById("attendance-form");
  var btnc=document.getElementById("submit1");
  btnc.addEventListener("click", function() {
    targetdiv1.style.display = (targetdiv1.style.display === "none") ? "block" : "none";
});
  


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