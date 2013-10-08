<?php

//check required input
$requiredPosts = array('email', 'username', 'password');
foreach ($requiredPosts as $required) {
    //if (!isset($_POST[$required]))
    //return error and exit
}

//validate input

//register user
if (User::registerUser($_POST[$requiredPosts[0]], $_POST[$requiredPosts[1]], $_POST[$requiredPosts[2]]) === TRUE) {
//generate verification link and email    
//return success
}
//else
//return error and exit
?>