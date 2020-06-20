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

        </select>
        <input class="btn btn-primary" type="submit" value="Search" />
    </form>

    <?php
    ?>
    <form action="" method="POST" id="insertForm">
        <?php
            if(isset($_GET['table']) && $_GET['table'] == 'ships') {
                echo '<div class="form-group"><input type="number" name="id" placeholder="Input Ship id" /></div>';
                echo '<div class="form-group"><input type="text" name="shipName" placeholder="Input Ship Name" /></div>';
                echo '<div class="form-group"><input type="text" name="shipDescription" placeholder="Input Ship Description" /></div>';
                echo '<div class="form-group"><input type="text" name="shipClass" placeholder="Input Ship Class" /></div>';
                echo '<div class="form-group"><input type="text" name="shipRace" placeholder="Input Ship Race" /></div>';
                echo '<div class="form-group"><input type="number" name="highSlots" placeholder="Input Ship High Slots" /></div>';
                echo '<div class="form-group"><input type="number" name="medSlots" placeholder="Input Ship Medium Slots" /></div>';
                echo '<div class="form-group"><input type="number" name="lowSlots" placeholder="Input Ship Low Slots" /></div>';
                echo '<div class="form-group"><input type="number" name="rigSlots" placeholder="Input Ship Rig Slots" /></div>';
                echo '<div class="form-group"><input type="number" name="volume" placeholder="Input Ship Volume" /></div>';
                echo '<div class="form-group"><input type="number" name="price" placeholder="Input Ship Price" /></div>';
                echo '<div class="form-group"><input type="number" name="shipTier" placeholder="Input Ship Tier" /></div>';
            }elseif (isset($_GET['table']) && $_GET['table'] == 'modules') {
                echo '<div class="form-group"><input type="number" name="id" placeholder="Input Module id" /></div>';
                echo '<div class="form-group"><input type="text" name="moduleType" placeholder="Input Module Type" /></div>';
                echo '<div class="form-group"><input type="text" name="moduleDesc" placeholder="Input Module Description" /></div>';
                echo '<div class="form-group"><input type="text" name="moduleCategory" placeholder="Input Module Category" /></div>';
                echo '<div class="form-group"><input type="number" name="moduleVolume" placeholder="Input Module Volume" /></div>';
                echo '<div class="form-group"><input type="number" name="moduleTier" placeholder="Input Module Tier" /></div>';
            }elseif (isset($_GET['table']) && $_GET['table'] == 'weapons') {
                echo '<div class="form-group"><input type="number" name="id" placeholder="Input Weapon id" /></div>';
                echo '<div class="form-group"><input type="text" name="weaponName" placeholder="Input Weapon Name" required /></div>';
                echo '<div class="form-group"><input type="text" name="rateOfFire" placeholder="Input rate of Fire" required /></div>';
                echo '<div class="form-group"><input type="text" name="optimalRange" placeholder="Input optimal Range" required /></div>';
                echo '<div class="form-group"><input type="text" name="dmgMultiplier" placeholder="Input damage Multiplier" required /></div>';
                echo '<div class="form-group"><input type="text" name="reloadTime" placeholder="Input reload Time" required /></div>';
            }elseif (isset($_GET['table']) && $_GET['table'] == 'ammunition') {
                echo '<div class="form-group"><input type="text" name="ammoName" placeholder="Input Ammo Name" required /></div>';
                echo '<div class="form-group"><input type="text" name="em_dmg" placeholder="Input Ammo EM damage" required /></div>';
                echo '<div class="form-group"><input type="text" name="expl_dmg" placeholder="Input Ammo Explosive damage" required /></div>';
                echo '<div class="form-group"><input type="text" name="kinetic_dmg" placeholder="Input Ammo kinetic damage" required /></div>';
                echo '<div class="form-group"><input type="text" name="thermal_dmg" placeholder="Input Ammo thermal damage" required /></div>';
                echo '<div class="form-group"><input type="text" name="range_bonus" placeholder="Input Ammo range bonus" required /></div>';
                echo '<div class="form-group"><input type="text" name="techLevel" placeholder="Input Ammo Tech level" required /></div>';
                echo '<div class="form-group"><input type="text" name="trackingSpeedMultiplier" placeholder="Input Ammo Tracking speed multiplier" required /></div>';
            }
        ?>
        <input class="btn btn-primary" type="submit" value="Submit" name="submit"/>
    </form>

    <?php
    
        if(isset($_GET['table']) && isset($_POST['submit'])) {
            //http://localhost/webservices/api/ships/insert.php
            $table = htmlspecialchars(strip_tags($_GET['table']));
            
            $client = curl_init();
            curl_setopt($client, CURLOPT_URL, "http://localhost/webservices/api/$table/update.php");

            if($_POST) {
                if($table == 'ships') {
                    $data = json_encode(array(
                        'id' => $_POST['id'],
                        'shipName' => $_POST['shipName'],
                        'shipDescription' => $_POST['shipDescription'],
                        'shipClass' => $_POST['shipClass'],
                        'shipRace' => $_POST['shipRace'],
                        'highSlots' => $_POST['highSlots'],
                        'medSlots' => $_POST['medSlots'],
                        'lowSlots' => $_POST['lowSlots'],
                        'rigSlots' => $_POST['rigSlots'],
                        'volume' => $_POST['volume'],
                        'price' => $_POST['price'],
                        'shipTier' => $_POST['shipTier']
                    ));
                }elseif($table == 'modules') {
                    $data = json_encode(array(
                        'id' => $_POST['id'],
                        'moduleType' => $_POST['moduleType'],
                        'moduleDesc' => $_POST['moduleDesc'],
                        'moduleCategory' => $_POST['moduleCategory'],
                        'moduleVolume' => $_POST['moduleVolume'],
                        'moduleTier' => $_POST['moduleTier']
                    ));
                }elseif($table == 'weapons') {
                    $data = json_encode(array(
                        'weaponName' => $_POST['weaponName'],
                        'rateOfFire' => $_POST['rateOfFire'],
                        'optimalRange' => $_POST['optimalRange'],
                        'dmgMultiplier' => $_POST['dmgMultiplier'],
                        'reloadTime' => $_POST['reloadTime']
                    ));
                }elseif($table == 'ammunition') {
                    $data = json_encode(array(
                        'ammoName' => $_POST['ammoName'],
                        'em_dmg' => $_POST['em_dmg'],
                        'expl_dmg' => $_POST['expl_dmg'],
                        'kinetic_dmg' => $_POST['kinetic_dmg'],
                        'thermal_dmg' => $_POST['thermal_dmg'],
                        'range_bonus' => $_POST['range_bonus'],
                        'techLevel' => $_POST['techLevel'],
                        'trackingSpeedMultiplier' => $_POST['trackingSpeedMultiplier'],
                    ));
                }

                curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($client, CURLOPT_CUSTOMREQUEST, "PUT");
                curl_setopt($client, CURLOPT_POSTFIELDS, $data);
                $response = curl_exec($client);
            }
        }
    ?>
</div>