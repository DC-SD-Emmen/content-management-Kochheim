<?php

    class Gamemanager {
        private $conn;

        public function __construct(database $db) {
            $this->conn = $db->getConnection();
        }

        public function insertdata($title, $genre, $platform, $releaseyear, $rating, $description, $afbeelding) {
            // Controleer of de POST-warden bestaan en voeg anders een lege string toe
            try {
                $stmt = $this->conn->prepare("INSERT INTO games (title, genre, platform, releaseyear, rating, description, image) 
                VALUES (:title, :genre, :platform, :releaseyear, :rating, :description,:image)");
                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':genre', $genre);
                $stmt->bindParam(':platform', $platform);
                $stmt->bindParam(':releaseyear', $releaseyear);
                $stmt->bindParam(':rating', $rating);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':image', $afbeelding);
                $stmt->execute();
                echo "New record created successfully ";
            } catch(PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
        public function fetch_all_games() {
            $stmt = $this->conn->prepare("SELECT * FROM games");
            $stmt->execute();

            $games = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $game = new Game();
                $game->setID($row['id']);
                $game->set_title($row['title']);
                $game->set_description($row['description']);
                $game->set_genre($row['genre']);
                $game->set_platform($row['platform']);
                $game->set_releaseyear($row['releaseyear']);
                $game->set_rating($row['rating']);
                $game->set_image($row['image']);

                $games[] = $game;
            }
            if (empty($games)) {
                echo "<div id='test'>No games found in the database.</div>";
            }
            return $games;
        }

        function get_game_details($id) {
            try {
                $stmt = $this->conn->prepare("SELECT title, genre, platform, releaseyear, rating, description, image FROM games WHERE id = :id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    $game = $stmt->fetch(PDO::FETCH_ASSOC);
                    return $game; 
                } else {
                    return null;
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        public function add_to_user_games($game_id) {
            session_start();
            try {
                $stmt = $this->conn->prepare("INSERT INTO user_games (user_id, game_id) VALUES (:user_id, :game_id)");
                $stmt->bindParam(':user_id', $_SESSION['userId']);
                $stmt->bindParam(':game_id', $game_id);
                $stmt->execute();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }
?>
