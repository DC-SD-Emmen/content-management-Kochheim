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
    $user = $_SESSION['user'];
    $game_id = $_GET['id'] ?? null;
    $games = [];
    if ($game_id !== null) {
        $games = $gm->fetch_games_by_user_id($user_id); // Assuming this method fetches all games for the user
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
    <p> WIl je een game verwijderen? Klik dan op de game </p>
    
    <?php foreach ($games as $game): ?>
<?php

$user_id = $_SESSION['user'];

$db = new Database();
$gm = new Gamemanager($db);

// Fetch the user_games ID based on the user_id
$user_games_id = $gm->fetch_user_games_id_by_user_id($user_id); // Assuming this method exists

$games = [];
if ($user_games_id !== null) {
    // Fetch games using the user_games ID
    $games = $gm->fetch_games_by_user_games_id($user_games_id); // Assuming this method exists
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
    <p> Goeiemiddag <?php echo htmlspecialchars($_SESSION['user']); ?> Dit zijn jou opgeslagen games. </p>
    
    <?php foreach ($games as $game): ?>
        <div class="gameswishlist">
            <a href="Wishgame?id=<?php echo $game->getID(); ?>">   
                <img src="<?php echo htmlspecialchars($game->get_image()); ?>" class="sidebarGameImage">
                <span class="gameTitle"><?php echo htmlspecialchars($game->get_title()); ?></span> <br>
            </a>
        </div>
    <?php endforeach; ?>
    </body>
    </html>