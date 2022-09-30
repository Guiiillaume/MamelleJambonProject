<?php require_once 'database/database.php';

// ajout du projet selon formulaire
if (isset($_POST['addProjet'])) {
    $titre = $_POST['addProjetTitre'];
    $note = $_POST['addProjetNote'];
    addProjet($titre, $note);

    //récupération de l'id max des projets
    $idMaxProjet = getIdMaxProjet();

    // ajout des participants au projet
    foreach ($_POST['addProjetPersonnes'] as $idPersonne) {
        addParticiper($idMaxProjet['id'], $idPersonne);
    }
}

// suppression d'un projet
if (isset($_POST['deleteProjet'])) {
    $id = $_POST['deleteProjetId'];
    deleteProjet($id);
}

?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=firefox">
    <title>MamelleJambon - Accueil</title>
    <link rel="stylesheet" href="styles/projetStyle.css">
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
        <!-- affichage de la liste des projets avec la suppression -->
        <div class="projets">
            <div class="projets-list">
                <h2>Liste des projets</h2>
                <ul>
                    <?php foreach (getAllProjets() as $projet) : ?>                        
                            <li>
                                <p><?= $projet['titre'] ?></p>
                                <p id="subtitle"><?= $projet['note'] ?></p>
                                <!-- affiche des participants -->
                                <ul class="participants">
                                    <?php foreach (getAllParticipants($projet['id']) as $participant) : ?>
                                    <li class="participant"><p><?= $participant['nom'] ?></p></li></a>
                                    <?php endforeach; ?>
                                </ul>
                                <form action="projets.php" method="post">
                                    <input type="hidden" name="deleteProjetId" value="<?= $projet['id'] ?>">
                                    <!-- bouton détails projet -->
                                    <a href="<?php echo "detailProjet.php?projet=". $projet['id'] ?>">  
                                    <input id="detailProjet" type="button" name="detailProjet" value="Détails"></a>
                                    <input id="deleteProjet" type="submit" name="deleteProjet" value="Supprimer">
                                </form>
                            </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <!-- formulaire d'ajout d'un projet -->
            <div class="projets-add">
                <h2>Ajouter un projet</h2>
                <form action="projets.php" method="post">
                    <input required type="text" name="addProjetTitre" maxlength="25" placeholder="Titre du projet">
                    <input type="text" name="addProjetNote" maxlength="50" placeholder="Note">
                    <!-- select d'ajout des personnes -->
                    <select required name="addProjetPersonnes[]" multiple>
                        <?php foreach (getAllPersonnes() as $personne) : ?>
                            <option value="<?= $personne['id'] ?>"><?= $personne['nom'] ?></option>
                        <?php endforeach; ?>
                    <input type="submit" value="Ajouter" name="addProjet">
                </form>
            </div>
        </div>
    </div>
</body>
</html>