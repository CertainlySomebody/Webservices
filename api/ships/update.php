<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, X-Requested-With');

    include_once '../../system/Database.php';
    include_once '../../models/ships.php';

    // instancja bazy danych 
    $database = new DatabaseConnector();
    $db = $database->connect();

    // instancja obiektu statku

    $ships = new ships($db);

    // Get data
    $data = json_decode(file_get_contents("php://input"));

    // id to update
    $ships->id = $data->id;

    $ships->shipName = $data->shipName;
    $ships->shipDescription = $data->shipDescription;
    $ships->shipClass = $data->shipClass;
    $ships->shipRace = $data->shipRace;
    $ships->highSlots = $data->highSlots;
    $ships->medSlots = $data->medSlots;
    $ships->lowSlots = $data->lowSlots;
    $ships->rigSlots = $data->rigSlots;
    $ships->volume = $data->volume;
    $ships->price = $data->price;
    $ships->shipTier = $data->shipTier;

    // Update post

    if($ships->update()) {
        echo json_encode(
            array('success' => 'Post updated')
        );
    } else {
        echo json_encode(
            array('error' => 'Post update error')
        );
    }