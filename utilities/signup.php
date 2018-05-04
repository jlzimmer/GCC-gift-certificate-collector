<?php
    function create_user() {
        $username = empty($_POST['username']) ? '' : $_POST['username'];
        $password = empty($_POST['password']) ? '' : $_POST['password'];

            if (empty($username) || empty($password))
            {
                header("Location: ../index.php?result=emptyField");
                exit;
            }
        
        require_once 'db.php';

        $username = $mysqli->real_escape_string($username);
        $password = $mysqli->real_escape_string($password);
        $password = password_hash($password, PASSWORD_DEFAULT);
		
      
        $query = "INSERT INTO users (name, password) VALUES ($username, $password);";
            
            if ($mysqli->query($query) === TRUE) {
                $query = "SELECT id FROM users WHERE name = '$username' AND password = '$password'";
                $result = $mysqli->query($query);
                $row = $result->fetch_assoc();
                $_SESSION['userID'] = $row['id'];
                $result->free();
                $mysqli->close();
                header("Location: ../library.php?result=loggedIn");
                exit;
            }
            else {
                $error = "Error: " . $query . " returned " . $mysqli->error;
                $mysqli->close();
                header("Location: ../index.php?result=createUserFailed");
                exit;
            }
    }
?>
