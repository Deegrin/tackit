<?php
try {
    require_once '../lib/php/Session.php';
    require_once '../lib/php/User.php';
    require_once '../lib/php/TackitException.php';
    require_once '../lib/php/TackitResponse.php';

    //check required input
    $requiredPosts = array('email', 'username', 'password');
    foreach ($requiredPosts as $required) {
        if (!isset($_POST[$required]))
            throw new TackitException($required . " is missing.", 0);
    }

    //validate input
    if (strlen($_POST[$requiredPosts[0]]) > User::DB_EMAIL_LENGTH)
        throw new TackitException("Email is invalid!", 0);
    if (strlen($_POST[$requiredPosts[1]]) > User::DB_USERNAME_LENGTH)
        throw new TackitException("Username is invalid!", 0);
    if (strlen($_POST[$requiredPosts[2]]) > User::DB_PASSWORD_LENGTH)
        throw new TackitException("Password is invalid!", 0);
    //register user
    if (User::registerUser($_POST[$requiredPosts[0]], $_POST[$requiredPosts[1]], Session::hash($_POST[$requiredPosts[2]])) === TRUE) {
        $response = new TackitResponse('');
        echo $response->getJson();
    } else
        throw new TackitException("We could not register an account!", 0);
} catch (TackitException $ex) {
    echo $ex->getJson();
} catch (Exception $ex) {
    $exception = new TackitException("We could not fulfill your request!", 0);
    echo $exception->getJson();
}
?>