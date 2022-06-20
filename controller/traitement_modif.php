<?php
session_start();
require_once('connexion_bdd.php');

$colonne = htmlspecialchars($_GET['col']);
$modif = htmlspecialchars($_POST['modif']);
$id = htmlspecialchars($_GET['id']);

switch ($colonne) {
    case "pseudo":
        $requete = "UPDATE `user` 
                    SET pseudo = ?
                    WHERE `user`.`id` = ? ";
        break;
    case "email":
        $requete = "UPDATE `user` 
                    SET email = ?
                    WHERE `user`.`id` = ? ";
        break;
    case "mdp":
        $requete = "UPDATE `user` 
                    SET `password` = ?
                    WHERE `user`.`id` = ? ";
                    break;
}
$result = $connexion->prepare($requete);
$result->bind_param("si", $modif, intval($id));
$result->execute();

$_SESSION[$colonne] = $modif;
header('Location:../View/profil.php');
