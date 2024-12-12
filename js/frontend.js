// Function to toggle the mobile navbar
function toggleNavbar(menuToggleId, navbarId) {
    const menuToggle = document.getElementById(menuToggleId);
    const navbar = document.getElementById(navbarId);

    menuToggle.addEventListener('click', () => {
        navbar.classList.toggle('active');
    });
}

// Initialize the function after DOM loads
document.addEventListener('DOMContentLoaded', () => {
    toggleNavbar('menu-toggle', 'navbar');
});

// Function to handle mobile service card scrolling
function initServiceCardScroll(serviceCardsId, arrowLeftId, arrowRightId) {
    const serviceCards = document.getElementById(serviceCardsId);
    const arrowLeft = document.getElementById(arrowLeftId);
    const arrowRight = document.getElementById(arrowRightId);

    let cardWidth = serviceCards.firstElementChild.offsetWidth; // Width of a single card
    let currentScrollPosition = 0; // Track the current scroll position

    // Scroll Right Button
    arrowRight.addEventListener("click", () => {
        currentScrollPosition += cardWidth; // Move right
        if (currentScrollPosition > serviceCards.scrollWidth - cardWidth) {
            currentScrollPosition = serviceCards.scrollWidth - cardWidth; // Prevent overflow
        }
        serviceCards.scrollTo({ left: currentScrollPosition, behavior: "smooth" });
    });

    // Scroll Left Button
    arrowLeft.addEventListener("click", () => {
        currentScrollPosition -= cardWidth; // Move left
        if (currentScrollPosition < 0) {
            currentScrollPosition = 0; // Prevent going past first block
        }
        serviceCards.scrollTo({ left: currentScrollPosition, behavior: "smooth" });
    });

    // Ensure the first block displays properly on load
    document.addEventListener("DOMContentLoaded", () => {
        serviceCards.scrollTo({ left: 0 });
    });
}

// Initialize the function after DOM content is loaded
document.addEventListener("DOMContentLoaded", () => {
    initServiceCardScroll("service-cards", "arrow-left", "arrow-right");
});

// Function to initialize gallery navigation and auto-scroll
function initGalleryScroll(gallerySelector, leftButtonSelector, rightButtonSelector, interval = 5000) {
    const gallery = document.querySelector(gallerySelector);
    const leftButton = document.querySelector(leftButtonSelector);
    const rightButton = document.querySelector(rightButtonSelector);
    const scrollAmount = gallery.offsetWidth * 0.8; // 80% of container width
    let autoScroll;

    // Function to scroll the gallery
    const scrollGallery = (direction) => {
        gallery.scrollBy({
            left: direction * scrollAmount,
            behavior: "smooth",
        });
    };

    // Automatic scrolling function
    const startAutoScroll = () => {
        autoScroll = setInterval(() => {
            if (gallery.scrollLeft + gallery.offsetWidth >= gallery.scrollWidth) {
                gallery.scrollTo({ left: 0, behavior: "smooth" }); // Reset to start
            } else {
                gallery.scrollBy({ left: scrollAmount, behavior: "smooth" });
            }
        }, interval);
    };

    // Stop automatic scrolling
    const stopAutoScroll = () => clearInterval(autoScroll);

    // Event Listeners
    leftButton.addEventListener("click", () => {
        scrollGallery(-1);
        stopAutoScroll();
        startAutoScroll();
    });

    rightButton.addEventListener("click", () => {
        scrollGallery(1);
        stopAutoScroll();
        startAutoScroll();
    });

    // Start automatic scrolling when the page loads
    startAutoScroll();
}

// Function to initialize navigation menu toggle for mobile
function initMenuToggle(menuToggleSelector, navbarSelector) {
    const menuToggle = document.querySelector(menuToggleSelector);
    const navbar = document.querySelector(navbarSelector);

    menuToggle.addEventListener("click", () => {
        navbar.classList.toggle("active");
    });
}

// Initialize all functionalities on page load
document.addEventListener("DOMContentLoaded", () => {
    // Initialize the gallery
    initGalleryScroll(".image-grid", ".button-left", ".button-right", 5000);

    // Initialize the navigation menu
    initMenuToggle("#menu-toggle", "#navbar");
});

