<?php
// session_start();
require_once('../controller/connexion_bdd.php');
require_once('../controller/traitement.php');

$resultat = array_count_values($_POST);
$resultat = $resultat[1];
$idquizz = $_GET["id"];
$id = $_SESSION["id"];

user($id, $idquizz, $resultat);

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
    <title>Resultat</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
        <div class="container-fluid">
            <div class="titre">
                <a class="navbar-brand" href="index.php">
                    <h3>Quizzeo</h3>
                </a>
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
                    <?php if (!empty($_SESSION)) : ?>
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

    <div style="margin: 12rem;">
        <h1 class="text-center mx-auto">votre score :</h1>
        <h1 class="text-center mx-auto" style="padding-top: 40px;"><strong><?= $resultat?></strong></h1>
    </div>
</body>

</html>