<?php
include_once 'Usermanager.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new Database();  // Create a new instance of Database class.
    if (isset($_POST['submit'])) {
        echo ' received form data: ' . $_POST['username'] . ', ' . $_POST['password'] . ' <br> ';
        $username = htmlspecialchars($_POST['username']);
        $password = $_POST['password'];
        $hashedPw = password_hash($password, PASSWORD_BCRYPT);
        $db->User($username, $hashedPw);
        echo 'User added successfully';
    }
}