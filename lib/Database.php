<?php

/**
 * Database. Interface for connecting to and querying a remote MySQL database.
 *
 * @author David
 */
class Database {

    const HOST = "206.253.164.146";
    const USER = "se165";
    const PASS = "sjsusoftware";
    const NAME = "tackit";
    const PORT = 3306;
    const AUTOCOMMIT = TRUE;
    const CHARSET = "utf8";

    private $mysqli;

    public function __construct() {
        $this->mysqli = new mysqli(self::HOST, self::USER, self::PASS, self::NAME, (integer) self::PORT);
        if ($this->mysqli->connect_error)
            throw new Exception("Database connection error: " . $this->mysqli->connect_errno . " & " . $this->mysqli->connect_error);
        $this->mysqli->set_charset(self::CHARSET);
    }

    public function getConnection() {
        return $this->mysqli;
    }

    public function doQuery($query) {
        if (is_string($query))
            return $this->mysqli->query($query);
        else
            return FALSE;
    }

    public function doTransaction($queryArray) {
        if (is_array($queryArray)) {
            $this->mysqli->autocommit(FALSE);
            $this->mysqli->commit();

            foreach ($queryArray as $value) {
                if (is_string($value)) {
                    if ($this->mysqli->query($value) === FALSE) {
                        $this->mysqli->rollback();
                        return $this->mysqli->error; //TODO test
                    }
                }
            }

            $this->mysqli->commit();
            $this->mysqli->autocommit(self::AUTOCOMMIT);
            return TRUE;
        } else
            return FALSE;
    }
}
?>