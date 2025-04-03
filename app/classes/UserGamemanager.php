<?php

spl_autoload_register(function ($className) {
    require_once 'classes/' . $className . '.php';
});

class UserGamemanager {

    private $conn;
    function __construct($conn){
        $this->conn = $conn;
    }

    function AddToWishlist ($game_id, $user_id) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO user_games (game_id, user_id) VALUES (:game_id, :user_id)");
            $stmt->bindParam(':game_id', $game_id);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();
            echo 'Game added to wishlist';
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function updateUser($userId, $username, $password) {
        $stmt = $this->conn->prepare("UPDATE users SET username = :username, password = :password WHERE id = :id");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':id', $userId);
        return $stmt->execute();
    }
    
    function GetWishlist($user_id) {
        try {
            $stmt = $this->conn->prepare("SELECT games.title FROM games INNER JOIN user_games ON games.id = user_games.game_id WHERE user_games.user_id = :user_id");
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }
}