<?php

/**
 * Description of Session.
 *
 * @author David
 */
class Session {

    const DEFAULT_SALT = "$2y$07\$UQLETgfk9isoM/OItngvME";

    public static function hash($hashee) {
        return crypt($hashee, self::DEFAULT_SALT);
    }
}
?>