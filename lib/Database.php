<?php

/**
 * Database. Interface for connecting to and querying a remote MySQL database.
 *
 * @author David
 */
class Database {

    const HOST = '127.0.0.1';
    const USER = 'root';
    const PASS = NULL;
    const NAME = 'tackit';
    const PORT = 3306;
    const AUTOCOMMIT = TRUE;

    private $mysqli;

    public function __construct() {
        $this->mysqli = new mysqli('127.0.0.1', 'root', NULL, 'tackit', (integer) 3306);
        $this->checkConnection();
    }

    private function checkConnection() {
        if ($this->mysqli->connect_error)
            throw new Exception("Database connection error: " . $this->mysqli->connect_errno . " & " . $this->mysqli->connect_error);
    }

    public function getConnection() {
        return $this->mysqli;
    }

    public function doQuery($query) {
        if (is_string($query))
            return $this->mysqli->query($this->mysqli->real_escape_string($query));
    }

    public function doTransaction($queryArray) {
        if (is_array($queryArray)) {
            $this->mysqli->autocommit(FALSE);

            foreach ($queryArray as $value) {
                if (is_string($value))
                    $this->mysqli->query($this->mysqli->real_escape_string($value));
            }

            $this->mysqli->autocommit(AUTOCOMMIT);
        }
    }

}

?>