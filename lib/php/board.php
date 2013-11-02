<?php

/**
 * Object for Board class and its functions.
 */
class Board {
    /**
     * List of constants
     */

    const EMPTY_STRING = '';
    const DB_USER = "user_id";
    const DB_PRIV = "private";
    const DB_TITLE = "title";
    const DB_DESTRIPTION = "description";
    const DB_CREATION = "creation_time";
    const DB_TITLE_LENGTH = 60;
    const DB_DESCRIPTION_LENGTH = 200;
    const DB_PRIVATE_LENGTH = 1;

    /**
     * List of Variables
     */
    private $id;
    private $user_id;
    private $priv;
    private $title;
    private $description;
    private $creation_time;

    /**
     * Constructor for a Board
     * @param type $priv hold private status
     * @param type $title is the title of the board
     * @param type $description the description of the board
     * @param type $user_id is the user_id of the creator of the Board
     * @param type $creation_time is the time the board was created
     */
    public function __construct($priv, $title, $description, $user_id = self::EMPTY_STRING, $creation_time = self::EMPTY_STRING) {
        $this->priv = $priv;
        $this->user_id = $user_id;
        $this->title = $title;
        $this->description = $description;
        $this->creation_time = $creation_time;
    }

    /**
     * Function to set the id of the board to a new one
     */
    public function set_id($new_id) {
        $this->id = $new_id;
    }

    /**
     * Function to set the user_id of the board to a new one
     */
    public function set_user_id($new_user_id) {
        $this->user_id = $new_user_id;
    }

    /**
     * Function to set the private status of the board to a new one
     */
    public function set_private($new_private) {
        $this->priv = $new_private;
    }

    /**
     * Function to set the title of the board to a new one
     */
    public function set_title($new_title) {
        $this->title = $new_title;
    }

    /**
     * Function to set the description of the board to a new one
     */
    public function set_description($new_description) {
        $this->description = $new_description;
    }

    /**
     * Function to set the creation time of the board to a new one
     */
    public function set_creation_time($new_creation_time) {
        $this->creation_time = $new_creation_time;
    }

    /**
     * Function to get the id of the board
     */
    public function get_id() {
        return $this->id;
    }

    /**
     * Function to get the user_id of the board
     */
    public function get_user_id() {
        return $this->user_id;
    }

    /**
     * Function to get the private status of the board
     */
    public function get_private() {
        return $this->priv;
    }

    /**
     * Function to get the title of the board
     */
    public function get_title() {
        return $this->title;
    }

    /**
     * Function to get the description of the board
     */
    public function get_description() {
        return $this->description;
    }

    /**
     * Function to get the creation time of the board
     */
    public function get_creation_time() {
        return $this->creation_time;
    }

    /**
     * Function to create a board in the database
     * requires:
     *  the userID obtained from the creator
     *  private status set by creator
     *  title and description desired by creator
     */
    public static function createBoard($userID, $priv, $title, $description) {
        $db = new Database();
        $con = $db->getConnection();

        // escape inputs
        $userID = $con->real_escape_string($userID);
        $priv = $con->real_escape_string($priv);
        $title = $con->real_escape_string($title);
        $description = $con->real_escape_string($description);

        //build transaction
        $insertBoard = "INSERT INTO `tackit`.`board` (user_id, private, title, description)
            VALUES ('$userID',$priv,'$title','$description')";

        //submit query
        return $db->doQuery($insertBoard);
    }

    /**
     * Gets an array of Board ids that belong to the specified User.
     * 
     * @param int $userid id number
     * @return null enumerated array of board ids if successful, NULL otherwise
     */
    public static function getBoardFromUserId($userid) {
        $db = new Database();
        $con = $db->getConnection();

        //escape input
        $userid = $con->real_escape_string($userid);

        //query
        if (($result = $db->doQuery("SELECT id FROM `tackit`.`board` WHERE user_id = $userid")) !== FALSE) {
            //build array from return
            $array = array();
            while (($row = $result->fetch_array()) !== NULL) {
                $array[] = $row[0];
            }

            $result->free();
            return $array;
        }
        else
            return NULL;
    }

    /**
     * 
     * Function to get a single board from the database
     * if board exists, with its private status, title and description
     * if fails, returns null
     */
    public static function getBoardFromID($id) {
        $db = new Database();
        $con = $db->getConnection();

        //escape input
        $id = $con->real_escape_string($id);

        if (($result = $db->doQuery("SELECT * FROM tackit.board WHERE id = '$id'")) && ($row = $result->fetch_assoc())) {
            return new Board($row[self::DB_PRIV], $row[self::DB_TITLE], $row[self::DB_DESTRIPTION], $row[self::DB_USER]);
        }
        else
            return NULL;
    }

    /**
     * Function to search through database for a board
     * with a string in the description or title that matches the
     * $topic parameter
     */
    public static function searchBoard($topic) {
        $db = new Database();
        $con = $db->getConnection();

        //escape input
        $topic = $con->real_escape_string($topic);

        $results = "SELECT * FROM `tackit`.`board` WHERE MATCH (title, description) AGAINST ('$topic')";

        return $db->doQuery($results);
    }

    /**
     * Gets an array of Tacks from a specified MySQL result set.
     * 
     * @param type $result MySQL result set
     * @return \Tack array of Tack objects
     */
    public static function getBoardFromResult($result) {
        $boards = array();
        while (($row = $result->fetch_assoc()) !== NULL) {
            $boards[] = new Board($row[self::DB_PRIV], $row[self::DB_TITLE], $row[self::DB_DESTRIPTION], $row[self::DB_USER], $row[self::DB_CREATION]);
        }
        $result->free();
        return $boards;
    }

    
     /**
     * Gets an array of Boards associated with a specified Board Private Status.
     * 
     * @param int $priv number
     * @return array array of board objects
     */
    public static function getBoardFromBoardPriv($priv) {
        $db = new Database();

        //escape input
        $priv = $db->real_escape_string($priv);

        if (($result = $db->doQuery("SELECT * FROM `tackit`.`board` WHERE private = $priv")) !== FALSE) {
            return self::getBoardFromResult($result);
        } else
            return NULL;
    }
}

?>