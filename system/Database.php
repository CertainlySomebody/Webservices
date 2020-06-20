<?php

class DatabaseConnector {

    private $dbconnection = null;
    private $host = 'localhost';
    private $db = 'webservices';
    private $user = 'root';
    private $pwd = '';

    public function connect() {

        $this->dbconnection = null;

        try {
            $this->dbconnection = new \PDO( "mysql:host=$this->host;dbname=$this->db;charset=utf8mb4", $this->user, $this->pwd );
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }

        return $this->dbconnection;

    }

}

?>