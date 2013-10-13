<?php
try {
    require_once '../lib/php/Session.php';
    require_once '../lib/php/User.php';
    require_once '../lib/php/TackitException.php';

    //check required input
    $requiredPosts = array('id', 'password');
    foreach ($requiredPosts as $required) {
        if (!isset($_POST[$required]))
            throw new TackitException($required . " is missing.", 0);
    }

    //validate input
    if (strlen($_POST[$requiredPosts[0]]) > User::DB_EMAIL_LENGTH)
        throw new TackitException("ID is invalid!", 0);
    if (strlen($_POST[$requiredPosts[1]]) > User::DB_PASSWORD_LENGTH)
        throw new TackitException("Password is invalid!", 0);

    //login user, sets cookie if authenticated
    if (Session::login($_POST[$requiredPosts[0]], Session::hash($_POST[$requiredPosts[1]])) === TRUE) {
        throw new TackitException("Success!", 0);
    } else
        throw new TackitException("We could not log you in!", 0);
} catch (TackitException $ex) {
    echo $ex->getJson();
} catch (Exception $ex) {
    $exception = new TackitException("We could not fulfill your request!", 0);
    echo $exception->getJson();
}
?>