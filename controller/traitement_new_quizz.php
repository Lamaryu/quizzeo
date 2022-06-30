<?php
session_start();
require_once('../controller/connexion_bdd.php');
require_once('../controller/traitement.php');

$i = 1;
$cnti = 2;

$idquizz = quizz();

//ajout titre et difficulte du quizz
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

    $idquestion = question($idquizz, $intitule, $table,$i);
    choix($idquestion,$table,$i);

    $cnti += 6;
    $i++;
} 

header('Location: ../View/index.php?new=true');
die();