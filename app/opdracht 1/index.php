<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<a>test</a>

<form action="Classes/formhander.php" method="post" >
    <label for="username">Username</label>
    <input type="text" name="username" id="username">
    <label for="password">Password</label>
    <input type="password" name="password" id="password">
    <input type="submit" value="Submit" name="submit">
    
</form>



<?php
    //autloader classes
    spl_autoload_register(function ($class_name) {
        include './Classes/' . $class_name . '.php';
    });

    $user = new User();

?>
    
</body>
</html>