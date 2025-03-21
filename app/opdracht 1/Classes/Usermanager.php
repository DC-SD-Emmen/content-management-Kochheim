<?php

class UserManager {

    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function register($username, $password)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            echo 'User added successfully';
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function login($username, $password)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $result['password'])) {
                $_SESSION['user'] = $username;
                $_SESSION['userId'] = $result['id'];

                header ('Location: Welkom.php');
            } else {
                echo 'Invalid username or password';
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

