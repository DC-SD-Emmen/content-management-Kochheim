<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

    //autloader classes
    spl_autoload_register(function ($class_name) {
        include './Classes/' . $class_name . '.php';
    });


    



?>
    
</body>
</html>