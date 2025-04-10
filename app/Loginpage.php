<?php
    //! spl autoloader /classes
    spl_autoload_register(function ($className) {
        require_once 'classes/' . $className . '.php';
    });

    //! session start
    session_start();

    //! make new database 
    $db = new Database();
    //! make new usermanager
    $um = new UserManager($db->getConnection());

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
        if(isset($_POST['register'])) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $password = password_hash($password, PASSWORD_DEFAULT);
            $um->register($username, $email, $password);
        }
        if(isset($_POST['login'])) {
            $username = $_POST['logusername'];
            $password = $_POST['logpassword'];
            //!login die user
            $um->login($username, $password);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Loginpage.css">
    <title>LOGIN OF AANMELDEN!</title>
</head>
<body>
    <h1 id="signuptitle">Sign up</h1>
    <div class="signupcontainer">
        <form method="post" >
            <label id="signup" for="username">Username</label>
            <input type="text" name="username" id="username">
            <label id="signup" for="email">Email</label>
            <input type="email" name="email" id="email">
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