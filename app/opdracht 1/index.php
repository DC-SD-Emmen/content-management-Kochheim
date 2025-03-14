<?php

    session_start();
    spl_autoload_register(function ($class_name) {
        include './Classes/' . $class_name . '.php';
    });

    $db = new Database();
    $userManager = new UserManager($db->getConn());
    
    //if server request method is post
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {


        if(isset($_POST['register'])){

            $username = htmlspecialchars($_POST['username']);
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $userManager->register($username, $hashedPw);
        }

        if(isset($_POST['login'])){

            $username = htmlspecialchars($_POST['logusername']);
            $password = $_POST['logpassword'];
            $userManager->login($username, $password);
        }
    }

?>

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

<div class="signupcontainer">
    <form method="post" >
        <label id="signup" for="username">Username</label>
        <input type="text" name="username" id="username">
        <label id="signup" for="password">Password</label>
        <input id="signup"type="password" name="password" id="password">
        <input type="submit" value="Register" name="register">
    </form>
</div>

<h1 id="logintitle">Login</h1>
<div class="logincontainer">
    <form method="post">
        <label id="login"for="logusername">Username</label>
        <input id="login"type="text"  name="logusername" required>
        <label id="login"for="logpassword">Password</label>
        <input id="login"type="password" name="logpassword" required>
        <input type="submit" value="Login" name="login">
    </form>
</div>


</body>
</html>