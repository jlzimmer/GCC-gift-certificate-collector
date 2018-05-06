<?php
    class Card {
        private $cardid;
        private $mysqli;

        function __construct($card) {
            $this->cardid = $card;

            require 'utilities/db.php';
            $this->mysqli = new mysqli($server, $DBusername, $DBpassword, $dbname);
                if ($this->mysqli->connect_error) {
                    header("Location: ../index.php?result=failedSQLconnection");
                    exit;
                }
        }

        function read() {
            $query = "SELECT * FROM transactions WHERE cardId = $this->cardid";
            $result = $this->mysqli->query($query);
            $data = array();
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        array_push($data, $row);
                    }
                }

            $table = '';
                foreach ($data as $trans) {
                    $id = $trans['id'];
                    $delta = $trans['balanceDelta'];
                    $date = $trans['date'];
                    $table .= "<tr><td>$id</td><td>$delta</td><td>$date</td></tr>
                    ";
                }

            return $table;
        }

        function update($delta) {
            $balance = $mysqli->query("SELECT balance FROM certificards WHERE id = $cardid");
            $newbalance = $balance - $delta;

            if ($newbalance <= 0) {
                $this->delete();
                $mysqli->close();
                header("Location: ../wallet.php?result=zeroBalance");
                exit();
            }

            if ($mysqli->query("UPDATE certificards SET balance = $newbalance WHERE id = $cardid") === true) {
                $mysqli->query("INSERT INTO transactions (cardId, balanceDelta, date) VALUES ($cardid, $delta, NOW())");
            }

            $this->read();
        }

        function delete() {
            $mysqli->query("DELETE FROM certificards WHERE id = $cardid");
            $mysqli->query("DELETE FROM transactions WHERE cardId = $cardid");

            $this->read();
        }
    }
?>
