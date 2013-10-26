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
    //check required input
    $requiredPosts = array('title', 'desc', 'private');
    foreach ($requiredPosts as $required) {
        if (!isset($_POST[$required]))
            throw new TackitException($required . " is missing.", 0);
    }

    //validate input
    if (strlen($_POST[$requiredPosts[0]]) > Board::DB_TITLE_LENGTH)
        throw new TackitException("Title is invalid!", 0);
    if (strlen($_POST[$requiredPosts[1]]) > Board::DB_DESCRIPTION_LENGTH)
        throw new TackitException("Description is invalid!", 0);
    if (!is_numeric($_POST[$requiredPosts[2]]) || !($_POST[$requiredPosts[2]] == 0 || $_POST[$requiredPosts[2]] == 1))
        throw new TackitException("Private mode is invalid!", 0);

    //get userid from session token
    if (($userid = Session::isLoggedIn($_COOKIE[Session::COOKIE])) !== FALSE) {
        //create board if user authorized
        if (Board::createBoard($userid, $_POST[$requiredPosts[2]], $_POST[$requiredPosts[0]], $_POST[$requiredPosts[1]]) !== FALSE) {
            $response = new TackitResponse();
            echo $response->getJson();
        } else
            throw new TackitException("We could not create a board!", 0);
    } else
        throw new TackitException("Session is invalid!", 0);
} catch (TackitException $ex) {
    echo $ex->getJson();
} catch (Exception $ex) {
    $exception = new TackitException("We could not fulfill your request!", 0);
    echo $exception->getJson();
}
?>