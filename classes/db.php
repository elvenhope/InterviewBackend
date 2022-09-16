<?php

require '../interfaces/dbRules.php';
/*
    These are the paramaters for the database, I am aware that it's not the best practice
    to encode them in code like this. I am aware I could have done this in .env variable.
    however I thought about it and I thought it would be more simple and clear for such a task
    and for you to review if I just skipped pointless logistics.
*/
$servername = "localhost";
$username = "id17454485_root";
$password = "foW5VLl{G1~%4^qw";
$dbName = "id17454485_mydb";

//Declare Database with ValidDb Interface
class Database implements ValidDB
{
    private $conn;

    //Initialize the conn variable when a database is being created.
    public function __construct(string $servername, string $username, string $password, string $dbName)
    {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbName = $dbName;
        $this->conn = new mysqli($servername, $username, $password, $dbName);
        if ($this->conn->connect_error) {
            echo "Connection failed: " . $this->conn->connect_error;
        } else {
            return true;
        }
    }
    //Get Data from the Products table
    public function getData()
    {
        //We don't need to protect from sql Injection here as it doesn't interact with outside variables
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
    //Insert Data in the database using the given parameters
    public function insertData(string $SKU, string $Name, string $Price, string $Properties)
    {
        //Protecting against SQL Injection
        $stmt = $this->conn->prepare("INSERT INTO products (SKU,Name,Price,Properties) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssss', $SKU, $Name, $Price, $Properties);
        if ($stmt->execute()) {
            return "Succesfully Added";
        } else {
            return "Error";
        }
    }
    //Delete the selected ID row
    public function deleteData(array $idArray)
    {
        foreach ($idArray as $key => $value) {
            //Protecting against SQL Injection
            $stmt = $this->conn->prepare("DELETE FROM products WHERE id=?");
            $stmt->bind_param('s', $value);
            if ($stmt->execute()) {
                //All is good;
            } else {
                return "Error at" . $value;
            }
        }
        return "Succesfully Deleted";
    }
    public function selectBySKU(string $id)
    {
        //Protecting against SQL Injection
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE SKU=?");
        $stmt->bind_param('s', $id);
        $result = $stmt->execute();
        if ($result) {
            $QueryResult = $stmt->get_result();
            $rows = array();
            if ($QueryResult->num_rows > 0) {
                // output data of each row
                while ($row = $QueryResult->fetch_assoc()) {
                    array_push($rows, $row);
                }
                return $rows;
            } else {
                return $rows;
            }
        } else {
            return "Error!";
        }
    }
}
// Declare a new database
$database = new Database($servername, $username, $password, $dbName);
