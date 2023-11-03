<?php

class DB {
    private $conn;
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'blogs';

    function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

        if ($this->conn->connect_error) {
            die("connection failed: " . $this->conn->connect_error);
        }
    }

    protected function insert($data, $table) {
        $columns = implode(', ', array_keys($data));
        $values = implode("', '", array_values($data));
        $query = "INSERT INTO $table ({$columns}) VALUES ({$values}')";
        $result = $this->conn->query($query);
        return $result;
    }

    protected function returnData($table) {

        $query = "SELECT * FROM $table";
        $result = $this->conn->query($query);
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data;
    }


}

?>