<?php
include_once 'DBconnect.php';
$db = new DBconnect();
$this->conn = $db->getConn();
function User($username, $password) {
    $stmt = $this->conn->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
}

