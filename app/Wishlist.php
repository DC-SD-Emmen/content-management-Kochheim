<?php
    include_once 'formhandler.php';
    spl_autoload_register(function ($className) {
        require_once 'classes/' . $className . '.php';
    });

    session_start();
    echo $_SESSION['user'];
    
    if (!isset($_SESSION['user'])) {
        header('Location:Loginpage.php');
        exit();
    }
    if (isset($_SESSION['user'])) {
        $user_id = $_SESSION['user'];
    }

    $db = new Database();
    $gm = new Gamemanager($db);
    $user_games = $gm->fetch_user_games($user_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
    <link rel="stylesheet" type="text/css" href="Css/Wishlist.css">
</head>
<body>
    <p> Goeiemiddag <?php echo $_SESSION['user']; ?> Dit zijn jou opgeslagen games. </p>
    
    <?php foreach ($user_games as $game_id): ?>
        <?php $game = $gm->fetch_game_by_id($game_id); ?>
        
        <div class="gameswishlist">
            <a href="Detailpagina.php?id=<?php echo $game->getID(); ?>">        
                <img src=" <?php echo htmlspecialchars($game->get_image()); ?>"  class="sidebarGameImage">
                <span class="gameTitle"><?php echo htmlspecialchars($game->get_title()); ?></span> <br>
            </a>
        </div>
    <?php endforeach ?>
</body>
</html