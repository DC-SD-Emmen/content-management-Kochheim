<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Css/Addgame.css">
    <title>Document</title>
</head>
<body>

<div id="form">
<form  method="POST" action="index.php" enctype ="multipart/form-data">
<table>
                   
<input type="hidden" name="form_type" value="addGame">


        name:<br>
      <input type="text" name="titleInput" required> <br>
        genre: <br>
      <input type="text" name="genreInput" required> <br> 
        platform: <br>
        <input type="text" name="platformInput" required> <br> 
        release year: <br>
        <input type="date" name="releaseyearInput" required> <br> 
        rating:  <br>
        <input type="range" id="rating" name="rating" min="1.0" max="10.0" step="0.1" required 
        oninput="this.nextElementSibling.value = parseFloat(this.value).toFixed(1)">
        <output for="rating">5.0</output><br> 
        Description: <br>       
            <textarea name="description" rows="5"></textarea> <br>
            image: <br>
            <input type ="file" name= "fileToUpload" id ="image" required>
            <input type="submit" id="submitButton" href="http://localhost/eindopdracht2/index.php" value="Submit" name="addGame"> <br>
            <a id="close" href="http://localhost/eindopdracht2/index.php">sluit

            
</form>
</div>
</body>
</html>