<?php

class Database
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "egn_db";
    private $conn;

    function connect()
    {
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return null;
        }
    }

    function query($query, $params = array())
    {
        $conn = $this->connect();

        try {
            $stmt = $conn->prepare($query);
            $stmt->execute($params);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo "Query failed: " . $e->getMessage();
            return false;
        }
    }


    function save($query)
    {
        $conn = $this->connect();

        try {
            $stmt = $conn->exec($query);
            return true;
        } catch (PDOException $e) {
            echo "Save failed: " . $e->getMessage();
            return false;
        }
    }

    function update($query, $params = array())
    {
        $conn = $this->connect();

        try {
            $stmt = $conn->prepare($query);
            $stmt->execute($params);
            return true;
        } catch (PDOException $e) {
            echo "Update failed: " . $e->getMessage();
            return false;
        }
    }
}
