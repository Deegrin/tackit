/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function tack_feed_to_dom_extension(id, id1, board_list){
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "../api/retrievetack.php",
        data: {
            board: id
        },
        success: function(response) {
            tack_loader(response, id1, board_list);
        }
    });
}

function tack_feed_to_dom(board_list) {
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "../api/retrievetack.php",
        data: {
            feed: "1"
        },
        success: function(response) {
            tack_loader(response, '#feed', board_list);
        }
    });

    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "../api/retrievetack.php",
        data: {
            favorite: "1"
        },
        success: function(response) {
            tack_loader(response, '#favorites', board_list, false);
        }
    });
    
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "../api/retrievetack.php",
        data: {
            own: "1"
        },
        success: function(response) {
            tack_loader(response, '#self', board_list, false);
        }
    });

// $.ajax({
//     type: "POST",
//     dataType: 'json',
//     url: "../api/retrievetack.php",
//     data: {
//         self: "1"
//     },
//     success: function(response) {
//         tack_loader(response, '#self');
//     }
// });
}  
function tack_loader(response, container, board_list) {
    $(container).append('<div class="tackResults">');
    for(i = 0; i < response.data.length; i++) {
        var tack_string = 
        '<div class="tack">' +
        '<div class="panel panel-default">' +
        '<div class="panel-heading">' +
        '<h6 class="panel-title">' + response.data[i].title + '</h6>' +
        '<div class="btn-group btn-group-sm right">';
        if(container != '#feed') {
            tack_string += '<button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-pushpin"></span></button>';
        }
        tack_string +=
        '<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">' +
        '<span class="caret"></span>' +
        '</button>' +
        '<ul class="dropdown-menu" role="menu">' +
        '<li class="dropdown-submenu">' +
        '<a tabindex="-1" href="#">Retack</a>' +
        '<ul class="dropdown-menu">';
        for(j = 0; j < board_list.length; j++) {
            tack_string += '<li><a href="#" data-board=' + board_list[j].id + ' data-tack=' + response.data[i].id + ' class="retack-tack">' + board_list[j].title + '</a></li>';
        }
        tack_string += '</ul>' +
        '</li>' +
        '<li><a href="#" data-tack=' + response.data[i].id + ' class="email-tack">Email</a></li>' +
        '<li><a href="#" data-tack=' + response.data[i].id + ' class="favorite-tack">Favorite</a></li>';
        if(container != '#feed' && container != '#favorites') {
            tack_string += '<li><a href="#" data-tack=' + response.data[i].id + ' class="delete-tack">Delete</a></li>';
        }
        tack_string +=
        '</ul>' +
        '</div>' +
        '</div>' +
        '<a href="' + response.data[i].tackUrl + '">' +
        '<div class="panel-body"><img class="img-rounded" src="' + response.data[i].imageURL + '"></div>' +
        '</a>' +
        '<div class="panel-footer">' + response.data[i].description +
        '<div class="likes">' +
        '<a href="#"># likes</a>' +
        '</div>' +
        '</div>' +
        '</div>' +           
        '</div>' +
        '</div>';
        $(container).children('.tackResults').append(tack_string);
    }
    $(container).append('</div>');
    $(function(){
        var $container = $(container);

        // $container.masonry({    
        //     itemSelector : '.tack'
        // });
        $container.masonry('destroy');
        $container.masonry({
            itemSelector : '.tack'
        });

    // $container.css("width", $container.css("width")-1);
    // $container.imagesLoaded( function() {
    //       itemSelector: '.tack',
    //       animate: true
    // });

    });
}
$(document).ready(function() {
    
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "../api/retrieveboard.php",
        data: {
            following: "1"
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

                $('#boardsFollowing').append(tack_results_string);
            }  
        }
    });
    
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "../api/retrieveuser.php",
        data: {
            following: "1"
        },
        success: function(response) {
            for(i = 0; i < response.data.length; i++){
                var tack_results_string = '<div class="userList col-sm-8 col-sm-offset-2">' +
                '<a href="user_page.php?id=' + response.data[i].id + '">' +
                '<div class="panel panel-default">' +
                '<div class="panel-body">' +
                '<img id="userAvatar" class="avatar" align="left" src="../lib/sample-avatars/avatar_1.jpg"></img>' +
                '<div class="title">' + response.data[i].username + '</div>' +
                '<div id="user0FollowCount" class="followCount">' + '# Followers' + '</div>' +
                '</div>' +
                '</div>' +
                '</a>' +
                '</div>';

                $('#usersFollowing').append(tack_results_string);
            }
        }
    });
    
    var user_dashboard_id;
    var board_list = [];
    $.ajax({
        async: false,
        type: "POST",
        dataType:'json',
        url: "../api/retrieveboard.php",
        data: {
            own: "username"
        },
        success: function(response) {
            if(response.error == false) {
                for(i = 0; i < response.data.length; i++) {
                    board_list.push(response.data[i]);
                    if(response.data[i].title == "Dashboard") {
                        user_dashboard_id = response.data[i].id;
                    }
                }
            }
        }
    });
    tack_feed_to_dom(board_list);

    $('#feedButton').click(function() {
        var $container = $('.tackResults');
        $container.imagesLoaded(function() {
            $container.masonry({
                itemSelector: '.tack'
            });
        });
    });
    
    $('#selfButton').click(function() {
        var $container = $('.tackResults');
        $container.imagesLoaded(function() {
            $container.masonry({
                itemSelector: '.tack'
            });
        });
    });
    
    $('#favoriteButton').click(function() {
        var $container = $('.tackResults');
        $container.imagesLoaded(function() {
            $container.masonry({
                itemSelector: '.tack'
            });
        });
    });
 
    $('#create_board_form').submit(function() {
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
    
    $('#create_tack_form').submit(function() {
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
                        console.log("yoooooo");
                        console.log(response);
                    }
                }
            });
        }
        $("#form_create_tack_title").val("");
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
                var user_dashboard_id;
                var board_list = [];
                $.ajax({
                    async: false,
                    type: "POST",
                    dataType:'json',
                    url: "../api/retrieveboard.php",
                    data: {
                        own: "username"
                    },
                    success: function(response) {
                        if(response.error == false) {
                            for(i = 0; i < response.data.length; i++) {
                                board_list.push(response.data[i]);
                                if(response.data[i].title == "Dashboard") {
                                    user_dashboard_id = response.data[i].id;
                                }
                            }
                        }
                    }
                });
                for(i = 0; i < response.data.length; i++) {
                    $("#dashboard-sidebar-nav").append('<li id="'+ response.data[i].id +'Button"><a href="#following_board_' + response.data[i].id + '" data-toggle="pill">' + response.data[i].title + '</a></li>');

                    $('#content').append('<div class="tab-pane" id="following_board_' + response.data[i].id + '"></div>');
                    $('#form_create_tack_board_dropdown').append('<option value="' + response.data[i].id + '">' + response.data[i].title + '</option>');
                    var following = "#following_board_" + response.data[i].id;
                    if(response.data[i].id != user_dashboard_id) {
                        var delete_button = '<button type="button" data-board=' + response.data[i].id + ' class="btn btn-danger delete-board">Delete Board</button>';
                        $(following).append(delete_button);
                    }
                    tack_feed_to_dom_extension(response.data[i].id, following, board_list);

                    $('#' + response.data[i].id +'Button').click(function() {
                        var $container = $('.tackResults');
                        $container.imagesLoaded(function() {
                            $container.masonry({
                                itemSelector: '.tack'
                            });
                        });
                    });
                }
            }
        }
    });
 
});

