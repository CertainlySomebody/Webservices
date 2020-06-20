<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
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

    // id to update
    $weapons->id = $data->id;

    $weapons->weaponName = $data->weaponName;
    $weapons->rateOfFire = $data->rateOfFire;
    $weapons->optimalRange = $data->optimalRange;
    $weapons->dmgMultiplier = $data->dmgMultiplier;
    $weapons->reloadTime = $data->reloadTime;

    // Update post

    if($weapons->update()) {
        echo json_encode(
            array('success' => 'Post updated')
        );
    } else {
        echo json_encode(
            array('error' => 'Post update error')
        );
    }