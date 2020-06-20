<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
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

    // id to delete
    $ammunition->id = $data->id;

    // Delete post

    if($ammunition->delete()) {
        echo json_encode(
            array('success' => 'Post deleted')
        );
    } else {
        echo json_encode(
            array('error' => 'Post delete error')
        );
    }