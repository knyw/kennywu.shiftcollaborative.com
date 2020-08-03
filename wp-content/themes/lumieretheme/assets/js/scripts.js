// check if 404 redirect div exist
var element = document.getElementById("lumiere_404_redirect");
if (typeof (element) != "undefined" && element != null) {
    setTimeout(function () {
        window.location.replace("/");
    }, 5000);
}

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