<?php

/**
 * Custom exception for application errors.
 *
 * @author David
 */
class TackitException extends Exception {

    const EXCEPTION_HEADER = 'error';
    const EXCEPTION_CODE = 'code';
    const EXCEPTION_DATA = 'data';

    public function __construct($message, $code, $previous = NULL) {
        parent::__construct($message, $code, $previous);
    }

    /**
     * Gets the exception as associative JSON array.
     * 
     * @return string JSON array
     */
    public function getJson() {
        $error = array(
            self::EXCEPTION_HEADER => true,
            self::EXCEPTION_CODE   => parent::getCode(),
            self::EXCEPTION_DATA   => parent::getMessage()
        );
        return json_encode($error);
    }
}
?>