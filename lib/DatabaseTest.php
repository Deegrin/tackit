<?php

require 'Database.php';
$db = new Database();
$connection = $db->getConnection();
echo $connection->character_set_name();
$db->doQuery("INSERT INTO USER (ACTIVE, FIRST_NAME, LAST_NAME, EMAIL, USERNAME, PASSWORD, PASSWORD_SALT) VALUES (0, 'David', 'Nguyen', 'davidng0123@live.com', 'Deegrin', 'password', 'salty')");
?>