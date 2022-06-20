<!DOCTYPE html>
<html lang="en">
<?php
session_start();
require_once('../controller/connexion_bdd.php');
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Quizzeo</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="principal.php" style="padding-left: 10px;">Quizzeo</a>
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
                                <a href="..." aria-current="page" class="nav-link active">Nouveau quizzeo</a>
                            </li>
                        <?php elseif ($_SESSION['role'] == 3) : ?>
                            <li class="nav-item">
                                <a href="liste_quizz.php" aria-current="page" class="nav-link active">Tout les quizzeo</a>
                            </li>
                            <li class="nav-item">
                                <a href="..." aria-current="page" class="nav-link active">Nouveau quizzeo</a>
                            </li>
                        <?php endif ?>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="connexion.php">Connexion</a>
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
    <?php
    if (isset($_GET['success'])) :
        if ($_GET['success'] == true) : ?>
            <div class="alert alert-success" role="alert" style="margin: 0%;">
                <strong><?= $_SESSION['pseudo'] ?></strong> Vous êtes bien connecté.
            </div>
        <?php endif ?>
    <?php endif ?>
    <div style="padding-left: ;">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <a href="quizzeo.php" class="card-link">Card link</a>
            </div>
        </div>
    </div>
    <script src="index.js"></script>
</body>

</html>