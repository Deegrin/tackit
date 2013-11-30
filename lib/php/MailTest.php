<?php

require_once 'Mail.php';
require_once 'User.php';

Mail::verifyRegistration(User::getUserFromUserID(1)[0]);
?>