<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');

    include_once '../../system/Database.php';
    include_once '../../models/modules.php';

    // instancja bazy danych
    $database = new DatabaseConnector();
    $db = $database->connect();

    // instancja obiektu statku

    $modules = new modules($db);
    
    // Get ID
    $modules->id = isset($_GET['id']) ? $_GET['id'] : die();

    // find query
    $modules->find();
    
    $module_arr = array(
        'id' => $modules->id,
        'moduleType' => $modules->moduleType,
        'moduleDesc' => $modules->moduleDesc,
        'moduleCategory' => $modules->moduleCategory,
        'moduleVolume' => $modules->moduleVolume,
        'moduleTier' => $modules->moduleTier
    );

    // JSON
    print_r(json_encode($module_arr));
    
?>