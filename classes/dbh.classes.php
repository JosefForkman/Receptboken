<?php
    class Dbh {
        // public function connect () {
        //     try {
        //         # Skapar variablar för DB
        //         $servername = "localhost";
        //         $username = "ReceptUser";
        //         $password = "ReceptPassword";
        //         $dbname = "ReceptDB";

        //         # Starar en PDO anslutning till DB
        //         $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        //         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //         return $conn;
        //     } catch (PDOException $e) {
        //         echo "MySQL misslyckades att ansluta sig: " . $e->getMessage();
        //         die();
        //     }
        // }

        # Skapar variablar för DB
        private $servername = "localhost";
        private $username = "ReceptUser";
        private $password = "ReceptPassword";
        private $dbname = "ReceptDB";
        final public function getConnectionPDO() {
            try {
                $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->conn = $conn;
                return $conn;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        public function getConnectionMySQL() {
            # Skapar variablar för DB
            $servername = "localhost";
            $username = "ReceptUser";
            $password = "ReceptPassword";
            $dbname = "ReceptDB";
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            return $conn;
        }
    }
?>
