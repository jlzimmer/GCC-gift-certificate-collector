
        <?php 
            include_once("utilities/navbar.php");
            require ("utilities/db.php");
            $mysqli = mysqli_connect($server, "$username", "$password", "$dbname")or die("cannot connect");

            $sql = "SELECT * FROM cards";
            $result = $mysqli->query($sql);
            $cards = array();
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        array_push($cards, $row);
                    }
                }
                
                $table = "<table><tr><th>Location</th><th>Balance</th><th>Expiration</th><th>Serial</th><th>Update Balance</th><th>View Transactions</th></tr>";
                foreach ($cards as $card) {
                    $id = $card['id'];
                    $location = $card['location'];
                    $balance = $card['balance'];
                    $serial = $card['serialnumber'];
                    $expiration = $card['expiration'];
                    $table .= "<tr><td>$location</td><td>$balance</td><td>$expiration</td><td>$serial</td><td><input id='update' type='button' value='Update'/></td><td><input id='view' type='button' value='View'/></td></tr>";
                }
            $table .= "</table>";
        ?>


    <h1>Gift Cards for <?php echo $user?></h1> 

    <?php
    echo $table;
    ?>

    </table>

    </body>
</html>
