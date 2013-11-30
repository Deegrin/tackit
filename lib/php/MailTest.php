<?php

require_once 'TackitMail.php';
require_once 'User.php';

//TackitMail::verifyRegistration(User::getUserFromUserID(1)[0]);

$user = User::getUserFromUserName("davidng01233");
var_dump (TackitMail::verifyRegistration($user));
?>