<?php

	require "tack.php";
	require "user.php";
	require "board.php";
	
	//$test = new tack();
	//$test->set_id(45);

        //$test->createTack(24,2,"three","four","five","six","seven");
	
        var_dump(Tack::getTackFromID(19));
	echo 'cake';
	echo $test->get_id();
 
?>