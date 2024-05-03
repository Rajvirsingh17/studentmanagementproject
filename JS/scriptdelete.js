const closePopupButton = document.getElementById("popup-close");
const redirectButton = document.getElementById("ok");
const myPopup = document.getElementById("popup-delete");


closePopupButton.addEventListener("click", function() {
    window.location.href = "viewuser.php";
});

redirectButton.addEventListener("click", function() {
    window.location.href = "viewuser.php";
});
