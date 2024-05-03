const targetDiv1 = document.getElementById("registration");
const btn1 = document.getElementById("add-user-btn");
const targetDiv2 = document.getElementById("show_user");
const btn2 = document.getElementById("view-user-btn");
btn1.onclick = function () {
  if (targetDiv2.style.display !== "none") {
        targetDiv2.style.display = "none";
      }
  if (targetDiv1.style.display !== "none") {
    targetDiv1.style.display = "none";
  } else {
    targetDiv1.style.display = "block";
  }
};

btn2.onclick = function () {
  if (targetDiv1.style.display !== "none") {
        targetDiv1.style.display = "none";}
  if (targetDiv2.style.display !== "none") {
    targetDiv2.style.display = "none";
  } else {
    targetDiv2.style.display = "block";
  }
};