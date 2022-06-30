<?php require_once("../controller/connexion_bdd.php"); 
require_once("liste_quizz.php");


$idQ= $_GET["idQ"];


    $del  =  "DELETE FROM quizz WHERE id=?";
    $del = $connexion->prepare($del);
    $del->bind_param("i", $idQ);
    $del->execute();


echo('quiz supprimer');

header("liste_quizz.php");