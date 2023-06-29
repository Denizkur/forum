<?php

class DB {

    private $db;

    public function __construct() {
        $this->db = new mysqli('localhost', 'board', '1(CX(uUZ2Pw*maM_', 'board');
    }

    public function getDatabaseConnection() {
        return $this->db;
    }

    public function isAuth() {
        if (!isset($_SESSION['user'])) {
            header("Location: login.php");
        }
        $cookie = $_SESSION['user'];
        $this->db->query("SELECT * FROM user WHERE cookie = '$cookie'");
        if ($this->db->affected_rows < 1) {
            session_destroy();
            header("Location: login.php");
        }
    }

    public function whoisloggedin() {
        $cookie = $_SESSION['user'];
        $result = $this->db->query("SELECT * FROM user WHERE cookie = '$cookie'");
        $row = $result->fetch_assoc();
        return $row['username'];
    }

}