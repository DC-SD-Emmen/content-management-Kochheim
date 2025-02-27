<?php
session_start();
include_once 'Usermanager.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new Database(); 

    if (isset($_POST['register'])) {
        echo ' received form data: ' . $_POST['username'] . ', ' . $_POST['password'] . ' <br> ';
        $username = htmlspecialchars($_POST['username']);
        $password = $_POST['password'];
        $hashedPw = password_hash($password, PASSWORD_DEFAULT);
        $db->Register($username, $hashedPw);
        echo 'User added successfully';
    }
    if (isset($_POST['Login'])) {
        $username = htmlspecialchars($_POST['logusername']);
        $password = $_POST['logpassword'];
        $userId = $db->Login($username, $password);
        if ($userId) {
            $_SESSION['userId'] = $userId;
            header('Location: opdracht%201/Welkom.php');
            exit();
    }
}
}