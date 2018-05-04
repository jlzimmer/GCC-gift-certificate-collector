<?php
    $server = "ec2-54-162-112-178.compute-1.amazonaws.com";
    $DBusername = "ec2user";
    $DBpassword = "Mizzou_CS3380_SP18";
    $dbname = "gift_card_collector";

    $mysqli = new mysqli($server, $DBusername, $DBpassword, $dbname);

    if ($mysqli->connect_error) {
        $_SESSION['userID'] = null;
        header("Location: ../index.php?result=failedSQLconnection");
        exit;
    }
?>
