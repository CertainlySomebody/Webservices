<?php

include 'parts/header.php';

// main file

echo '<div class="container">';
    echo "<h1>Eve Online Database</h1>";

    echo '<a href="CRUD/findCRUD.php">Find</a><br>';
    echo '<a href="CRUD/findAllCRUD.php">Find All</a><br>';
    echo '<a href="CRUD/insertCRUD.php">Insert</a><br>';
    echo '<a href="CRUD/updateCRUD.php">Update</a><br>';
    echo '<a href="CRUD/deleteCRUD.php">Delete</a><br>';

echo '</div>';
?>