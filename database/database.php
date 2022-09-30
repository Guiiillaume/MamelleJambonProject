<?php

function DataBaseConnection() {
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "mamellejambonproject";
    $dsn = "mysql:host=$host;dbname=$dbname";
    $pdo = null;
    $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );
    try {
        $pdo = new PDO($dsn, $user, $password, $options);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    return $pdo;
}

// liste des personnes
function getAllPersonnes() {
    $pdo = DataBaseConnection();
    $sql = "SELECT id, nom FROM personne ORDER BY nom";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $personnes = $stmt->fetchAll();
}

// ajouter une personne
function addPersonne($nom) {
    $pdo = DataBaseConnection();
    $sql = "INSERT INTO personne (nom) VALUES (:nom)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->execute();
}

//supprimer une personne
function deletePersonne($id) {
    $pdo = DataBaseConnection();
    $sql = "DELETE FROM personne WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}

//liste des projets
function getAllProjets() {
    $pdo = DataBaseConnection();
    $sql = "SELECT id, titre, note FROM projet ORDER BY titre";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $projets = $stmt->fetchAll();
}

// récupération id max projets
function getIdMaxProjet() {
    $pdo = DataBaseConnection();
    $sql = "SELECT MAX(id) AS id FROM projet";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $idMaxProjet = $stmt->fetch();
}

//ajouter un projet
function addProjet($titre, $note) {
    $pdo = DataBaseConnection();
    $sql = "INSERT INTO projet (titre, note) VALUES (:titre, :note)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':titre', $titre);
    $stmt->bindParam(':note', $note);
    $stmt->execute();
}

//ajout des participants au projet (personne)
function addParticiper($idProjet, $idPersonne) {
    $pdo = DataBaseConnection();
    $sql = "INSERT INTO participer (idProjet, idPersonne) VALUES (:idProjet, :idPersonne)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':idProjet', $idProjet);
    $stmt->bindParam(':idPersonne', $idPersonne);
    $stmt->execute();
}

//supprimer un projet
function deleteProjet($id) {
    //suppression dans la table participer
    $pdo = DataBaseConnection();
    $sql = "DELETE FROM participer WHERE idProjet = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    //suppression du projet
    $pdo = DataBaseConnection();
    $sql = "DELETE FROM projet WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}

// liste des participants au projet
function getAllParticipants($idProjet) {
    $pdo = DataBaseConnection();
    $sql = "SELECT id, nom FROM personne WHERE id IN (SELECT idPersonne FROM participer WHERE idProjet = :idProjet)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':idProjet', $idProjet);
    $stmt->execute();
    return $participants = $stmt->fetchAll();
}

// récupération détails d'un projet
function getProjet($id) {
    $pdo = DataBaseConnection();
    $sql = "SELECT id, titre, note FROM projet WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $detailProjet = $stmt->fetchAll();
}
