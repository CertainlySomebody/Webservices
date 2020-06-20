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

    // find all query
    $result = $modules->findAll();
    // count
    $count = $result->rowCount();

    if($count > 0) {
        $modulesArray = array();
        $modulesArray['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $modules_item = array(
                'id' => $id,
                'moduleType' => $moduleType,
                'moduleDesc' => $moduleDesc,
                'moduleCategory' => $moduleCategory,
                'moduleVolume' => $moduleVolume,
                'moduleTier' => $moduleTier
            );
            array_push($modulesArray['data'], $modules_item);   
        }
        // convert to json
        echo json_encode($modulesArray);

    } else {
        echo json_encode(
            array('error' => 'No modules found')
        );
    }

?>