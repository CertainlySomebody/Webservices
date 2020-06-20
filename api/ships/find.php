<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');

    include_once '../../system/Database.php';
    include_once '../../models/ships.php';

    // instancja bazy danych
    $database = new DatabaseConnector();
    $db = $database->connect();

    // instancja obiektu statku

    $ship = new ships($db);
    
    // Get ID
    $ship->id = isset($_GET['id']) ? $_GET['id'] : die();

    // find query
    $ship->find();
    
    $ship_arr = array(
        'id' => $ship->id,
        'shipName' => $ship->shipName,
        'shipDescription' => $ship->shipDescription,
        'shipClass' => $ship->shipClass,
        'shipRace' => $ship->shipRace,
        'highSlots' => $ship->highSlots,
        'medSlots' => $ship->medSlots,
        'lowSlots' => $ship->lowSlots,
        'rigSlots' => $ship->rigSlots,
        'volume' => $ship->volume,
        'price' => $ship->price,
        'shipTier' => $ship->shipTier
    );

    // JSON
    print_r(json_encode($ship_arr));
    
?>