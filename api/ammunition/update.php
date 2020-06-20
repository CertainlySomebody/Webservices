<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, X-Requested-With');

    include_once '../../system/Database.php';
    include_once '../../models/ammunition.php';

    // instancja bazy danych 
    $database = new DatabaseConnector();
    $db = $database->connect();

    // instancja obiektu statku

    $ammunition = new ammunition($db);

    // Get data
    $data = json_decode(file_get_contents("php://input"));

    // id to update
    $ammunition->id = $data->id;

    $ammunition->ammoName = $data->ammoName;
    $ammunition->em_dmg = $data->em_dmg;
    $ammunition->expl_dmg = $data->expl_dmg;
    $ammunition->kinetic_dmg = $data->kinetic_dmg;
    $ammunition->thermal_dmg = $data->thermal_dmg;
    $ammunition->range_bonus = $data->range_bonus;
    $ammunition->techLevel = $data->techLevel;
    $ammunition->trackingSpeedMultiplier = $data->trackingSpeedMultiplier;

    // Update post

    if($modules->update()) {
        echo json_encode(
            array('success' => 'Post updated')
        );
    } else {
        echo json_encode(
            array('error' => 'Post update error')
        );
    }