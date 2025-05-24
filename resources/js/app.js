import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

// Dashboard.js - Interactive functions for the admin dashboard
document.addEventListener("DOMContentLoaded", function () {
    const userMenuBtn = document.getElementById("userMenuBtn");
    const userMenu = document.getElementById("userMenu");

    if (userMenuBtn && userMenu) {
        userMenuBtn.addEventListener("click", (e) => {
            e.stopPropagation();
            userMenu.classList.toggle("hidden");
        });

        document.addEventListener("click", (event) => {
            if (
                !userMenuBtn.contains(event.target) &&
                !userMenu.contains(event.target)
            ) {
                userMenu.classList.add("hidden");
            }
        });
    }
});
