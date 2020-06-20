<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');

    include_once '../../system/Database.php';
    include_once '../../models/weapons.php';

    // instancja bazy danych
    $database = new DatabaseConnector();
    $db = $database->connect();

    // instancja obiektu statku

    $weapons = new weapons($db);
    
    // Get ID
    $weapons->id = isset($_GET['id']) ? $_GET['id'] : die();

    // find query
    $weapons->find();
    
    $weapon_arr = array(
        'id' => $weapons->id,
        'weaponName' => $weapons->weaponName,
        'rateOfFire' => $weapons->rateOfFire,
        'optimalRange' => $weapons->optimalRange,
        'dmgMultiplier' => $weapons->dmgMultiplier,
        'reloadTime' => $weapons->reloadTime
    );

    // JSON
    print_r(json_encode($weapon_arr));
    
?>