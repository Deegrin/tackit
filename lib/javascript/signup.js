/* 
 * This javascript takes form input from the signup modal and accesses the 
 * signup.php API call that our server provides.
 * 
 */

$(document).ready(function() {
    $('#signup_button').click(function(e) {
       var email = $("#signup_email").val();
       var username = $("#signup_username").val();
       var password1 = $("#signup_password1").val();
       var password2 = $("#signup_password2").val();
       e.preventDefault();
       if(email == "" || username == "" || password1 == "" || password2 == "") {
           alert("Please fill out entire form");
       }
       else if(password1 != password2) {
           alert("Passwords do not match");
       }
       else {
        $.ajax({
            type: "POST",
            url: "../api/register.php",
            data: { email: email, username: username, password: password1 },
            success: function(response) {
                alert( "Please view email to confirm registration" );
                $("#signup_email").val("");
                $("#signup_username").val("");
                $("#signup_password1").val("");
                $("#signup_password2").val("");
            }
          });
       }
    });
});