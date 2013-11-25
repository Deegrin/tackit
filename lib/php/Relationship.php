<?php

require_once 'Database.php';

/**
 * Relationship handler.
 *
 * @author David
 */
class Relationship {

    const TYPE_FOLLOW_BOARD = 1;
    const TYPE_FAVORITE_TACK = 2;
    const TYPE_FOLLOW_USER = 3;

    public static function followBoard($userId, $boardId) {
        $db = new Database();

        //escape input
        $userId = $db->real_escape_string($userId);
        $boardId = $db->real_escape_string($boardId);

        //query
        $followBoard = "INSERT INTO `tackit`.`relationship` (user_id, type, object_id)
            VALUES ($userId, " . self::TYPE_FOLLOW_BOARD . ", $boardId)";
        return $db->doQuery($followBoard);
    }

    public static function favoriteTack($tackId, $userId) {
        $db = new Database();

        $userId = $db->real_escape_string($userId);
        $tackId = $db->real_escape_string($tackId);

        $query = "INSERT INTO `tackit`.`relationship` (user_id, type, object_id)
            VALUES ($userId, " . self::TYPE_FAVORITE_TACK . ", $tackId)";

        return $db->doQuery($query);
    }
    
    public static function followUser($stalker, $stalked) {
        $db = new Database();
        
        $stalker = $db->real_escape_string($stalker);
        $stalked = $db->real_escape_string($stalked);
        
        $query = "INSERT INTO `tackit`.`relationship` (user_id, type, object_id) 
            VALUES ($stalker, " . self::TYPE_FOLLOW_USER . ", $stalked)";
        return $db->doQuery($query);
    }
    
    public static function unfollowBoard($userId, $boardId) {
        $db = new Database();

        //escape input
        $userId = $db->real_escape_string($userId);
        $boardId = $db->real_escape_string($boardId);

        //query
        $query = "DELETE FROM `tackit`.`relationship` WHERE user_id = $userId 
            AND type = " . self::TYPE_FOLLOW_BOARD . " AND object_id = $boardId";
        return $db->doQuery($query);
    }
    
    public static function unfavoriteTack($userId, $tackId) {
        $db = new Database();

        $userId = $db->real_escape_string($userId);
        $tackId = $db->real_escape_string($tackId);

        $query = "DELETE FROM `tackit`.`relationship` WHERE user_id = $userId 
            AND type = " . self::TYPE_FAVORITE_TACK . " AND object_id = $tackId";
        return $db->doQuery($query);
    }

    public static function unfollowUser($stalker, $stalked) {
        $db = new Database();
        
        $stalker = $db->real_escape_string($stalker);
        $stalked = $db->real_escape_string($stalked);
        
         $query = "DELETE FROM `tackit`.`relationship` WHERE user_id = $stalker 
            AND type = " . self::TYPE_FOLLOW_USER . " AND object_id = $stalked";
         return $db->doQuery($query);
    }
}
?>