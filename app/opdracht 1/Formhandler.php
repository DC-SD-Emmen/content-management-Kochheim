<?php
spl_autoload_register(function ($className) {
    require_once './Classes/' . $className . '.php';
});

$db = new Database();
$gm = new Gamemanager($db);

if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
    $title = htmlspecialchars($_POST["titleInput"]); 
    $genre =  htmlspecialchars($_POST["genreInput"]);
    $platform = htmlspecialchars($_POST["platformInput"]); 
    $releaseyear = htmlspecialchars($_POST["releaseyearInput"]);
    $rating = $_POST["rating"];
    $description = htmlspecialchars($_POST['description']);
    // $afbeelding = 'uploads/no-image.jpg';
     // Set a default image path if no file is uploaded

    if (isset($_FILES["gameImage"]) && $_FILES["gameImage"]["error"] == UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["gameImage"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["gameImage"]["tmp_name"]);
        
        if ($check === false) {
            echo "File is not an image.";
            return;
        }

        if (file_exists($target_file)) {
           echo 'Sorry, file already exists. Please rename it or choose another image.';
            return;
        }

        if ($_FILES["gameImage"]["size"] > 500000) {
            echo "<div id='test'>Sorry, your file is too large.</div>";
            return;
        }

        if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            return;
        }

        if (move_uploaded_file($_FILES["gameImage"]["tmp_name"], $target_file)) {
            $afbeelding = $target_file; 
            header ('Location: ./index.php');
            
        } else {
            echo "Sorry, there was an error uploading your file.";
            return; 
        }
    } else {
        $afbeelding = 'uploads/no-image.jpg'; // Set a default image path if no file is uploaded
    }

    $gm->insertdata($title, $genre, $platform, $releaseyear, $rating, $description, $afbeelding);



    if (isset($_POST['wishlist'])) {

    }
}
?>
