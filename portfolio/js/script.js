document.getElementById('contact-form').addEventListener('submit', function(event) {
    // Empêcher l'envoi par défaut
    event.preventDefault();

    // Récupérer les valeurs des champs
    var name = document.getElementById('name').value.trim();
    var email = document.getElementById('email').value.trim();
    var message = document.getElementById('message').value.trim();

    // Vérifier si les champs sont remplis
    if (name === "" || email === "" || message === "") {
        alert("Tous les champs sont obligatoires !");
        return;
    }

    // Vérifier le format de l'email
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        alert("Veuillez entrer une adresse email valide !");
        return;
    }

    // Si tout est valide, afficher un message de confirmation
    alert("Formulaire envoyé avec succès !");
});
