<!DOCTYPE html>
<html lang="en">

<?php
require_once('../controller/connexion_bdd.php');
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" />
    <link rel="stylesheet" href="../css/styles.css" />
    <!-- JavaScripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <title>Inscription</title>
</head>

<body>

    <?php
    if (isset($_GET['reg_err'])) {
        $err = htmlspecialchars($_GET['reg_err']);

        switch ($err) {

            case 'email':
            ?>
                <div class="alert alert-danger">
                    <strong>Erreur</strong> email non valide
                </div>
            <?php
                break;

            case 'email_length':
            ?>
                <div class="alert alert-danger">
                    <strong>Erreur</strong> email trop long
                </div>
            <?php
                break;

            case 'already':
            ?>
                <div class="alert alert-danger">
                    <strong>Erreur</strong> email ou pseudo déja utilisé
                </div>

            <?php
            case 'void':
            ?>
                <div class="alert alert-danger">
                    <strong>Erreur</strong> Merci de remplir tout le formulaire
                </div>
    <?php
        }
    }
    ?>

    <div class="container p-3 p-md-5">

        <h2 style="padding-bottom: 25px;margin-top: 50px;">Inscription</h2>

        <form action="../controller/traitement_inscription.php" method="POST">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="pseudo">Pseudo</label>
                    <input id="pseudo" name="pseudo" type="text" class="form-control" placeholder="Pseudo">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-12">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="text" class="form-control" placeholder="Email">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="password">Mot de passe</label>
                    <input id="password" name="password" type="password" class="form-control" placeholder="Mot de passe">
                </div>
                <div class="form-group col-md-6">
                    <label for="role">Role</label>
                    <select id="role" name="role"  class="form-control">
                        <option value="0">Joueur</option>
                        <option value="1">Quizzeur</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-success form-group col-12">valider</button>
        </form>
    </div>
</body>

</html>