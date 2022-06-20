<?php

require_once('connexion_bdd.php');
session_start();


if (isset($_POST['email']) && isset($_POST['password'])) {

   $email = htmlspecialchars($_POST['email']);
   $password = htmlspecialchars($_POST['password']);

   if ($email !== "" && $password !== "") {
      $requete = "SELECT count(*) 
                  FROM user
                  WHERE email = '" . $email . "' AND `password` = '" . $password . "' ";
      $exec_requete = mysqli_query($connexion, $requete);
      $reponse      = mysqli_fetch_array($exec_requete);
      $count = $reponse['count(*)'];

      if ($count != 0) {

         $requete2 = "SELECT `id`, `pseudo`, `email`, `password`, `role`
                      FROM user
                      WHERE email = '" . $email . "' ";
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

         header('Location: ../View/index.php?success=true');
         die();
      } else {
         header('Location: ../View/connexion.php?erreur=1');
         die();
      }
   } else {
      header('Location: ../View/connexion.php?erreur=2');
      die();
   }
} else {
   header('Location: ../View/connexion.php');
   die();
}
