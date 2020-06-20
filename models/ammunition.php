<?php

    class ammunition {

        private $db = null;
        private $table = 'ammunition';

        public $id;
        public $ammoName;
        public $em_dmg;
        public $expl_dmg;
        public $kinetic_dmg;
        public $thermal_dmg;
        public $range_bonus;
        public $techLevel;
        public $trackingSpeedMultiplier;

        public function __construct($db) {
            $this->db = $db;
        }

    // FIND ALL

        public function findAll() {
            $query = "SELECT
                    id,
                    ammoName,
                    em_dmg,
                    expl_dmg,
                    kinetic_dmg,
                    thermal_dmg,
                    range_bonus,
                    techLevel,
                    trackingSpeedMultiplier
                    FROM
                    $this->table";

            $statement = $this->db->prepare($query);
            $statement->execute();

            return $statement;
        }

        public function find() {
            $query = "SELECT
                    ammoName,
                    em_dmg
                    expl_dmg,
                    kinetic_dmg,
                    thermal_dmg,
                    range_bonus,
                    techLevel,
                    trackingSpeedMultiplier
                    FROM
                    $this->table
                    WHERE id=?";
            $statement = $this->db->prepare($query);
            $statement->bindParam(1, $this->id);

            $statement->execute();

            $row = $statement->fetch(PDO::FETCH_ASSOC);

            $this->ammoName = $row['ammoName'];
            $this->em_dmg = $row['em_dmg'];
            $this->expl_dmg = $row['expl_dmg'];
            $this->kinetic_dmg = $row['kinetic_dmg'];
            $this->thermal_dmg = $row['thermal_dmg'];
            $this->range_bonus = $row['range_bonus'];
            $this->techLevel = $row['techLevel'];
            $this->trackingSpeedMultiplier = $row['trackingSpeedMultiplier'];
        }

        public function insert() {
            $query = "INSERT INTO $this->table
                SET
                    ammoName = :ammoName,
                    em_dmg = :em_dmg,
                    expl_dmg = :expl_dmg,
                    kinetic_dmg = :kinetic_dmg,
                    thermal_dmg = :thermal_dmg,
                    range_bonus = :range_bonus,
                    techLevel = :techLevel,
                    trackingSpeedMultiplier = :trackingSpeedMultiplier";

            $statement = $this->db->prepare($query);

            $this->ammoName                 = htmlspecialchars(strip_tags($this->ammoName));
            $this->em_dmg                   = htmlspecialchars(strip_tags($this->em_dmg));
            $this->expl_dmg                 = htmlspecialchars(strip_tags($this->expl_dmg));
            $this->kinetic_dmg              = htmlspecialchars(strip_tags($this->kinetic_dmg));
            $this->thermal_dmg              = htmlspecialchars(strip_tags($this->thermal_dmg));
            $this->range_bonus              = htmlspecialchars(strip_tags($this->range_bonus));
            $this->techLevel                = htmlspecialchars(strip_tags($this->techLevel));
            $this->trackingSpeedMultiplier  = htmlspecialchars(strip_tags($this->trackingSpeedMultiplier));

            $statement->bindParam(':ammoName',$this->ammoName);
            $statement->bindParam(':em_dmg',$this->em_dmg);
            $statement->bindParam(':expl_dmg',$this->expl_dmg);
            $statement->bindParam(':kinetic_dmg',$this->kinetic_dmg);
            $statement->bindParam(':thermal_dmg',$this->thermal_dmg);
            $statement->bindParam(':range_bonus',$this->range_bonus);
            $statement->bindParam(':techLevel',$this->techLevel);
            $statement->bindParam(':trackingSpeedMultiplier',$this->trackingSpeedMultiplier);

            if($statement->execute()) {
                return true;
            }

            print_f("Error: %s.\n", $statement->error);

            return false;
        }

        public function update() {
            $query = "UPDATE $this->table
                SET
                    ammoName = :ammoName,
                    em_dmg = :em_dmg,
                    expl_dmg = :expl_dmg,
                    kinetic_dmg = :kinetic_dmg,
                    thermal_dmg = :thermal_dmg,
                    range_bonus = :range_bonus,
                    techLevel = :techLevel,
                    trackingSpeedMultiplier = :trackingSpeedMultiplier";

            $statement = $this->db->prepare($query);

            $this->ammoName                 = htmlspecialchars(strip_tags($this->ammoName));
            $this->em_dmg                   = htmlspecialchars(strip_tags($this->em_dmg));
            $this->expl_dmg                 = htmlspecialchars(strip_tags($this->expl_dmg));
            $this->kinetic_dmg              = htmlspecialchars(strip_tags($this->kinetic_dmg));
            $this->thermal_dmg              = htmlspecialchars(strip_tags($this->thermal_dmg));
            $this->range_bonus              = htmlspecialchars(strip_tags($this->range_bonus));
            $this->techLevel                = htmlspecialchars(strip_tags($this->techLevel));
            $this->trackingSpeedMultiplier  = htmlspecialchars(strip_tags($this->trackingSpeedMultiplier));

            $statement->bindParam(':ammoName',$this->ammoName);
            $statement->bindParam(':em_dmg',$this->em_dmg);
            $statement->bindParam(':expl_dmg',$this->expl_dmg);
            $statement->bindParam(':kinetic_dmg',$this->kinetic_dmg);
            $statement->bindParam(':thermal_dmg',$this->thermal_dmg);
            $statement->bindParam(':range_bonus',$this->range_bonus);
            $statement->bindParam(':techLevel',$this->techLevel);
            $statement->bindParam(':trackingSpeedMultiplier',$this->trackingSpeedMultiplier);

            $statement->bindParam(':id', $this->id);

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