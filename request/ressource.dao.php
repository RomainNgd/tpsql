<?php
require'config/db.php';

function getRessources(): bool|array
{
    $dbh = getConnexion();
    $req = "SELECT * FROM ressources";
    return $dbh->query($req)->fetchAll();
}

function getTypes(): bool|array
{
    $dbh = getConnexion();
    $req = "SELECT * FROM types";
    return $dbh->query($req)->fetchAll();
}
function getRessourceType($idType){
    $dbh = getConnexion();
    $req2 = "SELECT libelle FROM types WHERE idType = :idType";
    $stmt = $dbh->prepare($req2);
    // On bind la value en paramètre pour sécuriser la requête
    $stmt->bindValue(":idType", $idType, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch();
}

function addRessource($titre, $lien, $description, $idType): bool
{
    $dbh=getConnexion();
    $req='INSERT INTO ressources (titre, lien, description,idType) VALUES(:titre, :lien, :description, :idType)';
    $stmt = $dbh->prepare($req);
    $stmt->bindValue(":titre", $titre, PDO::PARAM_STR);
    $stmt->bindValue(":lien", $lien, PDO::PARAM_STR);
    $stmt->bindValue(":description", $description, PDO::PARAM_INT);
    $stmt->bindValue(":idType", $idType, PDO::PARAM_STR);
    return $stmt->execute();
}

function getRessourceNameToDelete($idRessource){
    $dbh = getConnexion();
    $req = 'SELECT CONCAT(idRessource, " : ",titre) AS maRessource FROM ressources WHERE idRessource = :idRessource';
    $stmt = $dbh->prepare($req);
    $stmt->bindValue(":idRessource", $idRessource, PDO::PARAM_INT);
    $stmt->execute();
    $res = $stmt->fetch();
    return $res['maRessource'];
}

function deleteRessource($idRessource): bool
{
    $dbh = getConnexion();
    $req = 'DELETE FROM ressources WHERE idRessource = :idRessource';
    $stmt = $dbh->prepare($req);
    $stmt->bindValue(":idRessource", $idRessource, PDO::PARAM_INT);
    return $stmt->execute();
}
