<?php

$title="Ajout d'un cours";

include 'partials/header.php';

require 'request/ressource.dao.php';

$types = getTypes();
?>
<?php
// AJOUT
if(isset($_POST['titre'],$_POST['lien'], $_POST['description'], $_POST['idType']))
{
    try{
        $success = addRessource($_POST['titre'],$_POST['lien'], $_POST['description'], $_POST['idType']);
        if($success){ ?>
            <div class="container-md">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <p>La création s'est bien déroulée</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        <?php }else{ ?>
            <div class="container-md">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <p>La création ne s'est pas bien déroulée</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        <?php }
    }catch(Exception $e){
        echo $e->getMessage();
    }

}
?>
    <div class="container-md mt-5">
        <div class="h-100 p-5 text-bg-info text-white rounded-3">
            <h1>Création d'un cours</h1>
            <p class="h3">Bienvenue sur la page d'ajout de Ressource</p>
            <a class="btn btn-outline-light btn-lg" href="ressource.php">Retourner à la liste</a>
        </div>
        <div class="mt-5 w-75 mx-auto">
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="titre">Titre de la ressource :</label>
                    <input class="form-control mt-3" id="titre" name="titre" type="text" placeholder="Saisir le titre de votre ressource" />
                </div>
                <div class="form-group">
                    <label for="lien">Lien de la ressource :</label>
                    <input class="form-control mt-3" id="lien" name="lien" type="text" placeholder="Saisir le lien de votre ressource" />
                </div>
                <div class="form-group mt-3">
                    <label for="description">Description de la ressource : :</label>
                    <textarea class="form-control mt-3" id="description" name="description" ></textarea>
                </div>
                <div class="form-group mt-3">
                    <label for="idType">Type du cours :</label>
                    <select id="idType" name="idType" class="form-control">
                        <?php foreach($types as $type): ?>
                            <option value="<?= $type['idType'] ?>">
                                <?= $type['libelle'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <input type="submit" value="Enregistrer" class="btn btn-primary btn-lg mt-5" />
            </form>
        </div>
    </div>
<?php
include 'partials/footer.php';
