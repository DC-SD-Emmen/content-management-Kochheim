<?php
    include_once 'formhandler.php';

    spl_autoload_register(function ($className) {
        require_once 'classes/' . $className . '.php';
    });

    session_start();

    if (!isset($_SESSION['user'])) {
        header('Location:Loginpage.php');
        exit();
    }

    
    $user_id = $_SESSION['userId'];

    echo "user id: " . $user_id;

    $db = new Database();   
    $ugm = new UserGamemanager($db->getConnection());

    $games = $ugm->fetch_all_user_games($user_id);
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
    <link rel="stylesheet" type="text/css" href="Css/Wishlist.css">
</head>
<body>
    <p> Moaiii <?php echo $_SESSION['user']; ?> Dit zijn jou opgeslagen games. </p>
   
        <div class="gameswishlist">

            <?php

                foreach($games as $game) {
                    echo "<h1>" . $game->get_title() . "</h1>";
                    echo "<a href='Wishgame.php?id=" . $game->getID() . "'>";
                        echo "<img src='" . $game->get_image(). "' class='GameImage'>";
                        echo "<span class='gameTitle'>Game ID: " . $game->getID() . "</span> <br>";
                    echo "</a>";
                }

            ?>
        </div>
</body>
</html>