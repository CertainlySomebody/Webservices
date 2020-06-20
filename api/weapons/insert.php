<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, X-Requested-With');

    include_once '../../system/Database.php';
    include_once '../../models/weapons.php';

    // instancja bazy danych 
    $database = new DatabaseConnector();
    $db = $database->connect();

    // instancja obiektu statku

    $weapons = new weapons($db);

    // Get data
    $data = json_decode(file_get_contents("php://input"));


    $weapons->weaponName = $data->weaponName;
    $weapons->rateOfFire = $data->rateOfFire;
    $weapons->optimalRange = $data->optimalRange;
    $weapons->dmgMultiplier = $data->dmgMultiplier;
    $weapons->reloadTime = $data->reloadTime;


    // Create post

    if($weapons->insert()) {
        echo json_encode(
            array('success' => 'module Created')
        );
    } else {
        echo json_encode(
            array('error' => 'module create error')
        );
    }