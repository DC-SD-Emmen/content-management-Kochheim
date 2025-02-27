<?php
class database{

    function __construct(){
    include_once 'DBconnect.php';
    $db = new DBconnect();
    $this->conn = $db->getConn();
    }

function Register($username, $password)
{
    try {
        $stmt = $this->conn->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function Login($username, $password)
{
    try {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password, $result['password'])) {
            $_SESSION['user'] = $username;
            $_SESSION['userId'] = $result['id'];
            header('Location: http://localhost/opdracht%201/Welkom.php/login.php');
        } else {
        }
    } catch (PDOException $e) {
    }
}
}

