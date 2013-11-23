<?php

        const MAXSTRLEN = 1000;
        const STRLENERR = 'Search Phrase is greater than 1000 characters, please reduce and try again.';
        const SEARCHERR = 'Error during search.';

try {
    require_once '../lib/php/Session.php';
    require_once '../lib/php/User.php';
    require_once '../lib/php/Tack.php';
    require_once '../lib/php/Board.php';
    require_once '../lib/php/TackitException.php';
    require_once '../lib/php/TackitResponse.php';

    //searching tacks
    if (isset($_POST['tack'])) {
        if (strlen($_POST['tack']) > MAXSTRLEN)
            throw new TackitException(STRLENERR, 0);

        if (($tacks = Tack::searchTack($_POST['tack'])) !== NULL) {
            $data = array();
            foreach ($tacks as $tack)
                $data[] = $tack->getArray();
            $response = new TackitResponse($data);
            echo $response->getJson();
        }
        else
            throw new TackitException(SEARCHERR, 0);
    }

    //searching boards
    if (isset($_POST['board'])) {
        if (strlen($_POST['board']) > MAXSTRLEN)
            throw new TackitException(STRLENERR, 0);

        if (($boards = Board::searchBoard($_POST['board'])) !== NULL) {
            $data = array();
            foreach ($boards as $board)
                $data[] = $board->getArray();
            $response = new TackitResponse($data);
            echo $response->getJson();
        }
        else
            throw new TackitException(SEARCHERR, 0);
    }

    //searching users
    if (isset($_POST['user'])) {
        if (strlen($_POST['user']) > MAXSTRLEN)
            throw new TackitException(STRLENERR, 0);

        if (($users = User::searchUser($_POST['user'])) !== NULL) {
            $data = array();
            foreach ($users as $user)
                $data[] = $user->getArray();
            $response = new TackitResponse($data);
            echo $response->getJson();
        }
        else
            throw new TackitException(SEARCHERR, 0);
    }
} catch (TackitException $ex) {
    echo $ex->getJson();
} catch (Exception $ex) {
    $exception = new TackitException("We could not fulfill your request!", 0);
    echo $exception->getJson();
}
?>

