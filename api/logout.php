<?php
try {
    require_once '../lib/php/Session.php';

    Session::logout();
    $response = new TackitResponse('');
    echo $response->getJson();
} catch (TackitException $ex) {
    echo $ex->getJson();
} catch (Exception $ex) {
    $exception = new TackitException("We could not fulfill your request!", 0);
    echo $exception->getJson();
}
?>