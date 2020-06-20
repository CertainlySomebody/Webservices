<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
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

    // id to delete
    $weapons->id = $data->id;

    // Delete post

    if($weapons->delete()) {
        echo json_encode(
            array('success' => 'Post deleted')
        );
    } else {
        echo json_encode(
            array('error' => 'Post delete error')
        );
    }