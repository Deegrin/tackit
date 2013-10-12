<?php

require_once 'Database.php';

class User {

    const EMPTY_STRING = '';
    const DB_EMAIL = "email";
    const DB_USERNAME = "username";
    const DB_FIRSTNAME = "first_name";
    const DB_LASTNAME = "last_name";

    private $id;
    private $active;
    private $first_name;
    private $last_name;
    private $email;
    private $username;
    private $password;
    private $password_salt;
    private $creation_time;

    public function __construct($email, $userName, $firstName = self::EMPTY_STRING, $lastName = self::EMPTY_STRING) {
        $this->email = $email;
        $this->username = $userName;
        $this->first_name = $firstName;
        $this->last_name = $lastName;
    }

    public function set_id($new_id) {
        $this->id = $new_id;
    }

    public function set_active($new_active) {
        $this->active = $new_active;
    }

    public function set_first_name($new_first_name) {
        $this->first_name = $new_first_name;
    }

    public function set_last_name($new_last_name) {
        $this->last_name = $new_last_name;
    }

    public function set_email($new_email) {
        $this->email = $new_email;
    }

    public function set_username($new_username) {
        $this->username = $new_username;
    }

    public function set_password($new_password) {
        $this->password = $new_password;
    }

    public function set_password_salt($new_password_salt) {
        $this->password_salt = $new_password_salt;
    }

    public function set_creation_time($new_creation_time) {
        $this->creation_time = $new_creation_time;
    }

    public function get_id() {
        return $this->id;
    }

    public function get_active() {
        return $this->active;
    }

    public function get_first_name() {
        return $this->first_name;
    }

    public function get_last_name() {
        return $this->last_name;
    }

    public function get_email() {
        return $this->email;
    }

    public function get_username() {
        return $this->username;
    }

    public function get_password() {
        return $this->password;
    }

    public function get_password_salt() {
        return $this->password_salt;
    }

    public function get_creation_time() {
        return $this->creation_time;
    }

    public static function registerUser($email, $userName, $password, $firstName = self::EMPTY_STRING, $lastName = self::EMPTY_STRING) {
        $db = new Database();
        $con = $db->getConnection();

        // escape input
        $email = $con->real_escape_string($email);
        $userName = $con->real_escape_string($userName);
        $password = $con->real_escape_string($password);
        $firstName = $con->real_escape_string($firstName);
        $lastName = $con->real_escape_string($lastName);

        //build transaction
        $insertUser = "INSERT INTO `tackit`.`user` (active, email, username, password, password_salt, first_name, last_name) 
            VALUES (0, '$email', '$userName', '$password', '', '$firstName', '$lastName')";
        $insertAccount = "INSERT INTO `tackit`.`account` (user_id, profile_title, profile_description, setting_autoprivate) 
            VALUES ((SELECT id FROM tackit.user WHERE username = '$userName'), '', '', 1)";
        $insertBoard = "INSERT INTO `tackit`.`board` (user_id, private, title, description) 
            VALUES ((SELECT id FROM tackit.user WHERE username = '$userName'), 1, 'Dashboard', 'Default Board')";

        //submit query
        $transaction = array();
        $transaction[] = $insertUser;
        $transaction[] = $insertAccount;
        $transaction[] = $insertBoard;
        return $db->doTransaction($transaction);
    }

    public static function getUserFromUserName($userName) {
        $db = new Database();
        $con = $db->getConnection();

        //escape input
        $userName = $con->real_escape_string($userName);
        if (($result = $db->doQuery("SELECT * FROM tackit.user WHERE username = '$userName'")) && ($row = $result->fetch_assoc())) {
            return new User($row[self::DB_EMAIL], $row[self::DB_USERNAME], $row[self::DB_FIRSTNAME], $row[self::DB_LASTNAME]);
        }
        else
            return NULL;
    }
}
?>