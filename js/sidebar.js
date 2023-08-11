document.addEventListener("DOMContentLoaded", function() {
    var links = document.querySelectorAll(".list-item a");
    var currentURL = window.location.href;

    links.forEach(function(link) {
        if (link.href === currentURL) {
            link.parentElement.classList.add("active");
        }
    });
});