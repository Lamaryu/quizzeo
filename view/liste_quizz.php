<?php require_once("../controller/connexion_bdd.php"); 
    session_start()
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> affichage quizz </title>
    <link rel="stylesheet" href="../public/css/admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>
      
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Quizzeo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="connexion.php">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="inscription.php">Inscription</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="affichage_quizz.php">QUIZZ</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    
        <table class="text-center" >
            <thead>
                


            <?php if (isset($_SESSION['id'])) : ?>

<?php if ($_SESSION['role'] == 3) : ?>
    <?php 
                $requete = "SELECT `id`, `titre`, `difficulte`, `date_creation` FROM `quizz`";
                $result = $connexion->query($requete);
                foreach ($result as $range) : ?>
                    <tr style="padding: 20px;">
                   
                        <th class="tablenom2" scope="row">user <?= $range["id"] ?></th>
                        <td  class="tablenom2" style="padding: 10px;"><?= $range["titre"] ?></td>
                        <td class="tablenom2" style="padding: 10px;"><?= $range["difficulte"] ?></td>
                        <td class="tablenom2" style="padding: 10px;"><?= $range["date_creation"] ?></td>
             
                    </tr>               
                <?php endforeach ?>

                <?php elseif ($_SESSION['role'] == 2) : ?>
    <?php 
                $requete = "SELECT user.`id`, quizz.`id`, quizz.titre, quizz.difficulte, quizz.date_creation 
                FROM `user`, `quizz`, `user_quizz` 
                WHERE  user.`id` = user_quizz.`id_user` AND quizz.`id` = user_quizz.`id_quizz` AND user.id = ? ";
                $result = $connexion->query($requete);
                foreach ($result as $range) : ?>
                    <tr style="padding: 20px;">
                   
                        <th class="tablenom2" scope="row">user <?= $range["id"] ?></th>
                        <td  class="tablenom2" style="padding: 10px;"><?= $range["titre"] ?></td>
                        <td class="tablenom2" style="padding: 10px;"><?= $range["difficulte"] ?></td>
                        <td class="tablenom2" style="padding: 10px;"><?= $range["date_creation"] ?></td>
             
                    </tr>               
                <?php endforeach ?>
                  
<!-- <?php elseif ($_SESSION !== "") : ?>
    <li class="onglet"><a href="profil.php" class="lien">Mon compte</a></li>
<?php endif ?>
<?php else : ?>
<li class="onglet"><a href="connexion.php" class="lien">Connexion</a></li>
<?php endif ?> -->
                <tr style="padding: 20px;">
                    <th class="tablenom2" scope="col" style="padding: 10px;"></th>
                    <th class="tablenom2" scope="col" style="padding: 10px;">titre</th>
                    <th class="tablenom2" scope="col" style="padding: 10px;">difficulte </th>
                    <th class="tablenom2" scope="col" style="padding: 10px;">date de creation</th>
                   
               
                </tr>
            </thead>
            <tbody>
               
            <tfoot>
                
                <div class="btn">
                <tr>
                
                    <td><a class="btn btn-success"  href="..\View\adminvoyage.php" role="button">Ajout d'une ville</a></td>
                    <td><a class="btn btn-success"  href="..\View\actionville.php" role="button">Ajout d'un circuit</a></td>
                </div>
               
                
                </tr>           
            </tfoot>
            </tbody>
        </table>
    </div>
</body>

</html>