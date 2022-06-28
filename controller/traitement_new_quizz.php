<?php
session_start();
require_once('../controller/connexion_bdd.php');
require_once('../controller/traitement.php');

$i = 1;
$cnti = 2;

$idquizz = quizz();

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