<?php

require_once 'Database.php';

/**
 * User session handler. Initiates, facilitates, and obliterates sessions.
 *
 * @author David
 */
class Session {

    const COOKIE = "tackit";
    const COOKIE_PATH = "/";
    const COOKIE_EXPIRATION_SECONDS = 604800; //7 days
    const DEFAULT_SALT = "$2y$07\$UQLETgfk9isoM/OItngvME"; //triggers Blowfish hashing
    const EMPTY_STRING = "";

    const DB_TOKEN_LENGTH = 36;

    public static function login($id, $password) {
        $db = new Database();
        $con = $db->getConnection();

        //escape input
        $id = $con->real_escape_string($id);
        $password = $con->real_escape_string($password);

        //authenticate user
        if (($result = $db->doQuery("SELECT id FROM tackit.user WHERE (username = '$id' OR email = '$id') AND password = '$password'"))
                && ($row = $result->fetch_array()) !== NULL) {
            //session token from UUID v4
            $token = Session::getUuidV4();

            //initiate session in data base
            $db->doQuery("INSERT INTO `tackit`.`session` (user_id, token, creation_time, expiration_time)
                VALUES ('$row[0]', '$token', CURRENT_TIMESTAMP, TIMESTAMPADD(WEEK, 1, CURRENT_TIMESTAMP))");
            //send session token to user
            setcookie(self::COOKIE, $token, time() + self::COOKIE_EXPIRATION_SECONDS, self::COOKIE_PATH);

            $result->free();
            return TRUE;
        } else
            throw new TackitException("The user or email does not exist, or the password is incorrect!", 0);
    }

    public static function isLoggedIn($token) {
        $db = new Database();
        $con = $db->getConnection();

        //escape input
        $token = $con->real_escape_string($token);

        //search for session
        if (($result = $db->doQuery("SELECT user_id FROM `tackit`.`session` WHERE token='$token' AND expiration_time > CURRENT_TIMESTAMP"))
                && ($row = $result->fetch_array()) !== NULL) {
            $result->free();
            return $row[0];
        } else
            return FALSE;
    }

    public static function logout() {
        //expire the cookie
        setcookie(self::COOKIE, self::EMPTY_STRING, time() - 1);
    }

    public static function hash($hashee) {
        return crypt($hashee, self::DEFAULT_SALT);
    }

    public static function getUuidV4() {
        $uuid = openssl_random_pseudo_bytes(16);
        //set uuid[6] to 4 (as decimal)
        $uuid[6] = chr(ord($uuid[6]) & 0x0f | 0x40);
        //set uuid[8] to 10 (as bit)
        $uuid[8] = chr(ord($uuid[8]) & 0xbf | 0x80);
        //split and add hyphens
        return vsprintf("%s%s-%s-%s-%s-%s%s%s", str_split(bin2hex($uuid), 4));
    }
}
?>