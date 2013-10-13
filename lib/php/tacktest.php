<?php

	require "tack.php";
	require "user.php";
	require "board.php";
	
	//$test = new tack();
	//$test->set_id(45);

        //$test->createTack(24,2,"three","four","five","six","seven");
	
        //var_dump(Tack::getTackFromID(19));
	echo 'cake';
	//echo $test->get_id();
        //$test = new Board(0,"num","hello",24);
        //$test->createBoard(26,1,"num","hello");
        $test = new tack(1,2,3,1,2,3);
        Tack::createTack(24,2,"three","david is cool","five","six","seven");
        Tack::createTack(24,2,"is david cool"," is cool","five","six","seven");
        Tack::createTack(24,2,"three","coolisdavid","five","six","seven");
        Tack::createTack(24,2,"davidiscool"," is cool","five","six","seven");
       Tack::createTack(24,2,"three","david is cool","five","six","seven");
        Tack::createTack(24,2,"david is cool"," is cool","five","six","seven");
        var_dump($test->searchTack("david"));
        
        
         echo 'cake';
        
?>