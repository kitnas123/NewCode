let menu = document.querySelector('#menu-btn');
let navbar = document.querySelector('.header .navbar');

window.onscroll = () => {
    menu.classList.remove('fa-times');
    navbar.classList.remove('active');
}