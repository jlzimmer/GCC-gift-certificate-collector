<?php
    // SQL statement constructors for CRUD operations on individual cards (transactions table)
    class card {
        public $statement;
        public $mysqli;
        private $userid;
        private $cardid;

        function __construct($dbconn, $user, $card) {
            $this->statement = null;
            $this->mysqli = $dbconn;
            $this->userid = $user;
            $this->cardid = $card;
        }

        function read() {

        }

        function update()

        function delete()
    }
?>
