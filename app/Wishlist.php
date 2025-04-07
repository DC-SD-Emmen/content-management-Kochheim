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
    <?php foreach ($user_game as $game_id): ?>
        <div class="gameSidebarItem">
            <a href="Detailpagina.php?id=<?php echo $game->getID(); ?>">        
                <img src=" <?php echo htmlspecialchars($game->get_image()); ?>"  class="sidebarGameImage">
                <span class="gameTitle"><?php echo htmlspecialchars($game->get_title()); ?></span> <br>
            </a>
        </div>
    <?php endforeach; ?>
</body>
</html>