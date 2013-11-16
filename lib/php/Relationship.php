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

    public static function favoriteTack($tackId, $userId){
        $db = new Database();

        $userId = $db->real_escape_string($userId);
        $tackId = $db->real_escape_string($tackId);

        $query = "INSERT INTO `tackit`.`relationship` (user_id, type, object_id)
            VALUES ($userId, " . self::TYPE_FAVORITE_TACK . ", $tackId)";

        return $db->doQuery($query);

    }

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
}
?>