<?php
    include '../parts/CRUDheader.php';
?>

<div class="container">
    <a href="../main.php">Powrót</a>

    <form action="" method="get" id="getTable">
        <label>Wybierz tabelę:</label>
            <select name="table" form="getTable">
                <option value="ships">Ships</option>
                <option value="modules">modules</option>
                <option value="weapons">weapons</option>
                <option value="ammunition">ammunition</option>
        </select>
        <input class="btn btn-primary" type="submit" value="Search" />
    </form>

    <?php
    ?>
    <form action="" method="POST" id="insertForm">
        <?php
            if(isset($_GET['table']) && $_GET['table'] == 'ships') {
                echo '<div class="form-group"><input type="number" name="id" placeholder="Input Ship id" /></div>';
            }elseif (isset($_GET['table']) && $_GET['table'] == 'modules') {
                echo '<div class="form-group"><input type="number" name="id" placeholder="Input Module id" /></div>';
            }elseif (isset($_GET['table']) && $_GET['table'] == 'weapons') {
                echo '<div class="form-group"><input type="number" name="id" placeholder="Input Weapon id" /></div>';
            }elseif (isset($_GET['table']) && $_GET['table'] == 'weapons') {
                echo '<div class="form-group"><input type="number" name="id" placeholder="Input ammunition id" /></div>';
            }
        ?>
        <input class="btn btn-primary" type="submit" value="Submit" name="submit" />
    </form>

    <?php
        if(isset($_GET['table']) && isset($_POST['submit'])) {
            //http://localhost/webservices/api/ships/insert.php
            $table = htmlspecialchars(strip_tags($_GET['table']));
            
            $client = curl_init();
            curl_setopt($client, CURLOPT_URL, "http://localhost/webservices/api/$table/delete.php");

            if($_POST) {
                $data = json_encode(array(
                    'id' => $_POST['id'],
                ));

                curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($client, CURLOPT_CUSTOMREQUEST, "DELETE");
                curl_setopt($client, CURLOPT_POSTFIELDS, $data);
                $response = curl_exec($client);
            }
        }
    ?>
</div>