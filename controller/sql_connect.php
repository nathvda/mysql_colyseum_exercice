<?php

require __DIR__ . '/../vendor/autoload.php';

Dotenv\Dotenv::createImmutable(__DIR__ . '/')->load();

class DbConnect{

    private $host;
    private $dbname;
    private $user;
    private $password;

    public function __construct(){
        $this->host = $_ENV['HOST'];
        $this->dbname = $_ENV['DBNAME'];
        $this->user = $_ENV['USER'];
        $this->password = $_ENV['PASSWORD'];
    }

    public function connect(){
        $host = $this->host;
        $db = $this->dbname;
        $password = $this->password;
        $user = $this->user;

        $bdd = new PDO("mysql:host=$host;dbname=$db", "$user", "$password");
        return $bdd;
    }


}



?>