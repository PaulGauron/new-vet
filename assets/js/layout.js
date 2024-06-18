
const burgerMenu = document.getElementById('burger-menu');
const nav = document.querySelector('nav');

burgerMenu.addEventListener('click', () => {
    nav.classList.toggle('hidden');
});