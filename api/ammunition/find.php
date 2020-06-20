<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');

    include_once '../../system/Database.php';
    include_once '../../models/ammunition.php';

    // instancja bazy danych
    $database = new DatabaseConnector();
    $db = $database->connect();

    // instancja obiektu statku

    $ammunition = new ammunition($db);
    
    // Get ID
    $ammunition->id = isset($_GET['id']) ? $_GET['id'] : die();

    // find query
    $ammunition->find();
    
    $ammunition_arr = array(
        'id' => $ammunition->id,
        'ammoName' => $ammunition->ammoName,
        'em_dmg' => $ammunition->em_dmg,
        'expl_dmg' => $ammunition->expl_dmg,
        'kinetic_dmg' => $ammunition->kinetic_dmg,
        'thermal_dmg' => $ammunition->thermal_dmg,
        'range_bonus' => $ammunition->range_bonus,
        'techLevel' => $ammunition->techLevel,
        'trackingSpeedMultiplier' => $ammunition->trackingSpeedMultiplier

    );

    // JSON
    print_r(json_encode($ammunition_arr));
    
?>