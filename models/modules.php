<?php

    class modules {

        private $db = null;
        private $table = 'modules';

        public $id;
        public $moduleType;
        public $moduleDesc;
        public $moduleCategory;
        public $moduleVolume;
        public $moduleTier;

        public function __construct($db) {
            $this->db = $db;
        }

        // FIND ALL

        public function findAll() {
            $query = "SELECT
                    id,
                    moduleType,
                    moduleDesc,
                    moduleCategory,
                    moduleVolume,
                    moduleTier
                    FROM
                    $this->table";
            // Prepare
            $statement = $this->db->prepare($query);
            // Execute
            $statement->execute();

            return $statement;
        }

        public function find() {
            $query = "SELECT
                    moduleType,
                    moduleDesc,
                    moduleCategory,
                    moduleVolume,
                    moduleTier
                    FROM
                    $this->table
                    WHERE id=?";
            $statement = $this->db->prepare($query);
            $statement->bindParam(1, $this->id);

            $statement->execute();

            $row = $statement->fetch(PDO::FETCH_ASSOC);

            $this->moduleType = $row['moduleType'];
            $this->moduleDesc = $row['moduleDesc'];
            $this->moduleCategory = $row['moduleCategory'];
            $this->moduleVolume = $row['moduleVolume'];
            $this->moduleTier = $row['moduleTier'];

        }

        public function insert() {
            $query = "INSERT INTO $this->table
                SET
                    moduleType = :moduleType,
                    moduleDesc = :moduleDesc,
                    moduleCategory = :moduleCategory,
                    moduleVolume = :moduleVolume,
                    moduleTier = :moduleTier";

            $statement = $this->db->prepare($query);

            $this->moduleType           = htmlspecialchars(strip_tags($this->moduleType));
            $this->moduleDesc           = htmlspecialchars(strip_tags($this->moduleDesc));
            $this->moduleCategory       = htmlspecialchars(strip_tags($this->moduleCategory));
            $this->moduleVolume         = htmlspecialchars(strip_tags($this->moduleVolume));
            $this->moduleTier           = htmlspecialchars(strip_tags($this->moduleTier));

            $statement->bindParam(':moduleType', $this->moduleType);
            $statement->bindParam(':moduleDesc', $this->moduleDesc);
            $statement->bindParam(':moduleCategory', $this->moduleCategory);
            $statement->bindParam(':moduleVolume', $this->moduleVolume);
            $statement->bindParam(':moduleTier', $this->moduleTier);

            if($statement->execute()) {
                return true;
            }

            print_f("Error: %s.\n", $statement->error);

            return false;

        }

        public function update() {
            $query = "UPDATE $this->table
                SET
                    moduleType = :moduleType,
                    moduleDesc = :moduleDesc,
                    moduleCategory = :moduleCategory,
                    moduleVolume = :moduleVolume,
                    moduleTier = :moduleTier
                WHERE id = :id";

            $statement = $this->db->prepare($query);

            $this->moduleType           = htmlspecialchars(strip_tags($this->moduleType));
            $this->moduleDesc           = htmlspecialchars(strip_tags($this->moduleDesc));
            $this->moduleCategory       = htmlspecialchars(strip_tags($this->moduleCategory));
            $this->moduleVolume         = htmlspecialchars(strip_tags($this->moduleVolume));
            $this->moduleTier           = htmlspecialchars(strip_tags($this->moduleTier));

            $statement->bindParam(':moduleType', $this->moduleType);
            $statement->bindParam(':moduleDesc', $this->moduleDesc);
            $statement->bindParam(':moduleCategory', $this->moduleCategory);
            $statement->bindParam(':moduleVolume', $this->moduleVolume);
            $statement->bindParam(':moduleTier', $this->moduleTier);

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