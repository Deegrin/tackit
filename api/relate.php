<?php
try {
    require_once '../lib/php/Session.php';
    require_once '../lib/php/User.php';
    require_once '../lib/php/Tack.php';
    require_once '../lib/php/Board.php';
    require_once '../lib/php/Relationship.php';
    require_once '../lib/php/TackitException.php';
    require_once '../lib/php/TackitResponse.php';

    //check & validate cookie
    Session::validateCookie();
    //obtain userid
    if (($userid = Session::isLoggedIn($_COOKIE[Session::COOKIE])) === FALSE)
        throw new TackitException("Session does not exist or has expired!", 0);

    //FOLLOW BOARD
    if (isset($_POST['board'])) {
        //validate input
        if (!is_numeric($_POST['board']) || $_POST['board'] < 0)
            throw new TackitException("Board is invalid", 0);

        //follow board if user authorized
        if (($board = Board::getBoardFromID($_POST['board'])) !== NULL) {
            //if board is public
            if (!$board->get_private()) {
                if (Relationship::followBoard($userid, $_POST['board']) !== FALSE) {
                    $response = new TackitResponse();
                    echo $response->getJson();
                } else
                    throw new TackitException("We could not follow the board!", 0);
            } else
                throw new TackitException("Access denied!", 0);
        } else
            throw new TackitException("Board is invalid", 0);
    }


if (isset($_POST['favorite'])) {
        //validate input
        if (!is_numeric($_POST['favorite']) || $_POST['favorite'] < 0)
            throw new TackitException("favorite is invalid", 0);

        //follow board if user authorized
        if (($tack = Tack::getTackFromID($_POST['favorite'])) !== NULL) {
            //if board is public
        
                if (Relationship::favoriteTack($_POST['favorite'], $userid) !== FALSE) {
                    $response = new TackitResponse();
                    echo $response->getJson();
                } else
                    throw new TackitException("We could not favorite the tack!", 0);
            
        } else
            throw new TackitException("tack is invalid", 0);
    }

// recent

if (isset($_POST['retackTack'] && $_POST['retackBoard'])) {
        //validate input
        if (!is_numeric($_POST['retackTack']) || $_POST['retackTack'] < 0)
            throw new TackitException("retackTack is invalid", 0);
        if (!is_numeric($_POST['retackBoard']) || $_POST['retackBoard'] < 0)
            throw new TackitException("retackBoard is invalid", 0);

            //check if the board exists
           if (in_array($_POST['retackBoard'], Board::getBoardFromUserID($userid))){

            if (Tack::getTackFromID($_POST['retackTack'])!==NULL){
                if (Relationship::followBoard($userid, $_POST['board']) !== FALSE) {
                    $response = new TackitResponse();
                    echo $response->getJson();
                } else
                    throw new TackitException("We could not follow the board!", 0);
            } else
            throw new TackitException("The tack does not exists", 0);

        }else
                throw new TackitException("Access denied!", 0);

       
    }





} catch (TackitException $ex) {
    echo $ex->getJson();
} catch (Exception $ex) {
    $exception = new TackitException("We could not fulfill your request!", 0);
    echo $exception->getJson();
}
?>