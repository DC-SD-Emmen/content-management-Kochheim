<?php
    spl_autoload_register(function ($className) {
        require_once 'classes/' . $className . '.php';
    });

    //! Start the session if not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    //! Establish database connection
    $conn = (new Database())->getConnection();
    $userManager = new UserManager($conn);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $newusername = $_POST['username'];
        $newemail = $_POST['email'];
        $newpassword = $_POST['password'];

        if (empty($newusername) || empty($newpassword) || empty($newemail)) {
            echo "Please fill in all fields!";
        } else {
            //! Check if the username already exists
            $hashedPassword = password_hash($newpassword, PASSWORD_DEFAULT);

            //! hashed de password
            if (isset($_SESSION['userId'])) {
                $userId = $_SESSION['userId'];
                //! past de username en wachtwoord aan van de user momenteen in de session
                if ($userManager->updateUser($userId, $newusername, $newemail, $hashedPassword)) {
                    echo "User updated successfully!";

                } else {
                    echo "Failed to update user.";
                }

            } else {
                echo "User ID not found in session.";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h1>Edit Your Account</h1>
    <form method="POST">
        <label for="newusername">New Username:</label>
        <input type="text" id="newusername" name="username" required>
        <br><br>
        <label for="newemail">New Email:</label>
        <input type="email" id="newemail" name="email" required>
        <br><br>
        <label for="newpassword">New Password:</label>
        <input type="password" id="newpassword" name="password" required>
        <br><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>