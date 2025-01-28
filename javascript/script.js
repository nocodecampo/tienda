const header = document.querySelector('header');
const section = document.querySelector('section.admin-panel');
const headerHeight = header.offsetHeight;

section.style.paddingTop = `${headerHeight}px`;

const menuLinks = document.querySelectorAll("nav ul li a");
//const hrefLink = menuLinks.getAtribute("href");

menuLinks.forEach((link) => {
   
});