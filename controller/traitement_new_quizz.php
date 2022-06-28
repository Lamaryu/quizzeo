<?php
session_start();
require_once('../controller/connexion_bdd.php');

$i = 1;
$cnti = 2;

$idquizz = quizz();
user($idquizz);

function quizz() {

    global $connexion;

    $titre = $_POST["titre"];
    $difficulte = $_POST["difficulte"];

    $insert = "INSERT INTO `quizz`(`titre`, `difficulte`, `date_creation`) VALUES (? ,? ,now())";
    $insert = $connexion->prepare($insert);
    $insert->bind_param("ss", $titre, $difficulte);
    $insert->execute();

    $request= "SELECT `id` FROM `quizz` ORDER BY id DESC LIMIT 1";
    $result = $connexion->query($request);
    $idquizz = $result -> fetch_assoc();
    $idquizz = $idquizz["id"];
    
    return $idquizz;
} 

function user($idquizz){

    global $connexion;

    $iduser = $_SESSION["id"];

    $insert = "INSERT INTO `user_quizz`(`id_user`, `id_quizz`) VALUES (? ,?)";
    $insert = $connexion->prepare($insert);
    $insert->bind_param("ii", $iduser, $idquizz);
    $insert->execute();

}

while ($i <= ((count($_POST) - 2) / 6)) {

$I = 0;

    $table["question" . $i] = array_slice($_POST, $cnti, 1);
    $intitule = $table["question" . $i]["intitule".$i];
    $table["reponse" . $i] = array_slice($_POST, $cnti + 1, 5);

    foreach ($table["reponse".$i] as $key => $value) {
        if ($key == "good" . $i) {
            unset($table["reponse".$i]["good".$i]);
            break;
        }
        $I++;
    }

    switch ($I) {

        case "0":
            $table["bonnereponse" . $i]["reponseb". $i] = 0;
            $table["bonnereponse" . $i]["reponsea". $i] = 1;
            $table["bonnereponse" . $i]["reponsec". $i] = 0;
            $table["bonnereponse" . $i]["reponsed". $i] = 0;
            break;

        case "1":
            $table["bonnereponse" . $i]["reponseb". $i] = 1;
            $table["bonnereponse" . $i]["reponsea". $i] = 0;
            $table["bonnereponse" . $i]["reponsec". $i] = 0;
            $table["bonnereponse" . $i]["reponsed". $i] = 0;
            break;

        case "2":
            $table["bonnereponse" . $i]["reponsea". $i] = 0;
            $table["bonnereponse" . $i]["reponseb". $i] = 0;
            $table["bonnereponse" . $i]["reponsec". $i] = 1;
            $table["bonnereponse" . $i]["reponsed". $i] = 0;
            break;

        case "3":
            $table["bonnereponse" . $i]["reponsea". $i] = 0;
            $table["bonnereponse" . $i]["reponseb". $i] = 0;
            $table["bonnereponse" . $i]["reponsec". $i] = 0;
            $table["bonnereponse" . $i]["reponsed". $i] = 1;
            break;
    }

    question($idquizz, $intitule, $table,$i);
    
    $cnti += 6;
    $i++;
} 


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

    choix($idquestion,$table,$i);
}

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

header('Location: ../View/index.php?new=true');
die();