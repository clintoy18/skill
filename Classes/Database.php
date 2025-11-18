<?php



class Database{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "event-management";

    public $connection;

    public function connect(){
        return $this->connection = new mysqli($this->host,$this->user,$this->pass,$this->dbname);
    }

}

?>