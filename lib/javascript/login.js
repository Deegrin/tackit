/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * This class uses Javascript to send an AJAX call to our server. The AJAX call
 * accesses the login.php function, and redirects the User to the dashboard if
 * the function returned true
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
            dataType:'json',
            url: "../api/login.php",
            data: { id: username, password: password },
            success: function(response) {
                $("#login_username").val("");
                $("#login_password").val("");
                if(response.error == true) {
                    alert(response.data);
                }
                else {
                    window.location = "dashboard.php"
                }
            }
          });
       }
    });
});