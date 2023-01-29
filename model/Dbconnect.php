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

    protected function connect(){

        $bdd = new PDO("mysql:host=$this->host;dbname=$this->dbname", "$this->user", "$this->password");
        $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);        

        return $bdd;
    }


}
