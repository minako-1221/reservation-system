document.addEventListener('DOMContentLoaded', () => {
    const menuToggle = document.getElementById('menu-toggle');
    const modal = document.getElementById('modal');

    menuToggle.addEventListener('click', () => {
        menuToggle.classList.toggle('active');
        modal.classList.toggle('active');
    });
});