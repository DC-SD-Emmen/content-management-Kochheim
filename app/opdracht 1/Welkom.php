<?php

spl_autoload_register(function ($class_name) {
    include './Classes/' . $class_name . '.php';
});
session_start(); 

foreach ($_SESSION as $key => $value) {
    echo $key . ' ' . $value . '<br>';
}

if(isset($_POST['logout'])){
    session_destroy();
}

    $db = new Database();
    $gamesOphalen = new Gamemanager($db);
    $games = $gamesOphalen->fetch_all_games();
    foreach ($games as $game) {
        echo "<img src='{$game->get_image()}' alt='{$game->get_title()}'>";

    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welkom</title>
</head>
<body>
    <form>
        <input type="submit" value="logout" name="logout">
    </form>
<h1>jo man het is je gelukt om in te loggen</h1>
<form id ="logout"action="http:\\localhost/opdracht 1/index.php" method="post">
    <input type="submit" value="logout">   
    </form>
</body>
</html>
<?php

