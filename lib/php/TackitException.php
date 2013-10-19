<?php

/**
 * Custom exception for application errors.
 *
 * @author David
 */
class TackitException extends Exception {

    const EXCEPTION_HEADER = 'error';
    const EXCEPTION_CODE = 'code';
    const EXCEPTION_DESC = 'desc';

    public function __construct($message, $code, $previous = NULL) {
        parent::__construct($message, $code, $previous);
    }

    public function getJson() {
        $error = array(
            self::EXCEPTION_HEADER => true,
            self::EXCEPTION_CODE   => parent::getCode(),
            self::EXCEPTION_DESC   => parent::getMessage()
        );
        return json_encode($error);
    }
}
?>