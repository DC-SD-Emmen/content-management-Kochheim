<?php


 class Database{

    private $conn;
    private $servername = "mysql";
    private $username = "root";
    private $password = "root";
    private $privatedb = "Gamelibrary";

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host={$this->servername};dbname={$this->privatedb}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
    }   
}
public function getConnection() {
    return $this->conn;
}
}