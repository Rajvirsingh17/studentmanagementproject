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

function showhideaddfaculty(){
    var targetdiv=document.getElementById("popupnew-faculty-form");
    targetdiv.style.display = (targetdiv.style.display === "none") ? "block" : "none";
    }
    window.onclick = function (event) {
        let modal = document.getElementById('popupnew-faculty-form');
        if (event.target == modal) {
            modal.style.display = (modal.style.display === "none") ? "block" : "none";;
        }
      }
      
function displayfilter(){
    var targetdiv=document.getElementById("filter-form");
    targetdiv.style.display = (targetdiv.style.display === "none") ? "block" : "none";
    }