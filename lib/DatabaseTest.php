<?php
require 'Database.php';
$db = new Database();
echo $db->doQuery("INSERT INTO USER (ACTIVE, FIRST_NAME, LAST_NAME, EMAIL, USERNAME, PASSWORD, PASSWORD_SALT) VALUES (0, 'David', 'Nguyen', 'davidng0123@live.com', 'Deegrin', 'password', 'salty')");
$connect = $db->getConnection();
echo '1';
echo $connect->query($connect->real_escape_string("INSERT INTO tackit.user (ACTIVE, FIRST_NAME, LAST_NAME, EMAIL, USERNAME, PASSWORD, PASSWORD_SALT) VALUES (0, 'David', 'Nguyen', 'davidng0123@live.com', 'Deegrin', 'password', 'salty')"));
echo '2';
?>