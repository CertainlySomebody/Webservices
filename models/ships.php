<?php

    class ships {

        private $db = null;
        private $table = 'ships';

        // Ships properties
        public $id;
        public $shipName;
        public $shipDescription;
        public $shipClass;
        public $shipRace;
        public $highSlots;
        public $medSlots;
        public $lowSlots;
        public $rigSlots;
        public $volume;
        public $price;
        public $shipTier;


        public function __construct($db) {
            $this->db = $db;
        }

    // FIND ALL

        public function findAll() {
            $query = "SELECT 
                    id,
                    shipName, 
                    shipDescription, 
                    shipClass, 
                    shipRace, 
                    highSlots, 
                    medSlots, 
                    lowSlots, 
                    rigSlots, 
                    volume, 
                    price, 
                    shipTier
                    FROM
                    $this->table";
            // Prepare 
            $statement = $this->db->prepare($query);
            // Execute
            $statement->execute();

            return $statement;
        }

    // FIND

        public function find() {
            $query = "SELECT 
                    shipName, 
                    shipDescription, 
                    shipClass, 
                    shipRace, 
                    highSlots, 
                    medSlots, 
                    lowSlots, 
                    rigSlots, 
                    volume, 
                    price, 
                    shipTier
                    FROM
                    $this->table
                    WHERE id=?";
            // Prepare
            $statement = $this->db->prepare($query);
            $statement->bindParam(1, $this->id);
            // Execute
            $statement->execute();

            $row = $statement->fetch(PDO::FETCH_ASSOC);

            //set properties
            $this->shipName         = $row['shipName'];
            $this->shipDescription  = $row['shipDescription'];
            $this->shipClass        = $row['shipClass'];
            $this->shipRace         = $row['shipRace'];
            $this->highSlots        = $row['highSlots'];
            $this->medSlots         = $row['medSlots'];
            $this->lowSlots         = $row['lowSlots'];
            $this->rigSlots         = $row['rigSlots'];
            $this->volume           = $row['volume'];
            $this->price            = $row['price'];
            $this->shipTier         = $row['shipTier'];
        }

    // INSERT

        public function insert() {
            $query = "INSERT INTO $this->table 
                SET
                    shipName = :shipName,
                    shipDescription = :shipDescription,
                    shipClass = :shipClass,
                    shipRace = :shipRace,
                    highSlots = :highSlots,
                    medSlots = :medSlots,
                    lowSlots = :lowSlots,
                    rigSlots = :rigSlots,
                    volume = :volume,
                    price = :price,
                    shipTier = :shipTier";

            $statement = $this->db->prepare($query);

            // Clean

            $this->shipName         = htmlspecialchars(strip_tags($this->shipName));
            $this->shipDescription  = htmlspecialchars(strip_tags($this->shipDescription));
            $this->shipClass        = htmlspecialchars(strip_tags($this->shipClass));
            $this->shipRace         = htmlspecialchars(strip_tags($this->shipRace));
            $this->highSlots        = htmlspecialchars(strip_tags($this->highSlots));
            $this->medSlots         = htmlspecialchars(strip_tags($this->medSlots));
            $this->lowSlots         = htmlspecialchars(strip_tags($this->lowSlots));
            $this->rigSlots         = htmlspecialchars(strip_tags($this->rigSlots));
            $this->volume           = htmlspecialchars(strip_tags($this->volume));
            $this->price            = htmlspecialchars(strip_tags($this->price));
            $this->shipTier         = htmlspecialchars(strip_tags($this->shipTier));

            // bind parameters

            $statement->bindParam(':shipName', $this->shipName);
            $statement->bindParam(':shipDescription', $this->shipDescription);
            $statement->bindParam(':shipClass', $this->shipClass);
            $statement->bindParam(':shipRace', $this->shipRace);
            $statement->bindParam(':highSlots', $this->highSlots);
            $statement->bindParam(':medSlots', $this->medSlots);
            $statement->bindParam(':lowSlots', $this->lowSlots);
            $statement->bindParam(':rigSlots', $this->rigSlots);
            $statement->bindParam(':volume', $this->volume);
            $statement->bindParam(':price', $this->price);
            $statement->bindParam(':shipTier', $this->shipTier);

            if ($statement->execute()) {
                return true;
            }

            print_f("Error: %s.\n", $statement->error);

            return false;
        }

    // UPDATE

        public function update() {
            $query = "UPDATE $this->table 
                SET
                    shipName = :shipName,
                    shipDescription = :shipDescription,
                    shipClass = :shipClass,
                    shipRace = :shipRace,
                    highSlots = :highSlots,
                    medSlots = :medSlots,
                    lowSlots = :lowSlots,
                    rigSlots = :rigSlots,
                    volume = :volume,
                    price = :price,
                    shipTier = :shipTier
                WHERE id = :id";

            $statement = $this->db->prepare($query);

            // Clean

            $this->shipName         = htmlspecialchars(strip_tags($this->shipName));
            $this->shipDescription  = htmlspecialchars(strip_tags($this->shipDescription));
            $this->shipClass        = htmlspecialchars(strip_tags($this->shipClass));
            $this->shipRace         = htmlspecialchars(strip_tags($this->shipRace));
            $this->highSlots        = htmlspecialchars(strip_tags($this->highSlots));
            $this->medSlots         = htmlspecialchars(strip_tags($this->medSlots));
            $this->lowSlots         = htmlspecialchars(strip_tags($this->lowSlots));
            $this->rigSlots         = htmlspecialchars(strip_tags($this->rigSlots));
            $this->volume           = htmlspecialchars(strip_tags($this->volume));
            $this->price            = htmlspecialchars(strip_tags($this->price));
            $this->shipTier         = htmlspecialchars(strip_tags($this->shipTier));

            // bind parameters

            $statement->bindParam(':shipName', $this->shipName);
            $statement->bindParam(':shipDescription', $this->shipDescription);
            $statement->bindParam(':shipClass', $this->shipClass);
            $statement->bindParam(':shipRace', $this->shipRace);
            $statement->bindParam(':highSlots', $this->highSlots);
            $statement->bindParam(':medSlots', $this->medSlots);
            $statement->bindParam(':lowSlots', $this->lowSlots);
            $statement->bindParam(':rigSlots', $this->rigSlots);
            $statement->bindParam(':volume', $this->volume);
            $statement->bindParam(':price', $this->price);
            $statement->bindParam(':shipTier', $this->shipTier);
            $statement->bindParam(':id', $this->id);

            if ($statement->execute()) {
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