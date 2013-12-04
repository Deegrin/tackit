
$(document).ready(function() {
    
    var user_id = $('#users_boards').data('user');
    
    $.ajax({
        type: "POST",
        dataType:'JSON',
        url: "../api/retrieveboard.php",
        data: {
            user: user_id
        },
        success: function(response) {
            for(i = 0; i < response.data.length; i++) {
                var tack_results_string = '<div class="panel panel-default">' +
                '<a href="board_page.php?id=' + response.data[i].id + '">' +
                '<div class="panel-body">' +
                '<div class="title">' + response.data[i].title + '</div>' +
                '<div class="description">' + response.data[i].description + '</div>' +
                '<button type="button" class="btn btn-primary right view-board"><a style="color:white" href="board_page.php?id=' + response.data[i].id + '">View Board</a></button>' +
                '</div>' +
                '</a>' +
                '</div>';

                $('#users_boards').append(tack_results_string);
            }
        }
    });

});