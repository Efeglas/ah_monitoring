<?php 

class ApiConnection {

    private $connectionMsg;
    private $errorMsg;
    private $conn;
    private $lastEffectedRowId;

    function __construct() {
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        
        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=ah_monitor", $username, $password);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connectionMsg = "Connected successfully";
        } catch(PDOException $e) {
            $this->connectionMsg = "Connection failed: " . $e->getMessage();
        }
    }

    function Close (){
        $this->conn = null;
    }

    function Select (string $sql) {
        $resultArray = [];
        try {
            
            $stmt =  $this->conn->prepare($sql);
            $stmt->execute();
          
            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultArray = $stmt->fetchAll();
            
          } catch(PDOException $e) {
            $this->errorMsg = "Error: " . $e->getMessage();
          }
          return $resultArray;
    }

    function Execute ($sql) {

        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);      
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $this->lastEffectedRowId = $this->conn->lastInsertId();
    }

    function LastInsertedId () {
        return $this->lastEffectedRowId;
    }

    function LastErrorMsg () {
        return $this->errorMsg;
    }

}



?>