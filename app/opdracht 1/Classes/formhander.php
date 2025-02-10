<?php
include_once 'Usermanager.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $db = new Database();  // Create a new instance of Database class.
    if (isset($_POST['submit'])){
        echo ' received form data: '. $_POST['username']. ', '. $_POST['password']. ' <br> ';
        $username = $_POST['username'];
        $password = $_POST['password'];
        $db-> User($username, $password);
        echo 'User added successfully';
    }
}