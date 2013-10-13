<?php

/**
 * Custom exception for application errors.
 *
 * @author David
 */
class TackitException extends Exception {

    const EXCEPTION_HEADER = 'error';

    public function __construct($message, $code, $previous = NULL) {
        parent::__construct($message, $code, $previous);
    }

    public function getJson() {
        $error = array(
            self::EXCEPTION_HEADER,
            parent::getCode(),
            parent::getMessage()
        );
        return json_encode($error);
    }
}
?>