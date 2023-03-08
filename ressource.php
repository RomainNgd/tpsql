<?php


$title = "Catalogue de cours";

include 'partials/header.php';
require 'request/ressource.dao.php';

$types = getTypes();
$ressources = getRessources();

function truncate($text, $ending = '...') {
    if (strlen($text) > 50) {
        return substr($text, 0, 50).$ending;
    }
    return $text;
}

?>
<div class="container-md mt-5">
    <div class="h-100 p-5 text-bg-info text-white rounded-3">
        <h1>Les Ressource</h1>
        <p class="h3">Voici la page des ressource</p>
        <a class="btn btn-outline-light btn-lg" href="ajout-ressource.php">Ajout d'une ressource</a>
        <a class="btn btn-outline-light btn-lg" href="type.php">Gérer les types</a>
    </div>
    <?php
    // SUPPRESSION
    if(isset($_GET['type']) && $_GET['type'] === 'suppression')
    {
    $ressourceNameToDelete = getRessourceNameToDelete($_GET['idRessource']);
    ?>
    <div class="container-md">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <p>Voulez vous vraiment supprimer <strong><?= $ressourceNameToDelete ?></strong> ?</p>
            <a href="?delete=<?= $_GET['idRessource'] ?>" class="btn btn-outline-danger">Confirmer</a>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    <?php }
    if(isset($_GET['delete']))
    {
    $success = deleteRessource($_GET['delete']);
    if($success){ ?>
    <div class="container-md">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p>La suppression s'est bien déroulée</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    <?php }else{?>
    <div class="container-md">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <p>La suppression ne s'est pas bien déroulée</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    <?php }
        $ressources = getRessources();
    } ?>
    <div class="row no-gutters">
        <?php foreach ($ressources as $ressource) :?>
        <div class="col-md-4 mt-5">
            <div class="card mx-auto" style="width: 18rem;height: 20rem">
                <button class="btn btn-warning"><a href="<?= $ressource['lien'] ?>" target="_blank">Aller au lien</a></button>
                <div class="card-body">
                    <h5 class="card-title"><?= $ressource['titre'] ?></h5>
                    <p class="card-text"><?= truncate($ressource['description']) ?></p>
                    <?php
                    $type = getRessourceType($ressource['idType']);
                    ?>
                    <span class="badge bg-primary"><?= $type['libelle'] ?></span> <br>
                    <span class="date"><?=$ressource['date'] ?></span>
                </div>
                <div class="card-footer mt-3 d-flex justify-content-around">
                    <form action="" method="GET">
                        <input type="hidden" name="idCours" value="<?= $ressource['idRessource'] ?>" />
                        <input type="hidden" name="type" value="modification" />
                        <input type="submit" value="Modifier" class="btn btn-primary" />
                    </form>
                    <form action="" method="GET">
                        <input type="hidden" name="idRessource" value="<?= $ressource['idRessource'] ?>" />
                        <input type="hidden" name="type" value="suppression" />
                        <input type="submit" value="Supprimer" class="btn btn-outline-danger" />
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>
</div>
