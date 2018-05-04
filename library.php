<?php 
    require 'utilities/navbar.php';

    if(!session_start()) {
        header("Location: ../index.php?result=badSession");
		exit;
	}

    $id = $_SESSION['userID'];
        if (empty($id)) {
            header("Location: ../index.php?result=sessionError");
        }

    $sql = "SELECT * FROM certificards WHERE owner = '$id'";
    $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                array_push($wallet, $row);
            }
        }
        
        $table = "<table><tr><th>Location</th><th>Balance</th><th>Expiration</th><th>Serial</th><th>Update Balance</th><th>View Transactions</th></tr>";
        foreach ($wallet as $card) {
            $id = $card['id'];
            $location = $card['location'];
            $balance = $card['balance'];
            $serial = $card['serialnumber'];
            $expiration = $card['expiration'];
            $table .= "<tr><td>$location</td><td>$balance</td><td>$expiration</td><td>$serial</td><td><input id='update' type='button' value='Update'/></td><td><input id='view' type='button' value='View'/></td></tr>";
        }
    $table .= "</table>";
?>

        <h1 class="lobster">Wallet for <?php echo $user?></h1> 

        <?php
            echo $table;
        ?>
        
        <!-- jQuery, Popper.js, Boostrap 4.0 JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>
