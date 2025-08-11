<?php
class DbConnection
{
    private $conn;

    public function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "offers_ng";

        try {
            // Create connection
            $this->conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection failed' . $e->getMessage();
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }

    public function closeConnection()
    {
        $this->conn = null;
    }
}


