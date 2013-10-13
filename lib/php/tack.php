<?php

class Tack {

    const EMPTY_STRING = '';
    const DB_USER = "user_id";
    const DB_BOARD = "board_id";
    const DB_TITLE = "title";
    const DB_DESTRIPTION = "description";
    const DB_TACKURL = "tackUrl";
    const DB_IMAGE = "imageURL";

    private $id;
    private $user_id;
    private $board_id;
    private $title;
    private $description;
    private $tackURL;
    private $imageURL;
    private $creation_time;

    public function __construct($user_id, $board_id, $title, $description, $tackURL, $imageURL, $id = self::EMPTY_STRING, $creation_time = self::EMPTY_STRING) {
        $this->user_id = $user_id;
        $this->board_id = $board_id;
        $this->title = $title;
        $this->description = $description;
        $this->tackURL = $tackURL;
        $this->imageURL = $imageURL;
        $this->id= $id;
        $this->creation_time = $creation_time;
    }

    public function set_id($new_id) {
        $this->id = $new_id;
    }

    public function set_user_id($new_user_id) {
        $this->user_id = $new_user_id;
    }

    public function set_board_id($new_board_id) {
        $this->board_id = $new_board_id;
    }

    public function set_title($new_title) {
        $this->title = $new_title;
    }

    public function set_description($new_description) {
        $this->description = $new_description;
    }

    public function set_tackURL($new_tackURL) {
        $this->tackURL = $new_tackURL;
    }

    public function set_imageURL($new_imageURL) {
        $this->imageURL = $new_imageURL;
    }

    public function set_creation_time($new_creation_time) {
        $this->creation_time = $new_creation_time;
    }

    public function get_id() {
        return $this->id;
    }

    public function get_user_id() {
        return $this->user_id;
    }

    public function get_board_id() {
        return $this->board_id;
    }

    public function get_title() {
        return $this->title;
    }

    public function get_description() {
        return $this->description;
    }

    public function get_tackURL() {
        return $this->tackURL;
    }

    public function get_imageURL() {
        return $this->imageURL;
    }

    public function get_creation_time() {
        return $this->creation_time;
    }

    public static function createTack($userId, $boardID, $title, $description, $tackUrl, $imageUrl, $creationTime) {
        $db = new Database();
        $con = $db->getConnection();

        // escape inputs
        $userId = $con->real_escape_string($userId);
        $boardID = $con->real_escape_string($boardID);
        $title = $con->real_escape_string($title);
        $description = $con->real_escape_string($description);
        $tackUrl = $con->real_escape_string($tackUrl);
        $imageUrl = $con->real_escape_string($imageUrl);
        $creationTime = $con->real_escape_string($creationTime);

        //build transaction
        $insertTack = "INSERT INTO `tackit`.`tack` (user_id, board_id, title, description, tackUrl, imageURL)
           VALUES ('$userId', '$boardID', '$title', '$description', '$tackUrl', '$imageUrl')";

        //submit query
        return $db->doQuery($insertTack);
    }

    public static function getTackFromID($id) {
        $db = new Database();
        $con = $db->getConnection();

        //escape input
        $id = $con->real_escape_string($id);
        if (($result = $db->doQuery("SELECT * FROM tackit.tack WHERE id = '$id'")) && ($row = $result->fetch_assoc())) {
            return new Tack($row[self::DB_USER], $row[self::DB_BOARD], $row[self::DB_TITLE], $row[self::DB_DESTRIPTION], $row[self::DB_TACKURL], $row[self::DB_IMAGE]);
        }
        else
            return NULL;
    }

}

?>