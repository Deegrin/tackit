<?php

require_once "tack.php";
require_once "user.php";
require_once "board.php";

//$test = new tack();
//$test->set_id(45);
//$test->createTack(24,2,"three","four","five","six","seven");
//var_dump(Tack::getTackFromID(19));
//echo 'cake';
//echo $test->get_id();
//$test = new Board(0,"num","hello",24);
//$test->createBoard(26,1,"num","hello");

/*
  $test = new tack(1,2,3,1,2,3);
  Tack::createTack(24,2,"three","david is cool","five","six","seven");
  Tack::createTack(24,2,"is david cool"," is cool","five","six","seven");
  Tack::createTack(24,2,"three","coolisdavid","five","six","seven");
  Tack::createTack(24,2,"davidiscool"," is cool","five","six","seven");
  Tack::createTack(24,2,"three","david is cool","five","six","seven");
  Tack::createTack(24,2,"david is cool"," is cool","five","six","seven");
  var_dump($test->searchTack("davidiscool"));
 */

//$test = new board(0, 1, 3);
/*
Board::getBoardFromID(2);
Board::getBoardFromID(3);
Board::createBoard(24, 0, "three", "blah is cool");
Board::createBoard(24, 0, "is blah cool", " is cool");
Board::createBoard(24, 0, "three", "coolisdavid");
//Board::createBoard(24, 0, "davidiscool", " is cool");
//Board::createBoard(24, 0, "three", "david is cool");
Board::createBoard(24, 0, "blah is cool", " is cool");
*/
//var_dump($test->searchBoard("cake"));

//Retack Test
/*
$test = new tack(1,1,"test","test tack","tackdotcom","imagedotcom");
Tack::retack(3,2,$test);
echo 'cake';
 */
//Test array result returns
/*
$test = BOARD::getBoardFromBoardPriv(0);
var_dump($test);
 * 
 */

//Test getBoardARR
//var_dump(BOARD::getBoardArrFromUserId(1));
//var_dump(BOARD::searchBoard('cake'));

//Test boards getArray()
//$test = new Board(0, 'water', 'H20');
//var_dump($test->getArray());

//Test searchTack
//var_dump(TACK::searchTack('cake'));


//board.edit() test
//$bd = new Board(0,NULL,"cake",2);
//var_dump($bd->edit());

//tack.edit() test
//$tk = new Tack(NULL,3,"cake","cake","cake","cake",75);
//var_dump($tk->edit());

//Relationship::unfollowBoard(1, 85);
//
//Relationship::unfavoriteTack(4, 11);
//
//Relationship::unfollowUser(1, 6);

echo "<pre>"; //magic: leaves output formatted and indented
var_dump(Tack::getTackFromUserId(1, TRUE));
echo "</pre>";
?>