<?php
    include_once 'formhandler.php';

    spl_autoload_register(function ($className) {
        require_once 'classes/' . $className . '.php';
    });

    //! Start the session if not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['user'])) {
        header('Location:Loginpage.php');
        exit();
    }

    
    $user_id = $_SESSION['userId'];

    //! echo "user id: " . $user_id;

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
    <div class= "containerstart">
    <p> Moaiii <?php echo $_SESSION['user']; ?> Dit zijn jou opgeslagen games. </p> 
    <a id="terug" href="Libraryuser.php">Terug</a>
    </div>
        <div class="gameswishlist">
            <?php
                foreach($games as $game) {
                    echo "<div class='games'>";
                    echo "<h1>" . $game->get_title() . "</h1>";
                    echo "<a href='Wishgame.php?id=" . $game->getID() . "'>";
                        echo "<img class='img'src='" . $game->get_image(). "' class='GameImage'>";
                    echo "</a>";
                    echo "</div>";
                }

            ?>
        </div>
</body>
</html>