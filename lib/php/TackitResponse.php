<?php

/**
 * Response formatter for successful requests.
 *
 * @author David
 */
class TackitResponse {

    const RESPONSE_HEADER = 'error';
    const RESPONSE_DATA = 'data';

    private $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function getJson() {
        $response = array(
            self::RESPONSE_HEADER => false,
            self::RESPONSE_DATA => $this->data
        );
        return json_encode($response);
    }
}
?>