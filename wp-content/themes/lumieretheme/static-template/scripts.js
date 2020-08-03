// added nav toggle event listener
var navToggle = document.getElementById("navToggle");
var navContainer = document.getElementById("navContainer");
navToggle.addEventListener("click", function () {
    if (navContainer.classList.contains("displayBlock")) {
        navContainer.classList.remove("displayBlock");
    } else {
        navContainer.classList.add("displayBlock");
    }
});