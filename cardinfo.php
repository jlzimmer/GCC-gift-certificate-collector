<?php 
    require 'utilities/navbar.php';
    require 'functions/transactions.php';

    $userid = $_SESSION['userID'];
    $user = $_SESSION['user'];
    $cardid = $_POST['cardID']
?>
        <div class="container" id="wrapper">
            <div class="jumbotron">
                <?php
                    $login = empty($_SESSION['userID']) ? false : true;

                    if ($login) {
                        echo '<h2 class="lobster">Transaction history for card #' . $cardid . '</h2></div>';
                    }
                    else {
                        echo '<h2 class="lobster">You are NOT logged in. Please select log in or sign up from the navigation bar.</h2></div>';
                        exit;
                    }
                ?>
            <div class="table-responsive-lg">
                <table class="table">
                    <tr class="raleway">
                        <th>Transaction ID</th>
                        <th>Δ Balance</th>
                        <th>Date/Time</th>
                    </tr>
                    <?php
                        $card = new Card($cardid);
                        $table = $card->read();

                        echo $table;
                    ?>
                </table>
            </div>
        </div>
    </body>
</html>