<?php

/**
 * Object for User class and its functions
 */
class Tack {

    const EMPTY_STRING = '';
    const DB_ID = "id";
    const DB_USER = "user_id";
    const DB_BOARD = "board_id";
    const DB_TITLE = "title";
    const DB_DESTRIPTION = "description";
    const DB_TACKURL = "tackUrl";
    const DB_IMAGE = "imageURL";
    const DB_CREATION = "creation_time";
    const DB_TITLE_LENGTH = 60;
    const DB_DESCRIPTION_LENGTH = 200;
    const DB_URL_LENGTH = 200;
    const DB_URL2_LENGTH = 200;

    private $id;
    private $user_id;
    private $board_id;
    private $title;
    private $description;
    private $tackURL;
    private $imageURL;
    private $creation_time;

    /**
     * Constructor function for a tack
     * @param type $user_id is the user_id of the creator
     * @param type $board_id is the board_id of the board it this tack will be tacked to
     * @param type $title is the title of the tack
     * @param type $description is the description of the tack
     * @param type $tackURL is the URL that will be tacked
     * @param type $imageURL is the URL of the image to represent the tack
     * @param type $id is the unique id of the tack
     * @param type $creation_time is the creation time of the tack
     */
    public function __construct($user_id, $board_id, $title, $description, $tackURL, $imageURL, $id = self::EMPTY_STRING, $creation_time = self::EMPTY_STRING) {
        $this->user_id = $user_id;
        $this->board_id = $board_id;
        $this->title = $title;
        $this->description = $description;
        $this->tackURL = $tackURL;
        $this->imageURL = $imageURL;
        $this->id = $id;
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

    /**
     * Function to create a Tack and save the data to the database
     * It escapes the input parameters and then builds a transaction to
     * update the database with a query
     */
    public static function createTack($userId, $boardID, $title, $description, $tackUrl, $imageUrl) {
        $db = new Database();
        $con = $db->getConnection();

        // escape inputs
        $userId = $con->real_escape_string($userId);
        $boardID = $con->real_escape_string($boardID);
        $title = $con->real_escape_string($title);
        $description = $con->real_escape_string($description);
        $tackUrl = $con->real_escape_string($tackUrl);
        $imageUrl = $con->real_escape_string($imageUrl);

        //build transaction
        $insertTack = "INSERT INTO `tackit`.`tack` (user_id, board_id, title, description, tackUrl, imageURL)
           VALUES ('$userId', '$boardID', '$title', '$description', '$tackUrl', '$imageUrl')";

        //submit query
        return $db->doQuery($insertTack);
    }

    /**
     * Function to get a Tack from a specified unique id
     * returns if found
     *  the tack with its creators user ID
     *  the board ID of the board it is originally tacked to
     *  the title and description of the board
     *  the URLs of the link tacked and the image representing the tack
     * if fails returns a NULL
     */
    public static function getTackFromID($id) {
        $db = new Database();
        $con = $db->getConnection();

        //escape input
        $id = $con->real_escape_string($id);
        if (($result = $db->doQuery("SELECT * FROM tackit.tack WHERE id = '$id'")) && ($row = $result->fetch_assoc())) {
            return new Tack($row[self::DB_USER], $row[self::DB_BOARD], $row[self::DB_TITLE], $row[self::DB_DESTRIPTION], $row[self::DB_TACKURL], $row[self::DB_IMAGE]);
        } else
            return NULL;
    }

    public static function getTackFromBoardId($boardId) {
        $db = new Database();

        //escape input
        $boardId = $db->real_escape_string($boardId);

        if (($result = $db->doQuery("SELECT * FROM `tackit`.`tack` WHERE board_id = $boardId")) !== FALSE) {
            return self::getTackFromResult($result);
        } else
            return NULL;
    }

    /**
     * Function to search through database for a tack
     * with a string in the description or title that matches the
     * $topic parameter
     */
    public static function searchTack($topic) {
        $db = new Database();
        $con = $db->getConnection();

        $topic = $con->real_escape_string($topic);

        $results = "SELECT * FROM `tackit`.`tack` WHERE MATCH (title, description) AGAINST ('$topic')";

        return $db->doQuery($results);
    }

    public static function getTackFromResult($result) {
        $tacks = array();
        while (($row = $result->fetch_assoc()) !== NULL) {
            $tacks[] = new Tack($row[self::DB_USER], $row[self::DB_BOARD],
                    $row[self::DB_TITLE], $row[self::DB_DESTRIPTION],
                    $row[self::DB_TACKURL], $row[self::DB_IMAGE],
                    $row[self::DB_ID], $row[self::DB_CREATION]);
        }
        $result->free();
        return $tacks;
    }

    public function getArray() {
        return array(
            self::DB_ID          => $this->get_id(),
            self::DB_USER        => $this->get_user_id(),
            self::DB_BOARD       => $this->get_board_id(),
            self::DB_TITLE       => $this->get_title(),
            self::DB_DESTRIPTION => $this->get_description(),
            self::DB_TACKURL     => $this->get_tackURL(),
            self::DB_IMAGE       => $this->get_imageURL()
        );
    }
}
?>