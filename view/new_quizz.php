<?php
session_start();
require_once('../controller/connexion_bdd.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Nouveau quizzeo</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="../public/css/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
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

    <div class="container p-3 p-md-5">
        <h2 class="text-center" style="padding-bottom: 25px;"><strong> Nouveau Quizzeo</strong></h2>
        <form action="../controller/traitement_new_quizz.php" method="POST">
            <div class="form-row">
                <div class="form-group col-md-12 text-center">
                    <label for="pseudo">
                        <h4>Titre</h4>
                    </label>
                    <input id="pseudo" name="titre" type="text" class="form-control text-center" placeholder="Titre">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="difficulte">Difficulté :</label>
                    <select id="difficulte" name="difficulte" class="form-control">
                        <option value="Facile">Facile</option>
                        <option value="Intermédiaire">Intermédiaire</option>
                        <option value="Difficile">Difficile</option>
                    </select>
                </div>
            </div>
            <div class="text-center" id="boutton">
                <input class="btn btn-secondary" type="button" id="add" onclick="plus()" value="+"></input>
                <button class="btn btn-success" type="submit" >Valider</button>
            </div>

            <div id="new" style="padding-bottom: 50px;">
                <h4 class="text-center" style="padding-bottom: 25px;padding-top: 40px"><strong>Nouvelle Question</strong></h4>

                <div class="form-row">
                    <div class="form-group col-md-12 text-center">
                        <label for="intitule">
                            <h5>Intitulé de la question</h5>
                        </label>
                        <input id="intitule" name="intitule1" type="text" class="form-control text-center" placeholder="Intitule">
                    </div>
                </div>

                <div id="choix">
                    <div class="row">
                        <div class="form-group col-md-6 col">
                            <label for="reponsea" class="reponse">
                                <h5> Reponse A</h5>
                            </label>
                            <div class="A input-group input-group-lg" id="A">
                                <div class="input-group-text">
                                    <input class="form-check-input mt-0" type="radio" value="a" name="good1" id="gooda">
                                </div>
                                <input id="reponsea" name="reponsea1" type="text" class="form-control" placeholder="Reponse A">
                            </div>
                        </div>
                        <div class="form-group col-md-6 col">
                            <label for="reponseb" class="reponse">
                                <h5> Reponse B</h5>
                            </label>
                            <div class="B input-group input-group-lg" id="B">
                                <div class="input-group-text">
                                    <input class="form-check-input mt-0" type="radio" value="b" name="good1" id="goodb">
                                </div>
                                <input id="reponseb" name="reponseb1" type="text" class="form-control" placeholder="Reponse B">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 col">
                            <label for="reponsec" class="reponse">
                                <h5>Reponse C</h5>
                            </label>
                            <div class="C input-group input-group-lg" id="C">
                                <div class="input-group-text">
                                    <input class="form-check-input mt-0" type="radio" value="c" name="good1" id="goodc">
                                </div>
                                <input id="reponsec" name="reponsec1" type="text" class="form-control" placeholder="Reponse C">
                            </div>
                        </div>
                        <div class="form-group col-md-6 col">
                            <label for="reponsed" class="reponse">
                                <h5> Reponse D</h5>
                            </label>
                            <div class="D input-group input-group-lg" id="D">
                                <div class="input-group-text">
                                    <input class="form-check-input mt-0" type="radio" value="d" name="good1" id="goodd">
                                </div>
                                <input id="reponsed" name="reponsed1" type="text" class="form-control" placeholder="Reponse D">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="../js/new_quizz.js"></script>
</body>

</html>