<?php
	if(!session_start()) {
		header("Location: ../index.php?result=badSession");
		exit;
	}
	
	$login = empty($_SESSION['user']) ? false : $_SESSION['user'];
	
	if ($login) {
        header("Location: ../library.php?result=loggedIn&user=" . $login);
		exit;
	}

    else {
        handle_login();
    }
	
    function handle_login() 
    {        
        $username = empty($_POST['Username']) ? '' : $_POST['Username'];
        $password = empty($_POST['Password']) ? '' : $_POST['Password'];

            if (empty($username) || empty($password))
            {
                header("Location: ../index.php?result=emptyField");
                exit;
            }
        
        require_once 'db.php';

        $username = $mysqli->real_escape_string($username);
        $password = $mysqli->real_escape_string($password);
        $password = password_hash($password, PASSWORD_DEFAULT);
        
		$query = "SELECT * FROM Users WHERE name = '$username' AND password = '$password'";
		$result = $mysqli->query($query);
		
        if ($result) {
            $match = $result->num_rows;

  		    if ($match == 1) {
                $row = $result->fetch_assoc();
                $_SESSION['login'] = $username;
                $_SESSION['userID'] = $row['id'];
                header("Location: ../index.php?result=loggedIn");
                exit;
            }

            else {
                $error = 'Error: Incorrect username or password';
                header("Location: ../index.php?result=badInfo");
                exit;
            }
        }

        else {
            $error = 'Login Error: Please contact the system administrator.';
            header("Location: ../index.php?result=loginError");
            exit;
        }
    }

/* signup.php

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
        $password = sha1($password);

        $query = "SELECT * FROM UserPassStore WHERE UserID = '$username'";
		$mysqliResult = $mysqli->query($query);
		
        if ($mysqliResult) {
            $match = $mysqliResult->num_rows;

  		    if ($match == 0) {
                $query = "INSERT INTO UserPassStore (UserID, Passwd) VALUES ($username, $password);";
                
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

            else {
                $mysqli->close();

                $error = 'Error: Username already exists';
                header("Location: ../index.php?result=userExists");
                exit;
            }
        }

        else {
            $error = 'Login Error: Please contact the system administrator.';
            header("Location: ../index.php?result=loginError");
            exit;
        }
    }

*/
?>
