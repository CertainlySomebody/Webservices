<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');

    include_once '../../system/Database.php';
    include_once '../../models/ammunition.php';

    // instancja bazy danych 
    $database = new DatabaseConnector();
    $db = $database->connect();

    // instancja obiektu statku

    $ammunition = new ammunition($db);

    // find all query
    $result = $ammunition->findAll();
    // count
    $count = $result->rowCount();

    if($count > 0) {
        $ammunitionArray = array();
        $ammunitionArray['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $ammunition_item = array(
                'id' => $id,
                'ammoName' => $ammoName,
                'em_dmg' => $em_dmg,
                'expl_dmg' => $expl_dmg,
                'kinetic_dmg' => $kinetic_dmg,
                'thermal_dmg' => $thermal_dmg,
                'range_bonus' => $range_bonus,
                'techLevel' => $techLevel,
                'trackingSpeedMultiplier' => $trackingSpeedMultiplier
            );
            array_push($ammunitionArray['data'], $ammunition_item);   
        }
        // convert to json
        echo json_encode($ammunitionArray);

    } else {
        echo json_encode(
            array('error' => 'No ammunition found')
        );
    }

?>