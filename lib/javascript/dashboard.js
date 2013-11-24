/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function tack_feed_to_dom() {
    console.log("cake");
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "../api/retrievetack.php",
        data: {
            feed: "1"
        },
        success: function(response) {
            tack_loader(response);
        }
    });

    // $.ajax({
    //     type: "POST",
    //     dataType: 'json',
    //     url: "../api/retrievetack.php",
    //     data: {
    //         favorite: "1"
    //     },
    //     success: function(response) {
    //         tack_loader(response);
    //     }
    // });
}  
function tack_loader(response) {
                for(i = 0; i < response.data.length; i++) {
                    var tack_string = '<div class="tack">' +
                    '<div class="panel panel-default">' +
                    '<div class="panel-heading">' +
                    '<h6 class="panel-title">' + response.data[i].title + '</h6>' +
                    '<div class="btn-group btn-group-sm right">' +
                    '<button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-pushpin"></span></button>' +
                    '<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">' +
                    '<span class="caret"></span>' +
                    '</button>' +
                    '<ul class="dropdown-menu" role="menu">' +
                    '<li><a href="#" data-tack=' + response.data[i].id + ' class="retack-tack">Retack</a></li>' +
                    '<li><a href="#" data-tack=' + response.data[i].id + ' class="email-tack">Email</a></li>' +
                    '<li><a href="#" data-tack=' + response.data[i].id + ' class="favorite-tack">Favorite</a></li>' +
                    '</ul>' +
                    '</div>' +
                    '</div>' +
                    '<div class="panel-body"><img class="img-rounded" src="' + response.data[i].imageURL + '"></div>' +
                    '<div class="panel-footer">' + response.data[i].description +
                    '<div class="likes">' +
                    '<a href="#"># likes</a>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +           
                    '</div>';
                    $('.tackResults').append(tack_string);
                }
                $(function(){
                    var $container = $('.tackResults');

                    $container.masonry('destroy');
                    $container.masonry({
                        itemSelector : '.tack'
                    });
                });
}
$(document).ready(function() {
      
    tack_feed_to_dom();
    

 
    $('#submit_board_create').click(function() {
        var title = $("#form_create_board_title").val();
        var description = $("#form_create_board_description").val();
        var access = $('input[name=board_access]:checked').val();
        if(title == "" || title == null || description == "" || description == null) {
            alert("Please fill out all fields");
        }
        else {
            $.ajax({
                type: "POST",
                dataType:'json',
                url: "../api/createboard.php",
                data: {
                    title: $("#form_create_board_title").val(), 
                    desc: $("#form_create_board_description").val(),
                    private: access
                },
                success: function(response) {
                    if(response.error == true) {
                        alert("Error: " + response.data);
                    }
                    else {
                        $("#createBoardModal").modal("hide");
                    }
                }
            });
        }
        $("#form_create_board_title").val("");
        $("#form_create_board_description").val("");
    });
    
    $('#submit_tack_create').click(function() {
        var title = $("#form_create_tack_title").val();
        var description = $("#form_create_tack_description").val();
        var url = $("#form_create_tack_url").val();
        var img = $("#form_create_tack_img").val();
        var board_id = $("#form_create_tack_board_dropdown").val();
        if(title == "" || title == null || description == "" || description == null || url == "" || url == null || img == "" || img == null) {
            alert("Please fill out all fields");
        }
        else {
            $.ajax({
                type: "POST",
                dataType:'json',
                url: "../api/createtack.php",
                data: {
                    board: board_id,
                    title: title,
                    desc: description,
                    url: url,
                    image: img
                },
                success: function(response) {
                    if(response.error == true) {
                        alert("Error: " + response.data);
                    }
                    else {
                        $("#createTackModal").modal("hide");
                    }
                }
            });
        }
        $("##form_create_tack_title").val("");
        $("#form_create_tack_description").val("");
        $("#form_create_tack_url").val("");
        $("#form_create_tack_img").val("");

    });
    
    $.ajax({
        type: "POST",
        dataType:'json',
        url: "../api/retrieveboard.php",
        data: {
            own: "username"
        },
        success: function(response) {
            if(response.error == false) {
                for(i = 0; i < response.data.length; i++) {
                    $("#dashboard-sidebar-nav").append('<li><a href="#following_board_' + response.data[i].id + '" data-toggle="pill">' + response.data[i].title + '</a></li>');
                    $('#content').append('<div class="tab-pane" id="following_board_' + response.data[i].id + '">' + response.data[i].title + '</div>');
                    $('#form_create_tack_board_dropdown').append('<option value="' + response.data[i].id + '">' + response.data[i].title + '</option>');
                }
            }
        }
    });
 
});

