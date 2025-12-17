const hamburger = document.getElementById('hamburger');
const navLinks = document.getElementById('navLinks');

hamburger.addEventListener('click', () => {
  navLinks.classList.toggle('active');
});

document.addEventListener('DOMContentLoaded', function() {
  const navbar = document.querySelector('.navbar');
  function onScroll() {
    if (window.scrollY > 50) navbar.classList.add('nav-scrolled');
    else navbar.classList.remove('nav-scrolled');
  }
  window.addEventListener('scroll', onScroll);
  onScroll(); // inisialisasi
});