<?php
session_start();
require_once('../controller/connexion_bdd.php');

//le titre et la difficulte du quizz
function quizz() {

    global $connexion;

    $iduser = $_SESSION["id"];
    $titre = $_POST["titre"];
    $difficulte = $_POST["difficulte"];

    $insert = "INSERT INTO `quizz`(`id_quizzeur`,`titre`, `difficulte`, `date_creation`) VALUES (? ,? ,? ,now())";
    $insert = $connexion->prepare($insert);
    $insert->bind_param("iss",$iduser ,$titre, $difficulte);
    $insert->execute();

    $request= "SELECT `id` FROM `quizz` ORDER BY id DESC LIMIT 1";
    $result = $connexion->query($request);
    $idquizz = $result -> fetch_assoc();
    $idquizz = $idquizz["id"];

    return $idquizz;
} 

//l'ajout d'un user qui joue a un quizz
function user($idquizz){

    global $connexion;

    $insert = "INSERT INTO `user_quizz`(`id_user`, `id_quizz`) VALUES (? ,?)";
    $insert = $connexion->prepare($insert);
    $insert->bind_param("ii", $iduser, $idquizz);
    $insert->execute();

}

//l'intituler des questions
function question($idquizz, $intitule, $table,$i){

    global $connexion;

    $insert = "INSERT INTO `question`(`id_quizz`, `intitule`, `date_creation`) VALUES (? ,? ,now())";
    $insert = $connexion->prepare($insert);
    $insert->bind_param("is", $idquizz, $intitule);
    $insert->execute();

    $request= "SELECT `id` FROM `question` ORDER BY id DESC LIMIT 1";
    $result = $connexion->query($request);
    $idquestion = $result -> fetch_assoc();
    $idquestion = $idquestion["id"];

    return($idquestion);
}


// les reponses
function choix($idquestion, $table, $i){

global $connexion;
foreach($table["reponse".$i] as $key => $value){
    
    $reponse = $table["reponse".$i][$key];
    $bonnereponse = $table["bonnereponse".$i][$key];

    $insert = "INSERT INTO `choix`(`id_question`, `reponse`, `bonnereponse`) VALUES (? ,? ,?)";
    $insert = $connexion->prepare($insert);
    $insert->bind_param("isi", $idquestion, $reponse, $bonnereponse);
        $insert->execute();
}
}
