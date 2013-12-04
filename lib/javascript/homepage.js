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
   }
});