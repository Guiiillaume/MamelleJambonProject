<?php require_once 'database/database.php';

// ajout de la personne selon formulaire
if (isset($_POST['addPersonne'])) {
    $nom = $_POST['addPersonne'];
    addPersonne($nom);
}
// suppression d'une personne
if (isset($_POST['deletePersonne'])) {
    $id = $_POST['idPersonne'];
    deletePersonne($id);
}
?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=firefox">
    <title>MamelleJambon - Accueil</title>
    <link rel="stylesheet" href="styles/personneStyle.css">
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
                    <li><a href="projets.php">Projets</a></li>
                    <li class="active"><a href="personnes.php">Personnes</a></li>
                </ul>
            </div>
        </div>
        <!-- affichage de la liste des personnes avec la suppression -->
        <div class="personnes">
            <div class="personnes-list">
                <h2>Liste des personnes</h2>
                <ul>
                    <?php foreach (getAllPersonnes() as $personne) : ?>
                        <li><p><?= $personne['nom'] ?></p>
                            <form action="personnes.php" method="post">
                                <input type="hidden" name="idPersonne" value="<?= $personne['id'] ?>">
                                <input id="deletePersonne" type="submit" name="deletePersonne" value="Supprimer">
                            </form>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <!-- formulaire d'ajout d'une personne -->
            <div class="personnes-add">
                <h2>Ajouter une personne</h2>
                <form action="personnes.php" method="post">
                    <input required type="text" name="addPersonne" placeholder="Nom de la personne">
                    <input type="submit" value="Ajouter">
                </form>
            </div>
        </div>
    </div>
</body>
</html>