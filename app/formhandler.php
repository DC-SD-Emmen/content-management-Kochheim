<?php
    spl_autoload_register(function ($className) {
        require_once 'classes/' . $className . '.php';
    });

    if (isset($_POST['user_logged_in']) && $_POST['user_logged_in'] === 'true') {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    $db = new Database();
    $gm = new Gamemanager($db);

    if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
        if (isset($_POST['add_to_wishlist'])) {
            $game_id = htmlspecialchars ($_POST['game_id']);
            $gm->add_to_user_games($game_id);
        } else if(isset($_POST[' addGame'])){
            $title = htmlspecialchars($_POST["titleInput"]); 
            $genre =  htmlspecialchars($_POST["genreInput"]);
            $platform = htmlspecialchars($_POST["platformInput"]); 
            $releaseyear = htmlspecialchars($_POST["releaseyearInput"]);
            $rating = $_POST["rating"];
            $description = htmlspecialchars($_POST['description']);
            //! $afbeelding = 'uploads/no-image.jpg';
            //! Set a default image path if no file is uploaded

            if (!empty($_FILES["fileToUpload"]["tmp_name"])) {
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;  
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

                if ($check === false) {
                echo "File is not an image.";
                return;
                }

                if (file_exists($target_file)) {
                //! echo 'Sorry, file already exists. Please rename it or choose another image.';
                return;
                }

                if ($_FILES["fileToUpload"]["size"] > 500000) {
                    echo "<div id='test'>Sorry, your file is too large.</div>";
                    return;
                }

                if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    return;
                }

                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    //! echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
                    $afbeelding = $target_file; 
                } else {
                    echo "Sorry, there was an error uploading your file.";
                    return; 
                }
                $gm->insertdata($title, $genre, $platform, $releaseyear, $rating, $description, $afbeelding);
            } 
        }
    }
?>