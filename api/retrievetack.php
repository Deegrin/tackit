<?php
try {
    require_once '../lib/php/Session.php';
    require_once '../lib/php/User.php';
    require_once '../lib/php/Tack.php';
    require_once '../lib/php/Board.php';
    require_once '../lib/php/TackitException.php';
    require_once '../lib/php/TackitResponse.php';

    //check & validate cookie
    if (!isset($_COOKIE[Session::COOKIE]) || strlen($_COOKIE[Session::COOKIE]) > Session::DB_TOKEN_LENGTH)
        throw new TackitException("Session token is invalid!", 0);
    //obtain userid
    if (($userid = Session::isLoggedIn($_COOKIE[Session::COOKIE])) === FALSE)
        throw new TackitException("Session does not exist or has expired!", 0);

    //TACKS BY BOARD
    //TODO in progress
    if (isset($_REQUEST['board'])) {
        //validate input
        if (!is_numeric($_REQUEST['board']) || $_REQUEST['board'] < 0)
            throw new TackitException("Board is invalid", 0);

        //retrieve tacks if user authorized
        $board = Board::getBoardFromID($_REQUEST['board']);
        //if board belongs to user, or board is public
        if ($userid == $board->get_user_id() || !$board->get_private()) {
            //get array of Tack objects
            $tacks = Tack::getTackFromBoardId($_REQUEST['board']);
            //get JSON array of Tacks
            $data = array();
            foreach ($tacks as $tack) {
                $data[] = $tack->getArray();
            }
            //return data
            $response = new TackitResponse($data);
            echo $response->getJson();
        } else
            throw new TackitException("Access denied!", 0);
    }
} catch (TackitException $ex) {
    echo $ex->getJson();
} catch (Exception $ex) {
    $exception = new TackitException("We could not fulfill your request!", 0);
    echo $exception->getJson();
}
?>