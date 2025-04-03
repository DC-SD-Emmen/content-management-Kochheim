<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Css/index.css">
    
    <title>Gamemanager</title>
</head>


<body>

<div id="title">
    <p>Gamelibrary</p>
        <a id="add-button" href="Addgame.php">Add Game</a>
        <a id="add-button"  href="Loginpage.php">Login/Signup</a>

    </div>
</div>

<div class="middle">
    <div class="sidebar">    
        <h1>Games</h1>
        <img src="" alt="">

        <?php
        include_once 'formhandler.php';
        spl_autoload_register(function ($className) {
        require_once 'classes/' . $className . '.php';
        });

        $db = new Database();
        $gm = new Gamemanager($db);
        $games = $gm ->fetch_all_games();
        ?>

        <?php foreach ($games as $game): ?>
        <div class="gameSidebarItem">
                
            <a href="Detailpagina.php?id=<?php echo $game->getID(); ?>">        
            <img src=" <?php echo htmlspecialchars($game->get_image()); ?>"  class="sidebarGameImage">
            <span class="gameTitle"><?php echo htmlspecialchars($game->get_title()); ?></span> <br>
            </a>
        </div>
        
        <?php endforeach; ?>
    </div>
    <div class="Gamemiddle">
        <?php foreach ($games as $game): ?>
            <div class="groteImage"> 
                <a href="Detailpagina.php?id=<?php echo $game->getID(); ?>">        
                <img src=" <?php echo htmlspecialchars($game->get_image()); ?>"  class="MiddleImage">
                </a>
            </div>  
            <?php endforeach; ?>
        </div></a> 
    </div>  
</div>
</body>
</html>