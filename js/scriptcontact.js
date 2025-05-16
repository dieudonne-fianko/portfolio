document.getElementById('contact-form').addEventListener('submit', function (event) {
    event.preventDefault(); // Empêche le rechargement de la page

    var name = document.getElementById('name').value.trim();
    var email = document.getElementById('email').value.trim();
    var message = document.getElementById('message').value.trim();

    if (name === "" || email === "" || message === "") {
        alert("Tous les champs sont obligatoires !");
        return;
    }

    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        alert("Veuillez entrer une adresse email valide !");
        return;
    }

    // **Envoi du formulaire avec EmailJS**
    emailjs.send("service_eaj9w5d", "template_eq8f9t6", {
        from_name: name,
        from_email: email,
        message: message
    })
        .then(function (response) {
            alert("Message envoyé avec succès !");
        }, function (error) {
            alert("Erreur lors de l’envoi. Vérifie tes identifiants EmailJS !");
        });
});


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


