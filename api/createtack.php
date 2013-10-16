<?php
try {
    require_once '../lib/php/Session.php';
    require_once '../lib/php/User.php';
    require_once '../lib/php/Tack.php';
    require_once '../lib/php/Board.php';
    require_once '../lib/php/TackitException.php';

    //check & validate cookie
    if (!isset($_COOKIE[Session::COOKIE]) || strlen($_COOKIE[Session::COOKIE]) > Session::DB_TOKEN_LENGTH) {
        //TODO throw error or redirect user
    }
    //check required input
    $requiredPosts = array('board', 'title', 'desc', 'url', 'image');
    foreach ($requiredPosts as $required) {
        if (!isset($_REQUEST[$required]))
            throw new TackitException($required . " is missing.", 0);
    }

    //validate input
    if (!is_numeric($_REQUEST[$requiredPosts[0]]) || $_REQUEST[$requiredPosts[0]] < 0)
        throw new TackitException("Board is invalid!", 0);
    if (strlen($_REQUEST[$requiredPosts[1]]) > Tack::DB_TITLE_LENGTH)
        throw new TackitException("Title is invalid!", 0);
    if (strlen($_REQUEST[$requiredPosts[2]]) > Tack::DB_DESCRIPTION_LENGTH)
        throw new TackitException("Description is invalid!", 0);
    if (strlen($_REQUEST[$requiredPosts[3]]) > Tack::DB_URL_LENGTH)
        throw new TackitException("Url is invalid!", 0);
    if (strlen($_REQUEST[$requiredPosts[4]]) > Tack::DB_URL2_LENGTH)
        throw new TackitException("Url is invalid!", 0);

    //get userid from session token
    if (($userid = Session::isLoggedIn($_COOKIE[Session::COOKIE])) !== FALSE) {
        //create board if user authorized
        if (in_array($_REQUEST[$requiredPosts[0]], Board::getBoardFromUserId($userid)))
            Tack::createTack($userid, $_REQUEST[$requiredPosts[0]], $_REQUEST[$requiredPosts[1]], $_REQUEST[$requiredPosts[2]], $_REQUEST[$requiredPosts[3]], $_REQUEST[$requiredPosts[4]]);
        else
            throw new TackitException("We could not create a tack!", 0);
    } else
        throw new TackitException("Session is invalid!", 0);
} catch (TackitException $ex) {
    echo $ex->getJson();
} catch (Exception $ex) {
    $exception = new TackitException("We could not fulfill your request!", 0);
    echo $exception->getJson();
}
?>