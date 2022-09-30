<?php
if(!isset($_GET['projet'])) {
    header('Location: projets.php');
}
else{
    $projet = $_GET['projet'];
}
require_once 'database/database.php';
// récupération des données du projet
$detailProjet = getProjet($projet);
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=firefox">
    <title>MamelleJambon - Accueil</title>
    <link rel="stylesheet" href="styles/detailProjetStyle.css">
    <link rel="icon" href="images/logo.ico"/>
</head>
<body>
<div>
    <div class="container">
        <div class="header-nav-container">
            <div class="header">
                <a href="index.php"><img src="images/logo.png" alt="logo"/></a>
                <h1>MamelleJambon</h1>
            </div>
            <div class="nav">
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li class="active"><a href="projets.php">Projets</a></li>
                    <li><a href="personnes.php">Personnes</a></li>
                </ul>
            </div>
        </div>
        <!-- détails du projet -->
        <div class="projet">
            <div class="projet-detail">
                <h2><?= $detailProjet[0]['titre'] ?></h2>
                <p>
                    <?= $detailProjet[0]['note'] ?>
                </p>
            </div>
            <!-- liste des personnes du projet -->
            <div class="projet-personnes">
                <h2>Personnes du projet</h2>
                <ul>
                    <?php foreach (getAllParticipants($projet) as $participant) : ?>
                        <li><p><?= $participant['nom'] ?></p></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
