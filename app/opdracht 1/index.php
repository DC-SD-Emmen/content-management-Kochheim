<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1 id="signuptitle">Sign up</h1>
<form id="signup" action="Classes/formhander.php" method="post" >
    <label id="username" for="username">Username</label>
    <input type="text" name="username" id="username">
    <label id="username" for="password">Password</label>
    <input id="username"type="password" name="password" id="password">
    <input type="submit" value="Submit" name="submit">   
</form>

<form id="Login" action="" method="">
    
</form>
<?php
    //autloader classes
    spl_autoload_register(function ($class_name) {
        include './Classes/' . $class_name . '.php';
    });

    // $user = new User();

?>
 
</body>
</html>