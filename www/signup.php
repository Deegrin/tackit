<?php include "../lib/php/header.php" ?>

<script src = "../lib/javascript/signup.js"></script>


<!-- Sign-up and Login Links Starts Here -->

<div class="par">
	<div style="width:400px; margin-top:50px;  display:inline-block;" align="center">

	<a href="javascript:void(0);" style="margin-left: 70px; float:left;" class="vpb_general_button" onClick="vpb_show_sign_up_box();">Sign Up</a>

	<a href="javascript:void(0);" style="float:right; margin-right:70px" class="vpb_general_button" onClick="vpb_show_login_box();">Login</a>

</div>
</div>

<br clear="all" />
<!-- Sign-up and Login Links Ends Here -->




<!-- Code Begins -->

<div id="vpb_pop_up_background"></div><!-- General Pop-up Background -->


<!-- Sign Up Box Starts Here -->
<div id="vpb_signup_pop_up_box">
<div align="left" style="font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold;">TackIT Signup</div><br clear="all">
<div align="left" style="font-family:Verdana, Geneva, sans-serif; font-size:11px;">To exit this sign-up box, click on the cancel button or outside this box..</div><br clear="all"><br clear="all">

<div style="width:100px; padding-top:10px;margin-left:10px;float:left;" align="left">Your Username:</div>
<div style="width:300px;float:left;" align="left"><input type="text" id="signup_username" name="usernames" value="" class="vpb_textAreaBoxInputs"></div><br clear="all"><br clear="all">

<div style="width:100px; padding-top:10px;margin-left:10px;float:left;" align="left">Email Address:</div>
<div style="width:300px;float:left;" align="left"><input type="text" id="signup_email" name="emails" value="" class="vpb_textAreaBoxInputs"></div><br clear="all"><br clear="all">

<div style="width:100px; padding-top:10px;margin-left:10px;float:left;" align="left">Password:</div>
<div style="width:300px;float:left;" align="left"><input type="password" id="signup_password1" name="pass1" value="" class="vpb_textAreaBoxInputs"></div><br clear="all"><br clear="all">

<div style="width:100px; padding-top:10px;margin-left:10px;float:left;" align="left">Repeat Password:</div>
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

<div style="width:100px; padding-top:10px;margin-left:10px;float:left;" align="left">Your Username:</div>
<div style="width:300px;float:left;" align="left"><input type="text" id="usernames" name="usernames" value="" class="vpb_textAreaBoxInputs"></div><br clear="all"><br clear="all">

<div style="width:100px; padding-top:10px;margin-left:10px;float:left;" align="left">Your Password:</div>
<div style="width:300px;float:left;" align="left"><input type="password" id="passs" name="passs" value="" class="vpb_textAreaBoxInputs"></div><br clear="all"><br clear="all">

<div style="width:100px; padding-top:10px;margin-left:10px;float:left;" align="left">&nbsp;</div>
<div style="width:300px;float:left;" align="left">

<a href="javascript:void(0);" class="vpb_general_button" onClick="alert('Hello There!\n\n There is no functionality associated with the button you have just clicked. \n\nThis is just a demonstration of Pop-up Boxes and that\'s all.\n\nThanks.');">Login</a>

<a href="javascript:void(0);" class="vpb_general_button" onClick="vpb_hide_popup_boxes();">Cancel</a>
</div>

<br clear="all"><br clear="all">
</div>

<?php include "../lib/php/footer.php" ?>
