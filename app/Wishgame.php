<?php
    session_start();
    spl_autoload_register(function ($className) {
        require_once 'classes/' . $className . '.php';
    });
    include_once 'formhandler.php';

    if (!isset($_SESSION['user'])) {
        header('Location:Loginpage.php');
    }

    $db = new Database();
    $gm = new Gamemanager($db);
    $user_id = $_SESSION['user'];
    $games = $gm->fetch_user_games($user_id);
    $game_id = $_GET['id'] ?? null;
    $game = $gm->fetch_game_by_id($game_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Wishlist</h1>

    
</body>
</html>