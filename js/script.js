
// Transformer le menu en icône hamburger sur mobile
const menuHamburger = document.querySelector(".menu-humburger")
const navLinks = document.querySelector("#menu")
const menuItems = document.querySelectorAll("#menu ul li a");
menuHamburger.addEventListener('click', () => {
    navLinks.classList.toggle('mobile-menu');
});
menuItems.forEach(item => {
    item.addEventListener("click", () => {
        navLinks.classList.remove("mobile-menu");
    });
});


// Boutton de retour en haut de page
const scrollTopBtn = document.querySelector(".scroll-top");

window.addEventListener("scroll", () => {
    if (window.scrollY > 300) { // Quand l'utilisateur descend de 300px
        scrollTopBtn.classList.add("show");
    } else {
        scrollTopBtn.classList.remove("show");
    }
});

scrollTopBtn.addEventListener("click", (event) => {
    event.preventDefault();
    window.scrollTo({ top: 0, behavior: "smooth" }); // Remonte en douceur
});


