<?php

namespace App;

class MySQLHandler {
    private $conn;

    public function __construct() {
        $config = include(__DIR__ . '/../config/database.php');
        $this->conn = new \mysqli($config['servername'], $config['username'], $config['password'], $config['database']);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function select($id) {
        $sql = "SELECT * FROM items WHERE id = $id";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    public function insert($data) {
        // Implement insertion logic here
    }

    public function update($id, $data) {
        // Implement update logic here
    }

    public function delete($id) {
        // Implement delete logic here
    }
}
