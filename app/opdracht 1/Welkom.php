<?php
session_start(); 

echo $_SESSION['expire'];

echo '<br>';
echo time();
echo time() > $_SESSION['expire'];
if (time() > $_SESSION['expire']){
    session_destroy();
}

$inactive = 20;



// if (time() > $_SESSION['expire']) {
//     session_destroy();
// }



if(isset($_SESSION['user'])){
    // echo 'Welkom ' . $_SESSION['user'];
    $now = time();


    if ($now > $_SESSION['expire']) {
        session_destroy();
    }
}

if(isset($_POST['logout'])){
    session_destroy();
}


if(session_end()){   
    header('Location: ./index.php');
    exit()};




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

