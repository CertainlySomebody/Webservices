<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
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

    // id to update
    $modules->id = $data->id;

    $modules->moduleType = $data->moduleType;
    $modules->moduleDesc = $data->moduleDesc;
    $modules->moduleCategory = $data->moduleCategory;
    $modules->moduleVolume = $data->moduleVolume;
    $modules->moduleTier = $data->moduleTier;

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