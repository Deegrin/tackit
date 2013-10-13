/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {
    $('#signup_button').click(function(e) {
       var email = $("#signup_email").val();
       var username = $("#signup_username").val();
       var password = $("#signup_password").val();
       e.preventDefault();
       $.ajax({
        type: "POST",
        url: "../api/register.php",
        data: { email: email, username: username, password: password }
        })
        .done(function( msg ) {
            alert( "Data Saved: " + msg );
            $("#signup_email").val("");
            $("#signup_username").val("");
            $("#signup_password").val("");
        });
    });
});