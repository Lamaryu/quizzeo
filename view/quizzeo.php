<?php
// session_start();
require_once('../controller/connexion_bdd.php');
require_once('../controller/traitement.php');

$idquizz = $_GET["id"];
$quizz = recup($idquizz);

// var_dump($quizz);
// die();

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

    <form action="resultat.php?id=<?=$idquizz?>" method="POST">
        <?php $i = 1;
        $c = 1;
        // var_dump($quizz);
        // die;
        foreach ($quizz as $intitule => $reponse) : ?>
            <div class="card question mx-auto" id="carte<?= $i ?>" style="width: 55rem;height: 28rem;margin: 12rem">
                <div class="card-body">
                    <h3 class="card-title text-center" style="padding-bottom: 30px;padding-top: 10px;"><?= $intitule ?></h3>

                    <div class="row">
                        <div class="form-group col-md-6 col text-center">
                            <label for="reponsea" class="reponse">
                                <h5>Reponse A :</h5>
                            </label>
                            <div class="A input-group input-group-lg" id="A">
                                <input type="radio" class="btn-check " name="btnradio<?=$i?>" id="btnradio<?=$c?>" value="<?= $reponse[0][1]?>">
                                <label class="btn btn-outline-primary mx-auto" for="btnradio<?=$c?>"><?= $reponse[0][0] ?></label><?php $c++?>
                            </div>
                        </div>
                        <div class="form-group col-md-6 col text-center">
                            <label for="reponseb" class="reponse">
                                <h5> Reponse B :</h5>
                            </label>
                            <div class="B input-group input-group-lg " id="B">
                                <input type="radio" class="btn-check " name="btnradio<?=$i?>" id="btnradio<?=$c?>" value="<?= $reponse[1][1]?>">
                                <label class="btn btn-outline-primary mx-auto" for="btnradio<?=$c?>"><?= $reponse[1][0] ?></label><?php $c++?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 col text-center">
                            <label for="reponsec" class="reponse">
                                <h5>Reponse C :</h5>
                            </label>
                            <div class="C input-group input-group-lg" id="C">
                                <input type="radio" class="btn-check " name="btnradio<?=$i?>" id="btnradio<?=$c?>" value="<?= $reponse[2][1]?>">
                                <label class="btn btn-outline-primary mx-auto" for="btnradio<?=$c?>"><?= $reponse[2][0] ?></label><?php $c++?>
                            </div>
                        </div>
                        <div class="form-group col-md-6 col text-center">
                            <label for="reponsed" class="reponse">
                                <h5> Reponse D :</h5>
                            </label>
                            <div class="D input-group input-group-lg" id="D">
                                <input type="radio" class="btn-check" name="btnradio<?=$i?>" id="btnradio<?=$c?>" value="<?= $reponse[3][1]?>">
                                <label class="btn btn-outline-primary mx-auto" for="btnradio<?=$c?>"><?= $reponse[3][0] ?></label><?php $c++?>
                            </div>
                        </div>
                    </div>
                    <div class="mx-auto col-md-12 col text-center" style="margin-top: 3rem;">
                        <button class="valide text-center bg-valid btn btn-success btn-lg" id="bouton<?=$i?>" type="button">Valider</button>
                    </div>
                </div>
            </div>
        <?php $i++;
        endforeach ?>
    </form>
    <script src="../js/quizzeo.js"></script>
</body>

</html>