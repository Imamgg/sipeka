import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

// Dashboard.js - Interactive functions for the admin dashboard

document.addEventListener("DOMContentLoaded", function () {
    // Sidebar toggle functionality
    const sidebarToggle = document.getElementById("sidebarToggle");
    const sidebarToggleDesktop = document.getElementById(
        "sidebarToggleDesktop"
    );
    const sidebar = document.getElementById("sidebar");
    const mainContent = document.querySelector(".flex-1");

    function toggleSidebar() {
        sidebar.classList.toggle("-translate-x-full");

        // Toggle margin of main content on desktop
        if (window.innerWidth >= 768) {
            if (mainContent.classList.contains("md:ml-64")) {
                mainContent.classList.remove("md:ml-64");
                mainContent.classList.add("md:ml-0");
            } else {
                mainContent.classList.remove("md:ml-0");
                mainContent.classList.add("md:ml-64");
            }
        }
    }

    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener("click", toggleSidebar);
    }

    if (sidebarToggleDesktop && sidebar) {
        sidebarToggleDesktop.addEventListener("click", toggleSidebar);
    }

    // Close sidebar when clicking outside on mobile
    document.addEventListener("click", (event) => {
        const isMobile = window.innerWidth < 768;
        if (
            isMobile &&
            !sidebar.contains(event.target) &&
            !sidebarToggle.contains(event.target) &&
            !sidebar.classList.contains("-translate-x-full")
        ) {
            sidebar.classList.add("-translate-x-full");
        }
    });

    // User menu dropdown toggle
    const userMenuBtn = document.getElementById("userMenuBtn");
    const userMenu = document.getElementById("userMenu");

    if (userMenuBtn && userMenu) {
        userMenuBtn.addEventListener("click", (e) => {
            e.stopPropagation();
            userMenu.classList.toggle("hidden");
        });

        // Close the dropdown when clicking outside
        document.addEventListener("click", (event) => {
            if (
                !userMenuBtn.contains(event.target) &&
                !userMenu.contains(event.target)
            ) {
                userMenu.classList.add("hidden");
            }
        });
    }

    // Add animation to dashboard cards
    const statCards = document.querySelectorAll(".grid > div[data-category]");
    if (statCards.length) {
        statCards.forEach((card, index) => {
            // Add staggered fade-in animation
            card.classList.add("transition-fade");
            card.style.animationDelay = `${index * 0.1}s`;

            // Make cards clickable
            card.addEventListener("click", () => {
                const category = card.getAttribute("data-category");
                console.log(`Navigating to ${category} section`);
                // You can add navigation or other actions here
            });
        });
    }

    // Responsive handling
    function handleResize() {
        const isMobile = window.innerWidth < 768;
        if (!isMobile && sidebar) {
            // Reset any mobile-specific states when returning to desktop
            sidebar.classList.remove("-translate-x-full");
        } else if (isMobile) {
            // Hide sidebar by default on mobile
            sidebar.classList.add("-translate-x-full");
        }
    }

    window.addEventListener("resize", handleResize);
    handleResize(); // Initial call

    // Dark mode toggle
    const darkModeBtn = document.querySelector(
        'button[data-tooltip="Mode Gelap"]'
    );
    if (darkModeBtn) {
        darkModeBtn.addEventListener("click", () => {
            document.documentElement.classList.toggle("dark-mode");
            // You can add your dark mode implementation here
            console.log("Dark mode toggled");
        });
    }

    // Add tooltips functionality
    const tooltips = document.querySelectorAll(".tooltip");
    tooltips.forEach((tooltip) => {
        tooltip.setAttribute("role", "button");
        tooltip.setAttribute(
            "aria-label",
            tooltip.getAttribute("data-tooltip")
        );
    });
});
