<?php
session_start();
require_once('../controller/connexion_bdd.php');

function recup($id){

    global $connexion;

    $question = [];
    $choix = [];

    $requestrecup = "SELECT question.intitule, `reponse`, `bonnereponse` 
                    FROM `choix`, `question`
                    WHERE `question`.`id` = `choix`.`id_question` 
                    AND `question`.`id_quizz` = ? ";
    $requestrecup = $connexion->prepare($requestrecup);
    $requestrecup->bind_param("i", $id);
    $requestrecup->execute();
    $requestrecup->bind_result($intitule, $reponse, $bonnereponse);

    if (!$requestrecup) {
        return null;
    } 
    else {
        while ($requestrecup->fetch()) {
            $question[$intitule][] = [$reponse, $bonnereponse];
        }

        return $question ;
    }
}

//ajout d'un user qui a joue a un quizz
function user($iduser,$idquizz,$resultat){

    global $connexion;

    $insert = "INSERT INTO `user_quizz`(`id_user`, `id_quizz`, `score`) VALUES (? ,?, ?)";
    $insert = $connexion->prepare($insert);
    $insert->bind_param("iii", intval($iduser), intval($idquizz) ,$resultat);
    $insert->execute();

}

//ajout intituler des questions
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


//ajout reponses
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
