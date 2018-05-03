<?php

function create_user() 
    {
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
		
      
        $query = "INSERT INTO Users (name, password) VALUES ($username, $password);";
                
                if ($mysqli->query($query) === TRUE) {
                    $mysqli->close();
                    handle_login();
                }
                else {
                    $error = "Error: " . $query . " returned " . $mysqli->error;
                    header("Location: ../index.php?result=createUserFailed");
                    exit;
                }
        

    }
?>