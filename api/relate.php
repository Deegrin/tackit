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
    } // FAVORITE TACK
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
    } // RETACK TACK TO BOARD
    if (isset($_POST['retackTack']) && isset($_POST['retackBoard'])) {
        //validate input
        if (!is_numeric($_POST['retackTack']) || $_POST['retackTack'] < 0)
            throw new TackitException("retackTack is invalid", 0);
        if (!is_numeric($_POST['retackBoard']) || $_POST['retackBoard'] < 0)
            throw new TackitException("retackBoard is invalid", 0);

        //check if the board exists
        if (in_array($_POST['retackBoard'], Board::getBoardFromUserID($userid))) {
            // check if the tack exists
            if (($tack = Tack::getTackFromID($_POST['retackTack'])) !== NULL) {
                // retack the tack to board, remember to pass in Tack object
                if (Tack::retack($userid, $_POST['retackBoard'], $tack) === TRUE) {
                    $response = new TackitResponse();
                    exit($response->getJson());
                } else
                    throw new TackitException("We could not retack the tack!", 0);
            } else
                throw new TackitException("The tack does not exist!", 0);
        } else
            throw new TackitException("Access denied!", 0);
    } //FOLLOW USER
    if (isset($_POST['user'])) {
        if (!is_numeric($_POST['user']) || $_POST['user'] < 0)
            throw new TackitException("User is invalid", 0);
        if (USER::getUserFromUserID($_POST['user'] !== NULL)) {
            if (Relationship::followUser($userid, $_POST['user']) !== FALSE) {
                $response = new TackitResponse();
                exit($response->getJson());
            } else
                throw new TackitException("Unable to follow the user.", 0);
        } else
            throw new TackitException("User does not exist.", 0);
    } //UNFOLLOW BOARD
    if (isset($_POST['unBoard'])) {
        //validate input
        if (!is_numeric($_POST['unBoard']) || $_POST['unBoard'] < 0)
            throw new TackitException("Board is invalid", 0);

        //follow board if user authorized
        if (($board = Board::getBoardFromID($_POST['unBoard'])) !== NULL) {
            //if board is public
            if (!$board->get_private()) {
                if (Relationship::unfollowBoard($userid, $_POST['unBoard']) !== FALSE) {
                    $response = new TackitResponse();
                    echo $response->getJson();
                } else
                    throw new TackitException("We could not unfollow the board!", 0);
            } else
                throw new TackitException("Access denied!", 0);
        } else
            throw new TackitException("Board is invalid", 0);
    } // UNFAVORITE TACK
    if (isset($_POST['unFavorite'])) {
        //validate input
        if (!is_numeric($_POST['unFavorite']) || $_POST['unFavorite'] < 0)
            throw new TackitException("favorite is invalid", 0);

        //follow board if user authorized
        if (($tack = Tack::getTackFromID($_POST['unFavorite'])) !== NULL) {
            //if board is public
            if (Relationship::unfavoriteTack($userid, $_POST['unFavorite']) !== FALSE) {
                $response = new TackitResponse();
                echo $response->getJson();
            } else
                throw new TackitException("We could not favorite the tack!", 0);
        } else
            throw new TackitException("tack is invalid", 0);
    }//UNFOLLOW USER
    if (isset($_POST['unUser'])) {
        if (!is_numeric($_POST['unUser']) || $_POST['unUser'] < 0)
            throw new TackitException("User is invalid", 0);
        if (USER::getUserFromUserID($_POST['unUser'] !== NULL)) {
            if (Relationship::unfollowUser($userid, $_POST['unUser']) !== FALSE) {
                $response = new TackitResponse();
                exit($response->getJson());
            } else
                throw new TackitException("Unable to follow the user.", 0);
        } else
            throw new TackitException("User does not exist.", 0);
    }
} catch (TackitException $ex) {
    exit($ex->getJson());
} catch (Exception $ex) {
    $exception = new TackitException("We could not fulfill your request!", 0);
    exit($exception->getJson());
}
?>