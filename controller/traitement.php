<?php

require_once('connexion_bdd.php');

function circuit($id)
{
    global $connexion;
    

    $request = "SELECT `circuit`.`nom`, `circuit`.`nombre_place_total`, `circuit`.`date_debut`, `circuit`.`date_fin`, `circuit`.`prix`, `utilisateur_circuit`.`id`,`utilisateur_circuit`.`date_reservation` 
                FROM `circuit`, `utilisateur_circuit`
                WHERE `utilisateur_circuit`.`id_circuit` = `circuit`.`id` 
                AND `utilisateur_circuit`.`id_utilisateur` = ? ";
    $result = $connexion->prepare($request);
    $result->bind_param("i", $id);
    $result->execute();
    $result->bind_result($nom, $place, $dated ,$datef, $prix, $idreservation ,$dater);

    if (!$result) {
        return null;
    } else {
        while ($result->fetch()) {
            $circuitp["nom"] = $nom;
            $circuitp["nombre_place_total"] = $place;
            $circuitp["date_debut"] = $dated;
            $circuitp["date_fin"] = $datef;
            $circuitp["prix"] = $prix;
            $circuitp["date_reservation"] = $dater;
            $reservation[$idreservation] = $circuitp;
        }
        return $reservation;
    }
}
?>