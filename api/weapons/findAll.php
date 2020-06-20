<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');

    include_once '../../system/Database.php';
    include_once '../../models/weapons.php';

    // instancja bazy danych 
    $database = new DatabaseConnector();
    $db = $database->connect();

    // instancja obiektu statku

    $weapons = new weapons($db);

    // find all query
    $result = $weapons->findAll();
    // count
    $count = $result->rowCount();

    if($count > 0) {
        $weaponsArray = array();
        $weaponsArray['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $weapons_item = array(
                'id' => $id,
                'weaponName' => $weaponName,
                'rateOfFire' => $rateOfFire,
                'optimalRange' => $optimalRange,
                'dmgMultiplier' => $dmgMultiplier,
                'reloadTime' => $reloadTime
            );
            array_push($weaponsArray['data'], $weapons_item);   
        }
        // convert to json
        echo json_encode($weaponsArray);

    } else {
        echo json_encode(
            array('error' => 'No modules found')
        );
    }

?>