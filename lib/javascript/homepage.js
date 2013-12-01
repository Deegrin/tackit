$(document).ready(function () {
   if (purl().param('verify') !== undefined) {
       $.ajax({
           type: "POST",
           dataType: "json",
           url: "../api/relate.php",
           data: { verify: purl().param('verify') },
           success: function (response) {
               if (response.error === false)
                   alert("Your account has been verified!");
               else
                   alert(response.data);
           }
       });
       
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