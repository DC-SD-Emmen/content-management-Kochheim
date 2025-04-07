<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/Detailpagina.css">
    <title>Document</title>
</head>
<body>
    <?php
        $id = isset($_GET['id']) ? $_GET['id'] : 0;

        spl_autoload_register(function ($className) {
            require_once 'classes/' . $className . '.php';
        });

        $db = new Database();
        $gamesOphalen = new Gamemanager($db);
        $gameDetails = $gamesOphalen->get_game_details($id);
        if ($gameDetails) {
            echo "<h1>{$gameDetails['title']}</h1>";
            echo "<img src='{$gameDetails['image']}' alt='{$gameDetails['title']}'>";
            echo "<p><strong>Genre:</strong> {$gameDetails['genre']}</p>";
            echo "<p><strong>Platform:</strong> {$gameDetails['platform']}</p>";
            echo "<p><strong>Release Year:</strong> {$gameDetails['releaseyear']}</p>";
            echo "<p><strong>Rating:</strong> {$gameDetails['rating']}</p>";
            echo "<p><strong>Description:</strong> {$gameDetails['description']}</p>";
        } else {
            echo "<h2>Game not found.</h2>";
        }
    ?>

    <form action="formhandler.php" method="post">
        <input type="hidden" name="game_id" value="<?php echo $id; ?>">
        <input type="submit" name="add_to_wishlist" value="Add to wishlist">
    </form>
    <a id="close" href="Libraryuser.php">sluit
</body>
</html>