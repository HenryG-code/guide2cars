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
