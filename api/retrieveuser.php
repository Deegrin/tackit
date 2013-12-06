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

    if (isset($_POST['following'])) {
        if (($users = User::getUserFollowing($userid)) !== NULL) {
            $data = array();
            foreach ($users as $user)
                $data[] = $user->getArray();
            $response = new TackitResponse($data);
            exit($response->getJson());
        } else
            throw new TackitException("We could not retrieve the users!", 0);
    }
} catch (TackitException $ex) {
    exit($ex->getJson());
} catch (Exception $ex) {
    $exception = new TackitException("We could not fulfill your request!", 0);
    exit($exception->getJson());
}
?>