<?php

require_once '../lib/php/Session.php';
require_once '../lib/php/User.php';

//check required input
$requiredPosts = array('email', 'username', 'password');
foreach ($requiredPosts as $required) {
    if (!isset($_POST[$required])) {
        $exception = new TackitException($required . " is missing.", 0);
        echo $exception->getJson();
        exit;
    }
}

//validate input
//register user
if (User::registerUser($_POST[$requiredPosts[0]], $_POST[$requiredPosts[1]], Session::hash($_POST[$requiredPosts[2]])) === TRUE) {
    $exception = new TackitException("success!", 0);
    echo $exception->getJson();
}
//else
//return error and exit
?>