<?php
    if(!session_start()) {
        header("Location: ../index.php?result=badSession");
        exit;
    }

    $login = empty($_SESSION['userID']) ? false : $_SESSION['userID'];
	
	if ($login == false) {
        header("Location: ../index.php?result=sessionError");
		exit;
	}
    else {
        addCard();
    }

    function addCard() {
        $location = empty($_POST['location']) ? '' : $_POST['location'];
        $balance = empty($_POST['balance']) ? '' : $_POST['balance'];
        $serial = empty($_POST['serial']) ? null : $_POST['serial'];
        $expiration = empty($_POST['expiration']) ? null : $_POST['expiration'];

        if (empty($location) || empty($balance)) {
            $_SESSION['add'] = 2;
            header("Location: ../library.php?result=emptyField");
            exit;
        }

        require 'db.php';
        $mysqli = new mysqli($server, $DBusername, $DBpassword, $dbname);
            if ($mysqli->connect_error) {
                header("Location: ../index.php?result=failedSQLconnection");
                exit;
            }

        $location = $mysqli->real_escape_string($location);
        $balance = $mysqli->real_escape_string($balance);
        $balance = number_format($balance, 2, '.', '');
        $serial = $mysqli->real_escape_string($serial);
        $expiration = $mysqli->real_escape_string($expiration);
        $expiration = date('Y-m-d', strtotime(str_replace('-', '/', $expiration)));
        // https://stackoverflow.com/questions/6790930/convert-php-date-to-mysql-format

        $query = "INSERT INTO certificards (location, balance, serial, dateAdded, expiration, owner) VALUES ('$location', $balance, '$serial', NOW(), '$expiration', $login)";
        
        if ($mysqli->query($query) === true) {
            $_SESSION['add'] = 1;
            $result->free();
            $mysqli->close();
            $append = $_SESSION['user'];
            header("Location: ../library.php?result=loggedIn&user=$append");
            exit;
        }
        else {
            $_SESSION['add'] = 2;
            header("Location: ../library.php?result=SQLerrorContactAdmin");
            exit;
        }
    }
?>
