<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');

    include_once '../../system/Database.php';
    include_once '../../models/ships.php';
    
    // instancja bazy danych 
    $database = new DatabaseConnector();
    $db = $database->connect();

    // instancja obiektu statku

    $ships = new ships($db);

    // find all query
    $result = $ships->findAll();
    // count
    $count = $result->rowCount();

    if($count > 0) {
        $shipsArray = array();
        $shipsArray['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $ship_item = array(
                'id' => $id,
                'shipName' => $shipName,
                'shipDescription' => $shipDescription,
                'shipClass' => $shipClass,
                'shipRace' => $shipRace,
                'highSlots' => $highSlots,
                'medSlots' => $medSlots,
                'lowSlots' => $lowSlots,
                'rigSlots' => $rigSlots,
                'volume' => $volume,
                'price' => $price,
                'shipTier' => $shipTier
            );
            array_push($shipsArray['data'], $ship_item);   
        }
        // convert to json
        echo json_encode($shipsArray);

    } else {
        echo json_encode(
            array('error' => 'No ships found')
        );
    }
?>