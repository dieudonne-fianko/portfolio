<?php
session_start();
$conn = new mysqli("localhost", "root", "", "journal_etudiant");

if (!isset($_SESSION["utilisateur_id"])) {
    header("Location: login.php");
    exit;
}

$id_utilisateur = $_SESSION["utilisateur_id"];

// Ajout d'un nouveau stage
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST["date"];
    $heures = $_POST["heures"];
    $observations = $_POST["observations"];
    $commentaires = $_POST["commentaires"];

    $stmt = $conn->prepare("INSERT INTO stages (utilisateur_id, date, heures_travail, observations, commentaires) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $id_utilisateur, $date, $heures, $observations, $commentaires);

    if ($stmt->execute()) {
        header("Location: dashboard.php"); // Recharge la page automatiquement
        exit;
    } else {
        echo "<p class='error'>Erreur lors de l'ajout du stage.</p>";
    }

    $stmt->close();
}

// Récupération des stages
$result = $conn->query("SELECT * FROM stages WHERE utilisateur_id = '$id_utilisateur' ORDER BY date DESC");

// Calcul de la progression
$total_heures = $conn->query("SELECT SUM(heures_travail) AS total FROM stages WHERE utilisateur_id = '$id_utilisateur'")->fetch_assoc()["total"] ?? 0;
$objectif_heures = 40; // Objectif du stage
$progress = min(($total_heures / $objectif_heures) * 100, 100); // Empêcher une progression au-dessus de 100%
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de Bord - Journal de Bord Étudiant</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="dashboard-container">
    <h1>Bienvenue dans votre Journal de Bord</h1>
    
    <h3>Progression du Stage</h3>
    <div class="progress-container">
        <div class="progress-bar" style="width: <?= $progress; ?>%;"><?= round($progress); ?>%</div>
    </div>

    <h2>Ajout d'un Nouveau Stage</h2>
    <form method="post" class="stage-form">
        <input type="date" name="date" required placeholder="Date du stage">
        <input type="number" name="heures" required placeholder="Heures de travail">
        <textarea name="observations" placeholder="Observations" required></textarea>
        <textarea name="commentaires" placeholder="Commentaires"></textarea>
        <button type="submit">Ajouter</button>
    </form>

    <h2>Entrées du Journal</h2>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Observations</th>
                    <th>Heures de travail</th>
                    <th>Commentaires</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row["date"]; ?></td>
                    <td><?= htmlspecialchars($row["observations"]); ?></td>
                    <td><?= $row["heures_travail"]; ?>h</td>
                    <td><?= htmlspecialchars($row["commentaires"]); ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <a href="logout.php" class="logout-btn">Se déconnecter</a>
</div>

</body>
</html>
