
<?php
    include '../parts/CRUDheader.php';
?>

<div class="container">
    <a href="../main.php">Powrót</a>

    <form action="" method="GET" id="findForm">
        <input type="number" name="id" />

        <label>Wybierz tabelę:</label>
        <select name="table" form="findForm">
            <option value="ships">Ships</option>
            <option value="modules">modules</option>
            <option value="weapons">weapons</option>
            <option value="ammunition">ammunition</option>
        </select>

        <input class="btn btn-primary" type="submit" value="Search" /> 
    </form>



    <?php
    if(isset($_GET['id']) && isset($_GET['table'])) {

        $id = htmlspecialchars(strip_tags($_GET['id']));
        $table = htmlspecialchars(strip_tags($_GET['table']));

        $api_url = 'http://localhost/webservices/api/'.$table.'/find.php?id='. $id;

        $client = curl_init($api_url);

        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($client);

        $result = json_decode($response);

        if($result) {
            if($table == 'ships') {
                echo "<p><b>ID:</b> $result->id</p>";
                echo "<p><b>Ship name:</b> $result->shipName</p>";
                echo "<p><b>Ship description:</b> $result->shipDescription</p>";
                echo "<p><b>Ship class:</b> $result->shipClass</p>";
                echo "<p><b>Ship race:</b> $result->shipRace</p>";
                echo "<p><b>High slots:</b> $result->highSlots</p>";
                echo "<p><b>Medium Slots:</b> $result->medSlots</p>";
                echo "<p><b>Low Slots:</b> $result->lowSlots</p>";
                echo "<p><b>Rig Slots:</b> $result->rigSlots</p>";
                echo "<p><b>Volume:</b> $result->volume m3</p>";
                echo "<p><b>Price:</b> $result->price</p>";
                echo "<p><b>Ship Tier:</b> $result->shipTier</p>";
            } elseif ($table == 'modules') {
                echo "<p><b>ID:</b> $result->id</p>";
                echo "<p><b>Module Type:</b> $result->moduleType</p>";
                echo "<p><b>Module Description:</b> $result->moduleDesc</p>";
                echo "<p><b>Module Category:</b> $result->moduleCategory</p>";
                echo "<p><b>Module Volume:</b> $result->moduleVolume</p>";
                echo "<p><b>Module Tier:</b> $result->moduleTier</p>";
            } elseif ($table == 'weapons') {
                echo "<p><b>ID:</b> $result->id</p>";
                echo "<p><b>Weapon Name:</b> $result->weaponName</p>";
                echo "<p><b>Weapon Rate of Fire:</b> $result->rateOfFire</p>";
                echo "<p><b>Weapon Optimal Range:</b> $result->optimalRange</p>";
                echo "<p><b>Weapon Damage Multiplier:</b> $result->dmgMultiplier</p>";
                echo "<p><b>Weapon Reload Time:</b> $result->reloadTime</p>";
            } elseif ($table == 'ammunition') {
                echo "<p><b>Ammunition Name:</b> $result->ammoName</p>";
                echo "<p><b>Em Dmg:</b> $result->em_dmg</p>";
                echo "<p><b>Explosive Damage:</b> $result->expl_dmg</p>";
                echo "<p><b>Kinetic Damage:</b> $result->kinetic_dmg</p>";
                echo "<p><b>Thermal Damage:</b> $result->thermal_dmg</p>";
                echo "<p><b>Range Bonus:</b> $result->range_bonus</p>";
                echo "<p><b>Tech Level:</b> $result->techLevel</p>";
                echo "<p><b>Tracking Speed Multiplier:</b> $result->trackingSpeedMultiplier</p>";
                
            }

        } else {
            echo '<p>Record not found</p>';
        }
    }


    ?>
</div>