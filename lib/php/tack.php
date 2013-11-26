<?php

require_once 'Relationship.php';
require_once 'User.php';

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
    const USER_NAME = "user_name";

    private $id;
    private $user_id;
    private $user_data;
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
        $this->user_data = NULL;
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

    public function set_user_data($user) {
        $this->user_data = $user;
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

    public function get_user_data() {
        return $this->user_data;
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

    public static function deleteTack($id) {
        $db = new Database();

        $id = $db->real_escape_string($id);

        //build transaction
        $deleteTack = "DELETE FROM `tackit`.`tack` WHERE id = $id";
        $deleteRelationship = "DELETE FROM `tackit`.`relationship` WHERE (type = " . Relationship::TYPE_FAVORITE_TACK . " OR type = " . Relationship::TYPE_RETACK_TACK . ") AND object_id = $id";
        $transaction = array($deleteTack, $deleteRelationship);

        return $db->doTransaction($transaction);
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
    public static function getTackFromID($id, $userId = NULL) {
        $db = new Database();
        $con = $db->getConnection();

        //escape input
        $id = $con->real_escape_string($id);

        $query = "SELECT * FROM tackit.tack WHERE id = '$id'";
        if ($userId !== NULL) {
            $userId = $db->real_escape_string($userId);
            $query .= " AND user_id = $userId";
        }
        if (($result = $db->doQuery($query)) && ($row = $result->fetch_assoc())) {
            return new Tack($row[self::DB_USER], $row[self::DB_BOARD], $row[self::DB_TITLE], $row[self::DB_DESTRIPTION], $row[self::DB_TACKURL], $row[self::DB_IMAGE], $row[self::DB_ID]);
        } else
            return NULL;
    }

    /**
     * Gets an array of Tacks associated with a specified Board id.
     * 
     * @param int $boardId id number
     * @return array array of Tack objects
     */
    public static function getTackFromBoardId($boardId) {
        $db = new Database();

        //escape input
        $boardId = $db->real_escape_string($boardId);

        if (($result = $db->doQuery("SELECT * FROM `tackit`.`tack` WHERE board_id = $boardId ORDER BY id DESC")) !== FALSE) {
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

        if (($results = $db->doQuery("SELECT * FROM `tackit`.`tack` WHERE MATCH (title, description) AGAINST ('$topic')")) !== FALSE) {
            return self::getTackFromResult($results, TRUE);
        } else
            return NULL;
    }

    /**
     * Gets an array of Tacks from a specified MySQL result set.
     * 
     * @param type $result MySQL result set
     * @return \Tack array of Tack objects
     */
    public static function getTackFromResult($result, $getUser = FALSE) {
        if ($getUser === TRUE)
            $db = new Database();

        $tacks = array();
        while (($row = $result->fetch_assoc()) !== NULL) {
            $tack = new Tack($row[self::DB_USER], $row[self::DB_BOARD], $row[self::DB_TITLE], $row[self::DB_DESTRIPTION], $row[self::DB_TACKURL], $row[self::DB_IMAGE], $row[self::DB_ID], $row[self::DB_CREATION]);
            //if extra user data is requested
            if ($getUser === TRUE) {
                $userQuery = "SELECT * FROM `tackit`.`user` WHERE id = " . $row[self::DB_USER];
                if (($results = $db->doQuery($userQuery)) !== FALSE) {
                    $user = User::getUserFromResult($results)[0]; //getUserFromResults returns an array
                    $tack->set_user_data($user);
                }
            }
            $tacks[] = $tack;
        }
        $result->free();
        return $tacks;
    }

    /**
     * Function to allow retacking function 
     * by creating a whole new tack for the user
     * takes in retacker's userID and the tack of interest
     * Then copies the infor under the new users ID and saves it into the DB
     */
    public static function retack($userID, $boardID, $tack) {
        $db = new Database();
        $con = $db->getConnection();

        // escape inputs
        $userID = $con->real_escape_string($userID);
        $boardID = $con->real_escape_string($boardID);
        $tack->set_title($con->real_escape_string($tack->get_title()));
        $tack->set_description($con->real_escape_string($tack->get_description()));
        $tack->set_tackUrl($con->real_escape_string($tack->get_tackUrl()));
        $tack->set_imageUrl($con->real_escape_string($tack->get_imageUrl()));

        //build transaction
        $insertTack = "INSERT INTO `tackit`.`tack` (user_id, board_id, title, description, tackUrl, imageURL)
           VALUES ('$userID', '$boardID', '" . $tack->get_title() . "', '" . $tack->get_description() . "', '" . $tack->get_tackUrl() . "', '" . $tack->get_imageUrl() . "')";
        $relationship = "INSERT INTO `tackit`.`relationship` (user_id, type, object_id) VALUES ($userID, " . Relationship::TYPE_RETACK_TACK . ", " . $tack->get_id() . ")";
        $queryArray = array($insertTack, $relationship);

        //submit query
        return $db->doTransaction($queryArray);
    }

    public static function getTackFeed($userID) {
        $db = new Database();
        $con = $db->getConnection();

        // escape inputs
        $userID = $con->real_escape_string($userID);

        if (($results = $db->doQuery("SELECT * FROM `tackit`.`tack` WHERE board_id IN
            (SELECT object_id FROM `tackit`.`relationship` WHERE type = " . Relationship::TYPE_FOLLOW_BOARD . " and user_id = $userID) ORDER BY id DESC")) !== FALSE)
            return self::getTackFromResult($results, TRUE);
        else
            return NULL;
    }

    public static function getTackFavorite($userId) {
        $db = new Database();

        $userId = $db->real_escape_string($userId);

        if (($result = $db->doQuery("SELECT * FROM `tackit`.`tack` WHERE id IN
            (SELECT object_id FROM `tackit`.`relationship` WHERE user_id = $userId AND type = " . Relationship::TYPE_FAVORITE_TACK . ") ORDER BY id DESC")) !== FALSE)
            return self::getTackFromResult($result, TRUE);
        else
            return NULL;
    }
    
    public function edit() {
        $db = new Database();

        $query = "UPDATE `tackit`.`tack` SET";

        if (($this->board_id === NULL) && ($this->title === NULL) &&
                ($this->description === NULL) && ($this->tackURL === NULL) &&
                ($this->imageURL === NULL))
            return false;

        if ($this->board_id !== NULL) {
            $db->real_escape_string($this->board_id);
            $query.=" board_id = $this->board_id,";
        }

        if ($this->title !== NULL) {
            $db->real_escape_string($this->title);
            $query.=" title = '$this->title',";
        }

        if ($this->description !== NULL) {
            $db->real_escape_string($this->description);
            $query.=" description = '$this->description',";
        }

        if ($this->tackURL !== NULL) {
            $db->real_escape_string($this->tackURL);
            $query.=" tackUrl = '$this->tackURL',";
        }

        if ($this->imageURL !== NULL) {
            $db->real_escape_string($this->imageURL);
            $query.=" imageURL = '$this->imageURL',";
        }

        $query = substr($query, 0, (strlen($query) - 1));
        $query.=" WHERE id = $this->id";
        return $db->doQuery($query);
    }
    
    /**
     * Gets an associative array representation of the Tack.
     * 
     * @return array array with keys: id, user_id, board_id, title, description, tackUrl, imageURL
     */
    public function getArray() {
        if ($this->get_user_data() === NULL)
            $userName = NULL;
        else
            $userName = $this->get_user_data()->get_username();

        return array(
            self::DB_ID          => $this->get_id(),
            self::DB_USER        => $this->get_user_id(),
            self::USER_NAME      => $userName,
            self::DB_BOARD       => $this->get_board_id(),
            self::DB_TITLE       => $this->get_title(),
            self::DB_DESTRIPTION => $this->get_description(),
            self::DB_TACKURL     => $this->get_tackURL(),
            self::DB_IMAGE       => $this->get_imageURL()
        );
    }
}
?>