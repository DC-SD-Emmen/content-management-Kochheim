<?php
include_once 'Usermanager.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new Database();  // Create a new instance of Database class.
    if (isset($_POST['register'])) {
        echo ' received form data: ' . $_POST['username'] . ', ' . $_POST['password'] . ' <br> ';
        $username = htmlspecialchars($_POST['username']);
        $password = $_POST['password'];
        $hashedPw = password_hash($password, PASSWORD_BCRYPT);
        $db->Register($username, $hashedPw);
        echo 'User added successfully';
    }
    if (isset($_POST['Login'])) {
        echo ' received form data: ' . $_POST['Lusername'] . ', ' . $_POST['Lpassword'] . ' <br> ';
        $username = htmlspecialchars($_POST['Lusername']);
        $password = $_POST['Lpassword'];
        $db->Login($username, $password);
    }
}