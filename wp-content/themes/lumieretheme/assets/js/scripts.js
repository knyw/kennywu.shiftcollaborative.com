// check if 404 redirect div exist
var element = document.getElementById("lumiere_404_redirect");
if (typeof (element) != "undefined" && element != null) {
    setTimeout(function () {
        window.location.replace("/");
    }, 5000);
}