<?php
session_start();
require_once('../controller/connexion_bdd.php');

$request = "SELECT `id`,`titre`, `difficulte`, `date_creation` FROM quizz";
$quizz = $connexion->query($request);

if (!empty($_SESSION)){
    $iduser = $_SESSION["id"];
}

    if (isset($_GET['deconnexion'])) {
        if ($_GET['deconnexion'] == true){
            session_unset(); 
        }
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/css/index.css">
    <title>Quizzeo</title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
        <div class="container-fluid">
            <div class="titre">
                <a class="navbar-brand" href="index.php"><h3>Quizzeo</h3></a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if (isset($_SESSION['id'])) : ?>
                        <?php if ($_SESSION['role'] == 2) : ?>
                            <li class="nav-item">
                                <a href="liste_quizz.php" aria-current="page" class="nav-link active" style="margin-right: 15px">Mes quizzeo</a>
                            </li>
                            <li class="nav-item">
                                <a href="new_quizz.php" aria-current="page" class="nav-link active" style="margin-right: 15px">Nouveau quizzeo</a>
                            </li>
                        <?php elseif ($_SESSION['role'] == 3) : ?>
                            <li class="nav-item">
                                <a href="liste_quizz.php" aria-current="page" class="nav-link active" style="margin-right: 15px">Tout les quizzeo</a>
                            </li>
                            <li class="nav-item">
                                <a href="new_quizz.php" aria-current="page" class="nav-link active" style="margin-right: 15px">Nouveau quizzeo</a>
                            </li>
                        <?php endif ?>
                    <?php endif ?>
                </ul>
                <ul class="navbar-nav ">
                    <?php if (!empty($_SESSION)) :?>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="profil.php" style="margin-right: 15px;">Mon profil</a>
                    </li>
                    <?php else : ?>
                    <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="connexion.php" style="margin-right: 15px;">Me Connecter</a>
                        </li>
                    <?php endif ?>
                </ul>
                <div class="d-flex">
                    <input id="searchbar" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button id="trouver" class="btn btn-success">chercher</button>
                </div>
            </div>
        </div>
    </nav>

    <?php if (isset($_GET['success'])) :
        if ($_GET['success'] == true) : ?>
            <div class="alert alert-success" role="alert" style="margin: 0%;">
                <strong><?= $_SESSION['pseudo'] ?></strong> Vous êtes bien connecté.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif ?>
    <?php endif;

    if (isset($_GET['new'])) :
        if ($_GET['new'] == true) : ?>
            <div class="alert alert-success" role="alert" style="margin: 0%;">
                <strong> Votre nouveau quizzeo a été bien enregistré </strong> 
                <button type="button" class="btn-close d-flex justify-content-end" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif ?>
    <?php endif ?>


<!-- Modal -->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h6 style="padding-bottom: 10px;"><strong> Pour pouvoir faire un quizzeo il vous faut vous connecter.</strong></h6> 
            <div class="text-center"><a href="connexion.php" type="button" class="btn btn-primary">Me connecter</a></div>
            <h6 style="padding-bottom: 10px;padding-top: 10px"><strong> Si vous n'avez pas encore de compte inscrivez-vous vite.</strong></h6>
            <div class="text-center"><a href="inscription.php" type="button" class="btn btn-primary">M'inscrire</a></div>
        </div>
        </div>
    </div>
    </div>
    </div>

    <div class="presentation" >
        <div class="row row-cols-md-3 g-5" id="conteneur">
            <?php 
            foreach($quizz as $key=>$value) :?>
                <div class="card">
                <?php if(!empty($_SESSION)) :?>
                    <a href="quizzeo.php?id=<?= $value["id"]?>" style="text-decoration: none;outline: none;color: black;">
                <?php else : ?>
                    <a data-bs-toggle="modal" data-bs-target="#exampleModal" style="text-decoration: none;outline: none;color: black;">
                <?php endif ?>
                    <div class="corps card-body text-center" id="quizz<?= $value["id"]?>">
                        <h5 class="card-title"><?= $value["titre"]?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?= $value["difficulte"]?></h6>
                    </div>
                </a>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    <script src="../js/index.js"></script>
</body>
</html>