<?php
$title = "Catalogue de cours";

include'partials/header.php';
require'request/catalogue.dao.php';
require'services/imageService.php';

$types = getTypes();
?>
<div class="container-md mt-5">
    <div class="h-100 p-5 text-bg-info text-white rounded-3">
        <h1>Gestion des types</h1>
        <p class="h3">Bienvenue dans la gestion des types</p>
        <form action="" method="post" enctype="multipart/form-data">
            <fieldset name="ajout d'un type" class="border p-5">
                <label for="addType" class="form-label">Ajout d'un type :</label>
                <input type="text" class="form-control" name="addType" id="addType">
                <input type="submit" value="Ajouter" class="btn btn-success mt-3" />
            </fieldset>
        </form>
    </div>
    <?php
    //AJOUT
        if (isset($_POST['addType']) && $_POST['addType'] !== ''){
            $same = false;
            foreach ($types as $type){
                if (!$same){
                    if ($_POST['addType'] == $type['libelle']){
                        $same = true;
                    }
                }
            }
            if ($same){ ?>
                <div class="container-md">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <p>Le type existe deja</p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            <?php }
            else{
                $success = addType($_POST['addType']);
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
                $types = getTypes();
            }
        }
    // SUPPRESSION
        if(isset($_GET['type']) && $_GET['type'] === 'suppression')
        {
            $typeNameToDelete = getTypeNameToDelete($_GET['idType']);
            ?>
            <div class="container-md">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <p>Voulez vous vraiment supprimer <strong><?= $typeNameToDelete ?></strong> ?</p>
                    <a href="?delete=<?= $_GET['idType'] ?>" class="btn btn-outline-danger">Confirmer</a>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        <?php }
        if(isset($_GET['delete']))
        {
            $success = deleteType($_GET['delete']);
            if($success){ ?>
                <div class="container-md">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <p>La suppression s'est bien déroulée</p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            <?php $types = getTypes();  }else{?>
                <div class="container-md">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <p>La suppression ne s'est pas bien déroulée</p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            <?php $types = getTypes(); }
        }
        ?>
    <div class="container text-center mt-5">
        <h3 class="mb-5">Liste des types</h3>
        <?php foreach ($types as $type) : ?>
        <div class="row">
            <div class="col border p-2">
                <?= $type['idType'] ?>
            </div>
            <div class=" col border p-2 ">
                <?= $type['libelle'] ?>
            </div>
            <div class="col border p-2">
                <form action="" method="GET">
                    <input type="hidden" name="idType" value="<?= $type['idType'] ?>" />
                    <input type="hidden" name="type" value="suppression" />
                    <input type="submit" value="Supprimer" class="btn btn-outline-danger" />
                </form>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>


<?php include 'partials/footer.php';