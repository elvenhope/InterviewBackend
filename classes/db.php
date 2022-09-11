<?php

require '../interfaces/dbRules.php';

$servername = "localhost";
$username = "root";
$password = "Codeforlife1!";
$dbName = "MainDB";

class Database implements ValidDB {
    private $conn;

    public function __construct(string $servername, string $username, string $password, string $dbName)
    {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbName = $dbName;
        $this->conn = new mysqli($servername, $username, $password, $dbName);
        if ($this->conn->connect_error) {
            return "Connection failed: " . $this->conn->connect_error;
        } else {
            return true;
        }
    }
    public function getData()
    {
        $sql = "SELECT * FROM products";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                array_push($rows, $row);
            }
            return $rows;
        } else {
            return "0 results";
        }
    }
    public function insertData(string $SKU, string $Name, string $Price, string $Properties) {
        //$sql = "INSERT INTO products(SKU,Name,Price,Properties) VALUES(" . $SKU . ',' . $Name . ',' . $Price . ',' . $Properties . ');';
        $stmt = $this->conn->prepare("INSERT INTO products (SKU,Name,Price,Properties) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssss', $SKU, $Name, $Price, $Properties);
        if($stmt->execute()) {
            return "Succesfully Added";
        } else {
            return "Error";
        }
    }
}

$database = new Database($servername, $username, $password, $dbName);