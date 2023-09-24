<?php
    abstract class Dbh {
        private $servername;
        private $username;
        private $password;
        private $dbname;
        private $charset;

        protected function connect() {

            $this->severname = 'localhost';
            $this->username = 'root';
            $this->password = '';
            $this->dbname = 'hds';
            $this->charset = 'utf8mb4';

            try {

                $dsn = "mysql:host=".$this->severname.";dbname=".$this->dbname.";charset=".$this->charset;
                $pdo = new PDO($dsn, $this->username, $this->password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                return $pdo;

            } catch (PDOException $e) {

                echo "Connection faild: ".$e->getMessage();

            }

            
        }
    }