<?php
require_once('connexion_bdd.php');
session_start();


if (!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['role'])) {

    $pseudo = htmlspecialchars($_POST['pseudo']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $role = htmlspecialchars($_POST['role']);

    $requete = "SELECT count(*) FROM user WHERE email = '" . $email . "' AND pseudo = '". $pseudo ."'";
    $exec_requete = mysqli_query($connexion, $requete);
    $reponse      = mysqli_fetch_array($exec_requete);
    $count = $reponse['count(*)'];
    $email = strtolower($email);

    if ($count == '0') {
        if (strlen($email) <= 100) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                $insert = "INSERT INTO user (`pseudo`, `email`, `password`, `role`) VALUES(?, ?, ?, ?)";
                $insert = $connexion->prepare($insert);
                $insert->bind_param("sssi", $pseudo, $email, $password, $role);
                $insert->execute();

                $requete2 = "SELECT `id`, `pseudo`, `email`, `password`, `role`
                             FROM user
                             WHERE email = '" . $email . "' AND pseudo = '". $pseudo ."' ";
                $exec_requete2 = mysqli_query($connexion, $requete2);
                $reponse2      = mysqli_fetch_array($exec_requete2);
                $id = $reponse2['id'];
                $pseudo = $reponse2['pseudo'];
                $email = $reponse2['email'];
                $password = $reponse2['password'];
                $role = $reponse2['role'];

                $_SESSION['id'] = $id;
                $_SESSION['pseudo'] = $pseudo;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                $_SESSION['role'] = $role;
                header('Location: ../View/principal.php?success=true');
                die();
            } else {
                header('Location: ../View/inscription.php?reg_err=email');
                die();
            }
        } else {
            header('Location: ../View/inscription.php?reg_err=email_length');
            die();
        }
    } else {
        header('Location: ../View/inscription.php?reg_err=already');
        die();
    }
} else {
    header('Location: ../View/inscription.php?reg_err=void');
    die();
}
