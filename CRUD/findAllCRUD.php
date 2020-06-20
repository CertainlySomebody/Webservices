<?php
    include '../parts/CRUDheader.php';
?>
<div class="container">
<a href="../main.php">Powrót</a>

<form action="" method="GET" id="findAllForm">
    <label>Wybierz tabelę:</label>
    <select name="table" form="findAllForm">
        <option value="ships">Ships</option>
        <option value="modules">modules</option>
        <option value="weapons">weapons</option>
        <option value="ammunition">ammunition</option>
    </select>
    <input class="btn btn-primary" type="submit" value="Search" />
</form>

<?php

if(isset($_GET['table'])) {

    $table = htmlspecialchars(strip_tags($_GET['table']));

    $api_url = 'http://localhost/webservices/api/'.$table.'/findAll.php';

    $client = curl_init($api_url);

    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($client);

    $result = json_decode($response);

    if($result) {
        //echo '<pre>';
        //var_dump($result);
        //echo '</pre>';
        foreach($result->data as $item) {
            echo '<div class="item_single">';
                if($table == 'ships') {
                    //echo "<p><b>ID:</b> $item->id</p>";
                    echo "<h1><b>Ship name:</b> $item->shipName</h1>";
                    echo "<p><b>Ship description:</b> $item->shipDescription</p>";
                    echo "<p><b>Ship class:</b> $item->shipClass</p>";
                    echo "<p><b>Ship race:</b> $item->shipRace</p>";
                    echo "<p><b>High slots:</b> $item->highSlots</p>";
                    echo "<p><b>Medium Slots:</b> $item->medSlots</p>";
                    echo "<p><b>Low Slots:</b> $item->lowSlots</p>";
                    echo "<p><b>Rig Slots:</b> $item->rigSlots</p>";
                    echo "<p><b>Volume:</b> $item->volume m3</p>";
                    echo "<p><b>Price:</b> $item->price</p>";
                    echo "<p><b>Ship Tier:</b> $item->shipTier</p>";
                } elseif ($table == 'modules') {
                    echo "<h1><b>Module Type:</b> $item->moduleType</h1>";
                    echo "<p><b>Module Description:</b> $item->moduleDesc</p>";
                    echo "<p><b>Module Category:</b> $item->moduleCategory</p>";
                    echo "<p><b>Module Volume:</b> $item->moduleVolume</p>";
                    echo "<p><b>Module Tier:</b> $item->moduleTier</p>";
                }elseif ($table == 'weapons') {
                    echo "<h1><b>Weapon Name:</b> $item->weaponName</h1>";
                    echo "<p><b>Weapon Rate of Fire:</b> $item->rateOfFire</p>";
                    echo "<p><b>Weapon Optimal Range:</b> $item->optimalRange</p>";
                    echo "<p><b>Weapon Damage Multiplier:</b> $item->dmgMultiplier</p>";
                    echo "<p><b>Weapon Reload Time:</b> $item->reloadTime</p>";
                }elseif ($table == 'ammunition') {
                    echo "<h1><b>Ammunition Name:</b> $item->ammoName</h1>";
                    echo "<p><b>Em Dmg:</b> $item->em_dmg</p>";
                    echo "<p><b>Explosive Damage:</b> $item->expl_dmg</p>";
                    echo "<p><b>Kinetic Damage:</b> $item->kinetic_dmg</p>";
                    echo "<p><b>Thermal Damage:</b> $item->thermal_dmg</p>";
                    echo "<p><b>Range Bonus:</b> $item->range_bonus</p>";
                    echo "<p><b>Tech Level:</b> $item->techLevel</p>";
                    echo "<p><b>Tracking Speed Multiplier:</b> $item->trackingSpeedMultiplier</p>";
                    
                }
            echo '</div>';
        }
    }
}

?>

</div>