<?php

require 'Database.php';
require 'User.php';
$db = new Database();
$connection = $db->getConnection();
echo $connection->character_set_name();
//$db->doQuery("INSERT INTO user (active, first_name, last_name, email, username, password, password_salt) VALUES (0, 'David', 'Nguyen', 'davidng0123@live.com', 'Deegrin', 'password', 'salty')");
//User::registerUser('davidng0123@live.com', 'Deegrin', 'apassword', 'David', 'Nguyen');
?>