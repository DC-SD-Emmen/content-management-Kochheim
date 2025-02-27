<?php
session_start(); 


if (empty($_SESSION['user'])) {
    header('Location: login.php'); 
    exit();
}

session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welkom</title>
</head>
<body>
<h1>jo man het is je gelukt om in te loggen</h1>
<form id ="logout"action="http:\\localhost/opdracht 1/index.php" method="post">
    <input type="submit" value="logout">   
    </form>
</body>
</html>
<?php

