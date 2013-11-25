<?php
try {
    require_once '../lib/php/Session.php';
    require_once '../lib/php/User.php';
    require_once '../lib/php/Tack.php';
    require_once '../lib/php/Board.php';
    require_once '../lib/php/TackitException.php';
    require_once '../lib/php/TackitResponse.php';

    //check & validate cookie
    Session::validateCookie();
    //obtain userid
    if (($userid = Session::isLoggedIn($_COOKIE[Session::COOKIE])) === FALSE)
        throw new TackitException("Session does not exist or has expired!", 0);

    //REMOVE TACK
    if (isset($_POST['tack'])) {
        //validate input
        if (!is_numeric($_POST['tack']) || $_POST['tack'] < 0)
            throw new TackitException("Tack is invalid!", 0);

        //if tack exists and belongs to the user
        if (Tack::getTackFromID($_POST['tack'], $userid) !== NULL) {
            if (Tack::deleteTack($_POST['tack']) === TRUE) {
                $response = new TackitResponse("");
                exit($response->getJson());
            } else
                throw new TackitException("We could not delete the Tack!", 0);
        } else
            throw new TackitException("We could not delete the Tack!", 0);
    } //REMOVE BOARD
    if (isset($_POST['board'])) {
        //validate input
        if (!is_numeric($_POST['board']) || $_POST['board'] < 0)
            throw new TackitException("Board is invalid!", 0);

        //if board belongs to the user
        if (in_array($_POST['board'], Board::getBoardFromUserId($userid))) {
            if (Board::deleteBoard($_POST['board']) === TRUE) {
                $response = new TackitResponse("");
                exit($response->getJson());
            } else
                throw new TackitException("We could not delete the Board!", 0);
        } else
            throw new TackitException("We could not delete the Board!", 0);
    }
} catch (TackitException $ex) {
    exit($ex->getJson());
} catch (Exception $ex) {
    $exception = new TackitException("We could not fulfill your request!", 0);
    exit($exception->getJson());
}
?>