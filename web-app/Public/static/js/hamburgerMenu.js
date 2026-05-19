const mobileMenuButton = document.getElementById('mobile-menu-button');
const sidebar = document.getElementById('sidebar');
mobileMenuButton.addEventListener('click', () => {
    sidebar.classList.toggle('-translate-x-full');
});