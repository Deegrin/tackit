<?php
try {
    require_once '../lib/php/Session.php';
    require_once '../lib/php/User.php';
    require_once '../lib/php/Tack.php';
    require_once '../lib/php/Board.php';
    require_once '../lib/php/TackitException.php';
    require_once '../lib/php/TackitResponse.php';

    //check and validate cookie
    Session::validateCookie();
    //obtain userid
    if (($userid = Session::isLoggedIn($_COOKIE[Session::COOKIE])) === FALSE)
        throw new TackitException("Session does not exist or has expired!", 0);

    //OWN BOARDS
    if (isset($_POST['own'])) {
        //get array of Board objects
        if (($boards = Board::getBoardArrFromUserId($userid)) !== NULL) {
            //get JSON array of Boards
            $data = array();
            foreach ($boards as $board)
                $data[] = $board->getArray();
            //return data
            $response = new TackitResponse($data);
            echo $response->getJson();
        } else
            throw new TackitException("We could not retrieve your boards!", 0);
    }
    if (isset($_POST['following'])) {
        //get array of Board objects
        if (($boards = Board::getBoardFollowing($userid)) !== NULL) {
            //get JSON array of Boards
            $data = array();
            foreach ($boards as $board)
                $data[] = $board->getArray();
            //return data
            $response = new TackitResponse($data);
            echo $response->getJson();
        } else
            throw new TackitException("We could not retrieve the boards!", 0);
    }
    if (isset($_POST['user'])) {
        //get array of Board objects
        if (($boards = Board::getPublicBoardArrFromUserId($_POST['user'])) !== NULL) {
            //get JSON array of Boards
            $data = array();
            foreach ($boards as $board)
                $data[] = $board->getArray();
            //return data
            $response = new TackitResponse($data);
            echo $response->getJson();
        } else
            throw new TackitException("We could not retrieve the boards!", 0);
    }
} catch (TackitException $ex) {
    echo $ex->getJson();
} catch (Exception $ex) {
    $exception = new TackitException("We could not fulfill your request!", 0);
    echo $exception->getJson();
}
?>