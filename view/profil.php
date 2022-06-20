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
    <title>Mon profil</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="../public/css/profil.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php" style="padding-left: 10px;">Quizzeo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if (isset($_SESSION['id'])) : ?>
                        <?php if ($_SESSION['role'] == 2) : ?>
                            <li class="nav-item">
                                <a href="liste_quizz.php" aria-current="page" class="nav-link active">Mes quizzeo</a>
                            </li>
                            <li class="nav-item">
                                <a href="new_quizz.php" aria-current="page" class="nav-link active">Nouveau quizzeo</a>
                            </li>
                        <?php elseif ($_SESSION['role'] == 3) : ?>
                            <li class="nav-item">
                                <a href="liste_quizz.php" aria-current="page" class="nav-link active">Tout les quizzeo</a>
                            </li>
                            <li class="nav-item">
                                <a href="new_quizz.php" aria-current="page" class="nav-link active">Nouveau quizzeo</a>
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
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container" style="padding-top: 100px;">
        <div class="row">
            <div class="col-sm-1" style="padding-left: 32%;">
                <div class="card" style="width: 30rem;">
                    <div class="card-body text-center" >
                        <h4 class="card-title text-center" style="padding: 1rem;"><strong> Mon profil</strong></h4>

                        <h5 class="card-text" style="padding: 0.5rem;">Mon pseudo :</h5>

                        <?php
                        if (isset($_GET['key']) && ($_GET['key'] == 1)) : ?>
                            <form action="../Controller/traitement_modif.php?id=<?= $_SESSION['id']?>&col=pseudo" method="POST">
                                <input type="text" value="<?= $_SESSION['pseudo'] ?>" name="modif">
                                <input class="btn btn-success" type="submit" value="valider">
                            </form>
                        <?php
                        else : ?>
                            <p class="card-text"><?= $_SESSION['pseudo'] ?>
                            <div class="modif"><a class="btn btn-warning" href="profil.php?key=1" role="button">changer</a></div>
                            </p>
                        <?php endif ?>

                        <h5 class="card-text" style="padding: 0.5rem;">Mon email :</h5>

                        <?php if (isset($_GET['key']) &&  ($_GET['key'] == 3)) : ?>
                            <form action="../Controller/traitement_modif.php?id=<?= $_SESSION['id']?>&col=email" method="POST">
                                <input type="text" value="<?= $_SESSION['email'] ?>" name="modif">
                                <input class="btn btn-success" type="submit" value="valider">
                            </form>
                        <?php
                        else : ?>
                            <p class="card-text"><?= $_SESSION['email'] ?>
                            <div class="modif"><a class="btn btn-warning" href="profil.php?key=3" role="button">changer</a></div>
                            </p>
                        <?php endif ?>

                        <h5 class="card-text" style="padding: 0.5rem;">Mon mot de passe :</h5>

                        <?php if (isset($_GET['key']) && ($_GET['key'] == 4)) : ?>
                            <form action="../Controller/traitement_modif.php?id=<?= $_SESSION['id']?>&col=mdp" method="POST">
                                <input type="text" value="<?= $_SESSION['password'] ?>" name="modif">
                                <input class="btn btn-success" type="submit" value="valider">
                            </form>
                        <?php
                        else : ?>
                            <p class="card-text"><?= $_SESSION['password'] ?>
                            <div class="modif"><a class="btn btn-warning" href="profil.php?key=4" role="button">changer</a></div>
                            </p>
                        <?php endif ?>

                        <a class="btn btn-danger" href="index.php?deconnexion=true" role="button">Deconnexion</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="../js/profil.js"></script>
</body>

</html>