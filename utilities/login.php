<?php
	if(!session_start()) {
		header("Location: ../index.php?result=badSession");
		exit;
	}
	
	$login = empty($_SESSION['userID']) ? false : $_SESSION['userID'];
	
	if ($login) {
        header("Location: ../library.php?result=loggedIn");
		exit;
	}

    else {
        handle_login();
    }
	
    function handle_login() {        
        $username = empty($_POST['Username']) ? '' : $_POST['Username'];
        $password = empty($_POST['Password']) ? '' : $_POST['Password'];

            if (empty($username) || empty($password)) {
                header("Location: ../index.php?result=emptyField");
                exit;
            }
        
        require 'db.php';

        $username = $mysqli->real_escape_string($username);
        $password = $mysqli->real_escape_string($password);
        $password = password_hash($password, PASSWORD_DEFAULT);
        
		$query = "SELECT * FROM Users WHERE name = '$username' AND password = '$password'";
		$result = $mysqli->query($query);
		
        if ($result) {
            $match = $result->num_rows;

  		    if ($match == 1) {
                session_start();
                $row = $result->fetch_assoc();
                $_SESSION['userID'] = $row['id'];
                header("Location: ../library.php?result=loggedIn");
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
?>
