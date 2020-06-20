<?php

class server {

    private $table = 'users';

    private $dbhost = 'localhost';
    private $dbname = 'webservices';
    private $dbuser = 'root';
    private $dbpass = '';

    private $connection;

    public function __construct() {
        $this->connection = (is_null($this->connection)) ? self::connect() : $this->connection;
    }

    public function connect() {
        try {
            $connection = new PDO( "mysql:host=$this->dbhost;dbname=$this->dbname;charset=utf8mb4", $this->dbuser, $this->dbpass );
            return $this->connection = $connection;
        }catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function login($params) {
        $query = "SELECT * FROM users WHERE email = :email LIMIT 1";

        $statement = $this->connection->prepare($query);
        $statement->bindParam(':email', $params->email);
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $result = new stdClass();

        if($row['email'] = $params->email) {
            if($row['password'] !== $params->password) {
                $result->msg = "Bad password";
                $result->success = false;
                $result->email = $row['email'];
                return $result;
            } else {
                $result->msg = "Login Success";
                $result->success = true;
                $result->email = $row['email'];
                //header('location: main.php');
                return $result->success;
            }
        } else {
            $result->msg = "Email doesn't exists in database!";
            $result->success = false;
            return $result;
        }
    }

}

$soapOptions = array('uri' => 'localhost/webservices/SOAP/server.php');
$soapServer = new SoapServer(NULL, $soapOptions);
$soapServer->setClass('server');
$soapServer->handle();


?>