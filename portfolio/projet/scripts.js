document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");

    form.addEventListener("submit", function (event) {
        event.preventDefault();

        // Récupérer les valeurs des champs
        let date = document.querySelector('input[name="date"]').value;
        let heures = document.querySelector('input[name="heures"]').value;
        let observations = document.querySelector('textarea[name="observations"]').value;

        // Vérification des champs obligatoires
        if (!date || !heures || !observations) {
            alert("Veuillez remplir tous les champs obligatoires !");
            return;
        }

        // Afficher un message de confirmation dynamique
        let confirmationMessage = document.createElement("p");
        confirmationMessage.textContent = "✅ Stage ajouté avec succès !";
        confirmationMessage.style.color = "#4CAF50";
        confirmationMessage.style.fontWeight = "bold";

        document.querySelector(".stage-form").appendChild(confirmationMessage);

        // Soumettre le formulaire après un délai
        setTimeout(() => {
            form.submit();
        }, 1500);
    });
});
