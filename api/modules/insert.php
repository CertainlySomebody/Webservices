<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, X-Requested-With');

    include_once '../../system/Database.php';
    include_once '../../models/modules.php';

    // instancja bazy danych 
    $database = new DatabaseConnector();
    $db = $database->connect();

    // instancja obiektu statku

    $modules = new modules($db);

    // Get data
    $data = json_decode(file_get_contents("php://input"));


    $modules->moduleType = $data->moduleType;
    $modules->moduleDesc = $data->moduleDesc;
    $modules->moduleCategory = $data->moduleCategory;
    $modules->moduleVolume = $data->moduleVolume;
    $modules->moduleTier = $data->moduleTier;


    // Create post

    if($modules->insert()) {
        echo json_encode(
            array('success' => 'module Created')
        );
    } else {
        echo json_encode(
            array('error' => 'module create error')
        );
    }