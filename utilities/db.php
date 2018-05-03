<?php
    $server = "ec2-54-162-112-178.compute-1.amazonaws.com";
    $username = "ec2user";
    $password = "Mizzou_CS3380_SP18";
    $dbname = "gift_card_collector";

    $mysqli = new mysqli($server, $username, $password, $dbname);

    if ($mysqli->connect_error) {
        $_SESSION['user'] = null;
        header("Location: ../index.php?result=failedSQLconnection");
        exit;
    }
?>
