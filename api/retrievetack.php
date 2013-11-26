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

    //TACKS BY BOARD
    //TODO in progress
    if (isset($_POST['board'])) {
        //validate input
        if (!is_numeric($_POST['board']) || $_POST['board'] < 0)
            throw new TackitException("Board is invalid", 0);

        //retrieve tacks if user authorized
        if (($board = Board::getBoardFromID($_POST['board'])) !== NULL) {
            //if board belongs to user, or board is public
            if ($userid == $board->get_user_id() || !$board->get_private()) {
                //get array of Tack objects
                $tacks = Tack::getTackFromBoardId($_POST['board']);
                //get JSON array of Tacks
                $data = array();
                foreach ($tacks as $tack) {
                    $data[] = $tack->getArray();
                }
                //return data
                $response = new TackitResponse($data);
                echo $response->getJson();
                exit();
            } else
                throw new TackitException("Access denied!", 0);
        } else
            throw new TackitException("Board is invalid", 0);
    } //TACKS BY BOARD
    //TACKS BY FAVORITE
    else if (isset($_POST['favorite'])) {
        if (($tacks = Tack::getTackFavorite($userid)) !== NULL) {
            $data = array();
            foreach ($tacks as $tack) {
                $data[] = $tack->getArray();
            }
            $response = new TackitResponse($data);
            echo $response->getJson();
            exit();
        } else
            throw new TackitException("We could not get your favorites!", 0);
    } //TACKS BY FAVORITE
    //TACKS BY FEED
    else if (isset($_POST['feed'])) {
        if (($tacks = Tack::getTackFeed($userid)) !== NULL) {
            $data = array();
            foreach ($tacks as $tack)
                $data[] = $tack->getArray();
            $response = new TackitResponse($data);
            echo $response->getJson();
            exit();
        } else
            throw new TackitException("We could not get your feed!", 0);
    } //TACKS BY FEED
} catch (TackitException $ex) {
    exit($ex->getJson());
} catch (Exception $ex) {
    $exception = new TackitException("We could not fulfill your request!", 0);
    exit($exception->getJson());
}
?>