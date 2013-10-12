<?php

require 'Database.php';
require 'User.php';
$db = new Database();
$connection = $db->getConnection();
echo $connection->character_set_name();
// database connection test
//$db->doQuery("INSERT INTO user (active, first_name, last_name, email, username, password, password_salt) VALUES (0, 'David', 'Nguyen', 'davidng0123@live.com', 'Deegrin', 'password', 'salty')");

// user:registerUser test
//User::registerUser('davidng01234@live.com', 'Deegrin2', 'apassword', 'David', 'Nguyen');
//User::registerUser('davidng0123@gmail.com', 'davidng0123', 'apassword');

// user::getUserFromUserName test
//$array = User::getUserFromUserName('Deegrin');
//var_dump($array);
?>