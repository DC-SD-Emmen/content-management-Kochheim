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
            $username = null;
            $username = trim($_POST['username']);
            $username = stripslashes($username);
            $username = htmlspecialchars($username);
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $userManager->register($username, $hashedPw);
        }
 
        if(isset($_POST['login'])){
            $username = null;
            $username = trim($_POST['logusername']);
            $username = stripslashes($username);
            $username = htmlspecialchars($username);

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

<div class="gameform">
    <form method="post" action='./Formhandler.php' enctype="multipart/form-data"> 
            name:<br>
            <input type="text" name="titleInput" value='testTitle' required> <br>
            genre: <br>
            <input type="text" name="genreInput" value='testGenre' required> <br> 
            platform: <br>
            <input type="text" name="platformInput" value='testPlatform' required> <br> 
            release year: <br>
            <input type="date" name="releaseyearInput" required> <br> 
            rating:  <br>
            <input type="range" id="rating" name="rating" min="1.0" max="10.0" step="0.1" required 
             oninput="this.nextElementSibling.value = parseFloat(this.value).toFixed(1)"> 
            <output for="rating">5.0</output><br> 
            Description: <br>       
            <textarea name="description" value='testDescription' rows="5"></textarea> <br>
            image: <br>
            <input type="file" name="gameImage" id="image" required>
            <input type="submit" id="submitButton" value="Submit" name="addGame"> <br>
        </form>
    </div>

    
 
</body>
</html>