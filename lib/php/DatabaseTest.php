<?php

require 'Database.php';
require 'User.php';
$db = new Database();
$connection = $db->getConnection();
//echo $connection->character_set_name();
// database connection test


$blah = $db->doQuery("INSERT INTO `tackit`.`tack` (user_id, board_id, title, description, tackUrl, imageURL)
           VALUES (24,2,'three','four','five','six')");
echo $blah;
var_dump($blah);
echo $connection->error;
// user:registerUser test
//User::registerUser('davidng01234@live.com', 'Deegrin2', 'apassword', 'David', 'Nguyen');
//User::registerUser('davidng0123@gmail.com', 'davidng0123', 'apassword');

// user::getUserFromUserName test
//$array = User::getUserFromUserName('Deegrin');
//var_dump($array);
?>