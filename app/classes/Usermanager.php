<?php
    class UserManager {
        private $conn;
        public function __construct($conn){
            $this->conn = $conn;
        }

        public function register($username, $email, $password) {
            try {
                $stmt = $this->conn->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $password);
                $stmt->execute();
                echo 'User added successfully';
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        public function login($username, $password) {
            try {
                $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = :username");
                $stmt->bindParam(':username', $username);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if (password_verify($password, $result['password'])) {
                    $_SESSION['user'] = $username;
                    $_SESSION['userId'] = $result['id'];
                    header('Location:Libraryuser.php');
                } else {
                    echo 'Invalid username or password';
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        public function updateUser($id, $username, $email, $password) {
            try {
                $stmt = $this->conn->prepare("UPDATE users SET username = :username, email = :email, password = :password WHERE id = :id", );
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $password);
                $stmt->bindParam('email', $email);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                return true;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                return false;
            }
        }

        public function deleteUser($id) {
            try {
                $stmt = $this->conn->prepare("DELETE FROM users WHERE id = :id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                return true;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                return false;
            }
        }
    }
?>