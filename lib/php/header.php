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
        <script language="javascript" type="text/javascript" src="../lib/javascript/vpb_script.js"></script>
        <link type ="text/css" rel="stylesheet" href="../lib/bootstrap/dist/css/bootstrap.css"/>
        <script src = "../lib/javascript/signup.js"></script>
        <script src = "../lib/javascript/login.js"></script>
        <script src = "../lib/javascript/logout.js"></script>
        <link href="../lib/css/style.css" rel="stylesheet" type="text/css">
            <link type="text/css" rel="stylesheet" href="../lib/css/board.css">


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
                                <a class="navbar-brand" href="dashboard.php">TackIT</a>
                            </div>
                            <div class="navbar-collapse collapse">
                                <?php
                                if (isset($_COOKIE[Session::COOKIE]) && strlen($_COOKIE[Session::COOKIE]) <= Session::DB_TOKEN_LENGTH && Session::isLoggedIn($_COOKIE[Session::COOKIE]) == true) {
                                    ?>
                                    <ul class="nav navbar-nav navbar-right">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account<b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="#">Add Tack</a></li>
                                                <li><a href="#">Add Board</a></li>
                                                <li><a href="#">View Profile</a></li>
                                                <li class="divider"></li>
                                                <li><a id="logout_button" href="#">Logout</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                    <form id="navbar_search" class="navbar-form navbar-right">
                                        <div class="form-group">
                                            <input id="navbar_search_param" type="text" placeholder="Tack" class="form-control">
                                        </div>
                                        <button type="submit" class="btn btn-success">Search</button>
                                    </form>

                                    <?php
                                } else {
                                    ?>
                                    <script>$(document).ready(function() {
                                        if(window.location.pathname != "/tackit/www/homepage.php") {
                                            window.location.href = "homepage.php";
                                        }
                                    });
                                    </script>
                                    <ul class="nav navbar-nav navbar-right">
                                        <li><a href="javascript:void(0);" onClick="vpb_show_sign_up_box();">Signup</a></li>
                                        <li><a href="javascript:void(0);" onClick="vpb_show_login_box();">Login</a></li>
                                    </ul>
                                    <?php
                                }
                                ?>
                            </div><!--/.navbar-collapse -->
                        </div>
                    </div>


                    <!-- Code Begins -->

                    <div id="vpb_pop_up_background"></div><!-- General Pop-up Background -->


                    <!-- Sign Up Box Starts Here -->
                    <div id="vpb_signup_pop_up_box">
                        <div align="left" style="font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold;">TackIT Signup</div><br clear="all">
                            <div align="left" style="font-family:Verdana, Geneva, sans-serif; font-size:11px;">To exit this sign-up box, click on the cancel button or outside this box..</div><br clear="all"><br clear="all">

                                    <div style="width:100px; padding-top:10px;float:left;" align="left">Your Username:</div>
                                    <div style="width:300px;float:left;" align="left"><input type="text" id="signup_username" name="usernames" value="" class="vpb_textAreaBoxInputs"></div><br clear="all"><br clear="all">

                                            <div style="width:100px; padding-top:10px;float:left;" align="left">Email Address:</div>
                                            <div style="width:300px;float:left;" align="left"><input type="text" id="signup_email" name="emails" value="" class="vpb_textAreaBoxInputs"></div><br clear="all"><br clear="all">

                                                    <div style="width:100px; padding-top:10px;float:left;" align="left">Password:</div>
                                                    <div style="width:300px;float:left;" align="left"><input type="password" id="signup_password1" name="pass1" value="" class="vpb_textAreaBoxInputs"></div><br clear="all"><br clear="all">

                                                            <div style="width:100px; padding-top:10px;float:left;" align="left">Repeat Password:</div>
                                                            <div style="width:300px;float:left;" align="left"><input type="password" id="signup_password2" name="pass2" value="" class="vpb_textAreaBoxInputs"></div><br clear="all"><br clear="all">

                                                                    <div style="width:100px; padding-top:10px;margin-left:10px;float:left;" align="left">&nbsp;</div>
                                                                    <div style="width:300px;float:left;" align="left">
                                                                        <a href="javascript:void(0);" id="signup_button" class="vpb_general_button">Submit</a>

                                                                        <a href="javascript:void(0);" class="vpb_general_button" onClick="vpb_hide_popup_boxes();">Cancel</a>
                                                                    </div>

                                                                    <br clear="all"><br clear="all">
                                                                            </div>
                                                                            <!-- Sign Up Box Ends Here -->








                                                                            <!-- Login Box Starts Here -->
                                                                            <div id="vpb_login_pop_up_box" class="vpb_signup_pop_up_box">
                                                                                <div align="left" style="font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold;">TackIT Users Login</div><br clear="all">
                                                                                    <div align="left" style="font-family:Verdana, Geneva, sans-serif; font-size:11px;">To exit this login box, click on the cancel button or outside this box..</div><br clear="all"><br clear="all">

                                                                                            <div style="width:100px; padding-top:10px;float:left;" align="left">Your Username:</div>
                                                                                            <div style="width:300px;float:left;" align="left"><input type="text" id="login_username" name="usernames" value="" class="vpb_textAreaBoxInputs"></div><br clear="all"><br clear="all">

                                                                                                    <div style="width:100px; padding-top:10px;float:left;" align="left">Your Password:</div>
                                                                                                    <div style="width:300px;float:left;" align="left"><input type="password" id="login_password" name="passs" value="" class="vpb_textAreaBoxInputs"></div><br clear="all"><br clear="all">

                                                                                                            <div style="width:100px; padding-top:10px;margin-left:10px;float:left;" align="left">&nbsp;</div>
                                                                                                            <div style="width:300px;float:left;" align="left">

                                                                                                                <a href="javascript:void(0);" id="login_button" class="vpb_general_button">Login</a>

                                                                                                                <a href="javascript:void(0);" class="vpb_general_button" onClick="vpb_hide_popup_boxes();">Cancel</a>
                                                                                                            </div>

                                                                                                            <br clear="all"><br clear="all">
                                                                                                                    </div>

                                                                                                                    <script>
                                                                                                                    $(document).ready(function(e) {
       
                                                                                                                        $('#navbar_search').submit(function(e) {
                                                                                                                            e.preventDefault();
                                                                                                                            var search = $('#navbar_search_param').val();
                                                                                                                            window.location.href = "search_page.php?search=" + search;
                                                                                                                        });
       
                                                                                                                    });
                                                                                                                    </script>