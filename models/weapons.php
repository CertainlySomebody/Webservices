<?php

    class weapons {
        private $db = null;
        private $table = 'weapons';

        public $id;
        public $weaponName;
        public $rateOfFire;
        public $optimalRange;
        public $dmgMultiplier;
        public $reloadTime;


        public function __construct($db) {
            $this->db = $db;
        }

        public function findAll() {
            $query = "SELECT
                    id,
                    weaponName,
                    rateOfFire,
                    optimalRange,
                    dmgMultiplier,
                    reloadTime
                    FROM 
                    $this->table";
            
            $statement = $this->db->prepare($query);
            $statement->execute();

            return $statement;
        }

        public function find() {
            $query = "SELECT
                    weaponName,
                    rateOfFire,
                    optimalRange,
                    dmgMultiplier,
                    reloadTime
                    FROM
                    $this->table
                    WHERE id=?";

            $statement = $this->db->prepare($query);
            $statement->bindParam(1, $this->id);

            $statement->execute();

            $row = $statement->fetch(PDO::FETCH_ASSOC);

            $this->weaponName = $row['weaponName'];
            $this->rateOfFire = $row['rateOfFire'];
            $this->optimalRange = $row['optimalRange'];
            $this->dmgMultiplier = $row['dmgMultiplier'];
            $this->reloadTime = $row['reloadTime'];
        }

        public function insert() {
            $query = "INSERT INTO $this->table
                SET
                    weaponName = :weaponName,
                    rateOfFire = :rateOfFire,
                    optimalRange = :optimalRange,
                    dmgMultiplier = :dmgMultiplier,
                    reloadTime = :reloadTime";

            $statement = $this->db->prepare($query);

            $this->weaponName       = htmlspecialchars(strip_tags($this->weaponName));
            $this->rateOfFire       = htmlspecialchars(strip_tags($this->rateOfFire));
            $this->optimalRange     = htmlspecialchars(strip_tags($this->optimalRange));
            $this->dmgMultiplier    = htmlspecialchars(strip_tags($this->dmgMultiplier));
            $this->reloadTime       = htmlspecialchars(strip_tags($this->reloadTime));

            $statement->bindParam(':weaponName', $this->weaponName);
            $statement->bindParam(':rateOfFire', $this->rateOfFire);
            $statement->bindParam(':optimalRange', $this->optimalRange);
            $statement->bindParam(':dmgMultiplier', $this->dmgMultiplier);
            $statement->bindParam(':reloadTime', $this->reloadTime);

            if($statement->execute()) {
                return true;
            }

            print_f("Error: %s.\n", $statement->error);

            return false;
        }

        public function update() {
            $query = "UPDATE $this->table
                SET
                    weaponName = :weaponName,
                    rateOfFire = :rateOfFire,
                    optimalRange = :optimalRange,
                    dmgMultiplier = :dmgMultiplier,
                    reloadTime = :reloadTime
                WHERE id = :id";

            $statement = $this->db->prepare($query);

            $this->weaponName       = htmlspecialchars(strip_tags($this->weaponName));
            $this->rateOfFire       = htmlspecialchars(strip_tags($this->rateOfFire));
            $this->optimalRange     = htmlspecialchars(strip_tags($this->optimalRange));
            $this->dmgMultiplier    = htmlspecialchars(strip_tags($this->dmgMultiplier));
            $this->reloadTime       = htmlspecialchars(strip_tags($this->reloadTime));

            $statement->bindParam(':weaponName', $this->weaponName);
            $statement->bindParam(':rateOfFire', $this->rateOfFire);
            $statement->bindParam(':optimalRange', $this->optimalRange);
            $statement->bindParam(':dmgMultiplier', $this->dmgMultiplier);
            $statement->bindParam(':reloadTime', $this->reloadTime);

            if($statement->execute()) {
                return true;
            }

            print_f("Error: %s.\n", $statement->error);

            return false;
        }

        public function delete() {
            $query = "DELETE FROM $this->table WHERE id = :id";

            $statement = $this->db->prepare($query);

            // Clean

            $this->id = htmlspecialchars(strip_tags($this->id));

            // bind parameter

            $statement->bindParam(':id', $this->id);

            if($statement->execute()) {
                return true;
            }

            print_f("Error: %s.\n", $statement->error);

            return false;
        }

    }

?>