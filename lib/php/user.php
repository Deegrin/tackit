<?php

/**
 * Object for User class and its functions
 */
require_once 'Database.php';
require_once 'TackitMail.php';
require_once 'Relationship.php';

class User {

    const EMPTY_STRING = '';
    const DB_EMAIL = "email";
    const DB_USERNAME = "username";
    const DB_FIRSTNAME = "first_name";
    const DB_LASTNAME = "last_name";
    const DB_ID = "id";
    const DB_EMAIL_LENGTH = 200;
    const DB_USERNAME_LENGTH = 30;
    const DB_PASSWORD_LENGTH = 30;

    private $id;
    private $active;
    private $first_name;
    private $last_name;
    private $email;
    private $username;
    private $password;
    private $password_salt;
    private $creation_time;

    /**
     * Cnstructor function for users
     * @param type $email is email of user
     * @param type $userName the userName/alais of user
     * @param type $firstName the real given name of user
     * @param type $lastName te real family name of user
     */
    public function __construct($email, $userName, $firstName = self::EMPTY_STRING, $lastName = self::EMPTY_STRING, $id = self::EMPTY_STRING) {
        $this->email = $email;
        $this->username = $userName;
        $this->first_name = $firstName;
        $this->last_name = $lastName;
        $this->id = $id;
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

    /**
     * Function used when registering a user
     * takes the parameters and escapes them to instert them into an array of 
     * transactions to update the database.
     */
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
            VALUES ((SELECT id FROM tackit.user WHERE username = '$userName'), '', '', 0)";
        $insertBoard = "INSERT INTO `tackit`.`board` (user_id, private, title, description) 
            VALUES ((SELECT id FROM tackit.user WHERE username = '$userName'), 1, 'Dashboard', 'Default Board')";

        //submit query
        $transaction = array();
        $transaction[] = $insertUser;
        $transaction[] = $insertAccount;
        $transaction[] = $insertBoard;
        if ($db->doTransaction($transaction) === TRUE) {
            $user = self::getUserFromUserName($userName);
            return TackitMail::verifyRegistration($user);
        } else
            return false;
    }

    /*
     * Function to obtain a user of the username 
     * the user object has the email, username, firstname and last name
     */

    public static function getUserFromUserName($userName) {
        $db = new Database();
        $con = $db->getConnection();

        //escape input
        $userName = $con->real_escape_string($userName);
        if (($result = $db->doQuery("SELECT * FROM tackit.user WHERE username = '$userName'")) && ($row = $result->fetch_assoc())) {
            return new User($row[self::DB_EMAIL], $row[self::DB_USERNAME], $row[self::DB_FIRSTNAME], $row[self::DB_LASTNAME], $row[self::DB_ID]);
        }
        else
            return NULL;
    }

    /**
     * Gets an array of Users from a specified MySQL result set.
     * 
     * @param type $result MySQL result set
     * @return \Tack array of Tack objects
     */
    public static function getUserFromResult($result) {
        $users = array();
        while (($row = $result->fetch_assoc()) !== NULL) {
            $users[] = new User($row[self::DB_EMAIL], $row[self::DB_USERNAME], $row[self::DB_FIRSTNAME], $row[self::DB_LASTNAME], $row[self::DB_ID]);
        }
        $result->free();
        return $users;
    }

    public static function searchUser($topic) {
        $db = new Database();
        $con = $db->getConnection();

        $topic = $con->real_escape_string($topic);

        if (($results = $db->doQuery("SELECT * FROM `tackit`.`user` WHERE username = '$topic'")) !== FALSE) {
            return self::getUserFromResult($results);
        }
        else
            return NULL;
    }

    /**
     * Gets an array of Users associated with a specified UserID.
     * 
     * @param int $userID number
     * @return array array of User objects
     */
    public static function getUserFromUserID($userID) {
        $db = new Database();

        //escape input
        $userID = $db->real_escape_string($userID);

        if (($result = $db->doQuery("SELECT * FROM `tackit`.`user` WHERE id = $userID")) !== FALSE) {
            return self::getUserFromResult($result);
        } else
            return NULL;
    }

    public static function getUserFollowing($userId) {
        $db = new Database();

        $userId = $db->real_escape_string($userId);

        if (($result = $db->doQuery("SELECT * FROM `tackit`.`user` WHERE id IN
                (SELECT object_id FROM `tackit`.`relationship` WHERE user_id = $userId AND type = " . Relationship::TYPE_FOLLOW_USER . ")")) !== FALSE) {
            return self::getUserFromResult($result);
        } else
            return NULL;
    }

    /**
     * Gets an associative array representation of the Tack.
     * 
     * @return array array with keys: id, user_id, board_id, title, description, tackUrl, imageURL
     */
    public function getArray() {
        return array(
            self::DB_ID        => $this->get_id(),
            self::DB_USERNAME  => $this->get_username(),
            self::DB_FIRSTNAME => $this->get_first_name(),
            self::DB_LASTNAME  => $this->get_last_name()
        );
    }
}
?>