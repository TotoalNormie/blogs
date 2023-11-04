<?php

class DB
{
    private $conn;
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'blogs';

    function __construct()
    {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

        if ($this->conn->connect_error) {
            die("connection failed: " . $this->conn->connect_error);
        }
    }

    protected function insert($data, $table)
    {
        $columns = implode(', ', array_keys($data));
        $values = implode("', '", array_values($data));
        $query = "INSERT INTO $table ({$columns}) VALUES ('{$values}')";
        $result = $this->conn->query($query);
        if ($result == 1)
            return;
        return $result;
    }
    protected function insertWithCondition($data, $table, $clause, $condition)
    {
        $columns = implode(', ', array_keys($data));
        $values = implode("', '", array_values($data));
        $clause = strtoupper($clause);
        $query = "INSERT INTO $table ({$columns}) VALUES ('{$values}') $clause = $condition";
        $result = $this->conn->query($query);
        if ($result == 1)
            return;
        return $result;
    }
    protected function update($data, $table, $id)
    {
        if (empty($data) || !$data)
            return "error updating";
        $sqlArray = [];
        foreach ($data as $key => $value)
            $sqlArray[] = "`$key` = '$value'";
        $dataString = implode(", ", $sqlArray);
        $query = "UPDATE $table SET $dataString WHERE id = $id";
        $result = $this->conn->query($query);
        if ($result == 1)
            return;
        return $result;
    }

    protected function returnData($table)
    {

        $query = "SELECT * FROM $table";
        $result = $this->conn->query($query);
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data;
    }

    function delete($table, $id) {
        $query = "DELETE FROM $table WHERE id=$id";
        $result = $this->conn->query($query);
        if ($result == 1)
            return;
        return $result;
    }

}

?>