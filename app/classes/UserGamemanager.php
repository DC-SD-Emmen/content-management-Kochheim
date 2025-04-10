<?php
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
         
        public function fetch_all_user_games($user_id) {
                $stmt = $this->conn->prepare("
                    SELECT games.* 
                    FROM games 
                    INNER JOIN user_games ON games.id = user_games.game_id 
                    WHERE user_games.user_id = :user_id
                ");
                $stmt->bindParam(':user_id', $user_id);
                $stmt->execute();
                
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all rows at once
                
                $usergames = [];
                foreach ($rows as $row) { // Iterate over the fetched rows
                    $game = new Game();
                    $game->setID($row['id']);
                    if (isset($row['title'])) $game->set_title($row['title']);
                    if (isset($row['description'])) $game->set_description($row['description']);
                    if (isset($row['genre'])) $game->set_genre($row['genre']);
                    if (isset($row['platform'])) $game->set_platform($row['platform']);
                    if (isset($row['releaseyear'])) $game->set_releaseyear($row['releaseyear']);
                    if (isset($row['rating'])) $game->set_rating($row['rating']);
                    if (isset($row['image'])) $game->set_image($row['image']);
                    $usergames[] = $game;
                }
                return $usergames;
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

        function RemoveWishlist($game_id, $user_id) {
            echo "game id: " . $game_id;
            try {
                $stmt = $this->conn->prepare("DELETE FROM user_games WHERE game_id = :game_id AND user_id = :user_id");
                $stmt->bindParam(':game_id', $game_id);
                $stmt->bindParam(':user_id', $user_id);
                $stmt->execute();
                echo 'Game removed from wishlist';
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }
?>