<?php
    declare(strict_types=1);

    class User{
        // protected $pdo;

        // public function __construct() {

        //     try {
        //         # Skapar variablar för DB
        //         $servername = "localhost";
        //         $dbUsername = "ReceptUser";
        //         $dbPassword = "ReceptPassword";
        //         $dbName = "ReceptDB";

        //         # Skapar anslutning till DB
        //         $this->pdo = new PDO("mysql:host=$servername;dbname=$dbName", $dbUsername, $dbPassword);;

        //     } catch(PDOException $e) {
        //         echo "Connection failed: " . $e->getMessage();
        //     }
        // }

        # Registrera User
        protected function insertUser(string $name, string $password, string $passwordAgain, string $Mail) {
            # Kollar om lösenorden matchar varandra
            if ($password != $passwordAgain) {
                header('location: ../../Registrera.php?error=passwordNotMatch');
                exit();
            }

            # Kollar om lösenorden matchar varandra
            if ($password != $passwordAgain) {
                header('location: ../../Registrera.php?error=passwordNotMatch');
                exit();
            }

            # hash lösenord
            ## https://www.php.net/manual/en/function.password-hash.php
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);

            # Gör en prepared statement
            ## Kollade in w3schools om prepared statement https://www.w3schools.com/php/php_mysql_prepared_statements.asp
            $stmt = $this->pdo->prepare("INSERT INTO User (mail, password, name) VALUES (?, ?, ?)");

            $stmt->bind_param("sss", strtolower($Mail), $hashPassword, $name);

            # $stmt->execute() return true / false
            if ( !$stmt->execute() ) {
                $stmt = null;
                header('location: ../../Registrera.php?error=stmtMisslyckades');
                exit();
            }
        }

        # Login User
        protected function getUser(string $Password, string $Mail) {
            # Gör en prepared statement
            ## Kollade in w3schools om prepared statement https://www.w3schools.com/php/php_mysql_prepared_statements.asp
            $conn = $this->connect();
            $stmt = $conn->prepare("SELECT * FROM User Where mail = :yo");
            // $Mail = strtolower($Mail);
            // $stmt->bind_param("s", $Mail);
            $Mail = 'strand.vatten@outlook.com';
            $stmt->bindParam(":yo", $Mail);

            # $stmt->execute() return true / false
            if ( !$stmt->execute() ) {
                $stmt = null;
                header('location: ../../LogaIn.php?error=stmtMisslyckades');
                exit();
            }

            # Hämtar användare
            // $result = $stmt->get_result();
            // $user = $result->fetch_assoc();
            $user = $stmt->fetch(pdo::FETCH_ASSOC);

            // echo "<pre>";
            // var_dump($user);
            // echo "</pre>";

            # kontrollera Password (true om match annars false)
            $checkPassword = password_verify($Password, $user['password']);

            if ($checkPassword) {
               # Startar session och lägger till användare i session
               session_start();
               $_SESSION["AnvändareId"] = $user['id'];
               $_SESSION["AnvändareNamn"] = $user['name'];

               # Nollställer $conn variabeln
               $conn = null;
            } else {
                header('location: ../../LogaIn.php?error=FelLösenord');

                # Nollställer $conn variabeln och avslutar koden
                $conn = null;
                exit();
            }
            $conn = null;
        }

        # Kollar om det finna en användare med specifik mail
        protected function kontrolleraAnvändare($Mail) {
            $conn = $this->connect();

            $stmt = $conn->prepare("SELECT id FROM User WHERE Mail = :mail;");
            // $stmt->bind_param("s", $Mail);
            $stmt->bindParam(":mail", $Mail);

            # $stmt->execute() return true / false
            if (!$stmt->execute()) {
                $stmt->close();

                header('location: ../../Registrera.php?error=stmtMisslyckades');
                exit();
            }

            # Hämtar användare
            $user = $stmt->fetch(pdo::FETCH_ASSOC);
            return count($user) > 0 ? false : true;

            $conn = null;
        }

        # Anslut till DB
        // public function connect () {
        //     # Skapar variablar för DB
        //     $servername = "localhost";
        //     $dbUsername = "ReceptUser";
        //     $dbPassword = "ReceptPassword";
        //     $dbName = "ReceptDB";

        //     # Skapar anslutning till DB
        //     $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

        //     // Check connection
        //     if ($conn->connect_error) {
        //         die("Connection failed: " . $conn->connect_error);
        //     }

        //     $this->pdo = $conn;
        // }
        public function connect () {
            try {
                # Skapar variablar för DB
                $servername = "localhost";
                $dbUsername = "ReceptUser";
                $dbPassword = "ReceptPassword";
                $dbName = "ReceptDB";

                # Skapar anslutning till DB
                return new PDO("mysql:host=$servername;dbname=$dbName", $dbUsername, $dbPassword);;

            } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
    }
?>
