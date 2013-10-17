<?php require_once 'Session.php'; ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>TackIT: Homage</title>

        <!-- Required header files -->
        <script src="../lib/javascript/facebook_login.js"></script>
        <script type="text/javascript" src="../lib/bootstrap/js/jquery-1.10.2.js"></script>
        <script src = "../lib/bootstrap/dist/js/bootstrap.js"></script>
        <script type="text/javascript" src="../lib/javascript/jquery.min.js"></script>
        <script language="javascript" type="text/javascript" src="../lib/javascript/vpb_script.js"></script>
        <link type ="text/css" rel="stylesheet" href="../lib/bootstrap/dist/css/bootstrap.css"/>

        <link href="../lib/css/style.css" rel="stylesheet" type="text/css">


    </head>
    <body>

        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">TackIT</a>
                </div>
                <div class="navbar-collapse collapse">
                    <?php
                    if (isset($_COOKIE[Session::COOKIE]) && strlen($_COOKIE[Session::COOKIE]) <= Session::DB_TOKEN_LENGTH && Session::isLoggedIn($_COOKIE[Session::COOKIE]) == true) {
                            ?>
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Add Tack</a></li>
                                        <li><a href="#">Add Board</a></li>
                                        <li><a href="#">View Profile</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <form class="navbar-form navbar-right">
                                <div class="form-group">
                                    <input type="text" placeholder="Email" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-success">Search</button>
                            </form>

                            <?php
                        
                    }
                    else { ?>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="active"><a href="../www/signup.php">Signup/Login</a></li>
                        </ul>
                        <?php
                    }
                    ?>
                </div><!--/.navbar-collapse -->
            </div>
        </div>