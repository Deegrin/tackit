<?php

try {
    require_once '../lib/php/Session.php';
    require_once '../lib/php/User.php';
    require_once '../lib/php/TackitException.php';

//check required input
    $requiredPosts = array('email', 'username', 'password');
    foreach ($requiredPosts as $required) {
        if (!isset($_POST[$required]))
            throw new TackitException($required . " is missing.", 0);
    }

//validate input
//register user
    if (User::registerUser($_POST[$requiredPosts[0]], $_POST[$requiredPosts[1]], Session::hash($_POST[$requiredPosts[2]])) === TRUE) {
        throw new TackitException("Success!", 0);
    } else
        throw new TackitException("We could not register an account!", 0);
} catch (TackitException $ex) {
    echo $ex->getJson();
} catch (Exception $ex) {
    $exception = new TackitException("We could not fulfill your request!", 0);
    echo $exception->getJson();
}
?>