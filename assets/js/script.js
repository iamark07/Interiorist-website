// Mobile menu toggle
const menuToggle = document.getElementById('menuToggle');
const closeMenu = document.getElementById('closeMenu');
const mobileMenu = document.getElementById('mobileMenu');
const mobileAbout = document.getElementById('mobileAbout');
const aboutDropdown = document.getElementById('aboutDropdown');
const mobileServices = document.getElementById('mobileServices');
const servicesDropdown = document.getElementById('servicesDropdown');

menuToggle.addEventListener('click', () => {
    mobileMenu.classList.remove('-translate-x-full');
});

closeMenu.addEventListener('click', () => {
    mobileMenu.classList.add('-translate-x-full');
});

mobileAbout.addEventListener('click', () => {
    aboutDropdown.classList.toggle('hidden');
    aboutDropdown.classList.toggle('block');
});

mobileServices.addEventListener('click', () => {
    servicesDropdown.classList.toggle('hidden');
    servicesDropdown.classList.toggle('block');
});
