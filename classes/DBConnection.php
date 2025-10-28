<?php

class DBConnection {
    protected $host;
    protected $username;
    protected $password;
     protected $database;
    public $conn;

    public function __construct(){
       $this->host = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->database = "geet";

        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
        if ($this->conn->connect_error) {
            die("Database Connection Failed: " . $this->conn->connect_error);
        }
    }

    public function __destruct() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>
