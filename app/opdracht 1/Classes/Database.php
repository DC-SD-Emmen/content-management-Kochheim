<?php

class Database {

    private $servername = "mysql";
    private $username = "root";
    private $password = "root";
    private $privatedb = "database";
    private $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host={$this->servername};dbname={$this->privatedb}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            }
        }
         
    public function getConn() {
        return $this->conn;
    }
}
