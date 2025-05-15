<?php
session_start();
$conn = new mysqli("localhost", "root", "", "journal_etudiant");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $mot_de_passe = $_POST["mot_de_passe"];

    $sql = "SELECT * FROM utilisateurs WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $utilisateur = $result->fetch_assoc();
        if (password_verify($mot_de_passe, $utilisateur["mot_de_passe"])) {
            $_SESSION["utilisateur_id"] = $utilisateur["id"];
            header("Location: dashboard.php");
            exit;
        } else {
            echo "<p class='error'>Mot de passe incorrect.</p>";
        }
    } else {
        echo "<p class='error'>Email non trouvé.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form-container">
        <h2>Connexion</h2>
        <form method="post">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>
        <p>Pas encore inscrit ? <a href="register.php">Créer un compte</a></p>
    </div>
</body>
</html>
