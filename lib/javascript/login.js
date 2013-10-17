/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {
    $('#login_button').click(function(e) {
       var username = $("#login_username").val();
       var password = $("#login_password").val();
       e.preventDefault();
       if(username == "" || password == "") {
           alert("Please fill out entire form");
       }
       else {
        $.ajax({
            type: "POST",
            url: "../api/login.php",
            data: { id: username, password: password }
            })
        .done(function( msg ) {
            alert( "Data Saved: " + msg );
            $("#login_username").val("");
            $("#login_password").val("");
        });
       }
    });
});