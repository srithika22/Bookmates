// Navbar scroll effect
const navbar = document.querySelector('.navbar');
let lastScrollY = window.scrollY;

function updateNavbar() {
    if (window.scrollY > 20) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }

    lastScrollY = window.scrollY;
}

window.addEventListener('scroll', updateNavbar);
updateNavbar(); // Initial check

// Mobile menu functionality
const mobileMenuButton = document.querySelector('.mobile-menu-button');
const mobileNav = document.querySelector('.desktop-nav');

if (mobileMenuButton) {
    mobileMenuButton.addEventListener('click', () => {
        mobileNav.classList.toggle('active');
        mobileMenuButton.classList.toggle('active');
    });
} 