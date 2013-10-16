<?php
class Board {
    
    const EMPTY_STRING = '';
    const DB_PRIV = "priv";
    const DB_TITLE = "title";
    const DB_DESTRIPTION = "description";


    private $id;
    private $user_id;
    private $priv;
    private $title;
    private $description;
    private $creation_time;

    public function __construct($priv, $title, $description, $user_id = self::EMPTY_STRING, $creation_time = self::EMPTY_STRING) {
        $this->priv = $priv;
        $this->user_id = $user_id;
        $this->title = $title;
        $this->description = $description;
        $this->creation_time = $creation_time;
    }

    public function set_id($new_id) {
        $this->id = $new_id;
    }

    public function set_user_id($new_user_id) {
        $this->user_id = $new_user_id;
    }

    public function set_private($new_private) {
        $this->priv = $new_private;
    }

    public function set_title($new_title) {
        $this->title = $new_title;
    }

    public function set_description($new_description) {
        $this->description = $new_description;
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

    public function get_private() {
        return $this->priv;
    }

    public function get_title() {
        return $this->title;
    }

    public function get_description() {
        return $this->description;
    }

    public function get_creation_time() {
        return $this->creation_time;
    }
    
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
            VALUES ('$userID','$priv','$title','$description')";
        
        //submit query
        return $db->doQuery($insertBoard);
    }

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
}
?>