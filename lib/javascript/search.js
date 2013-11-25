
$(document).ready(function() {
    
    $(document).on('click', ".follow-board", function() {
        var board_id = $(this).data('board');
        $.ajax({
            type: "POST",
            dataType:'json',
            url: "../api/relate.php",
            data: {
                board: board_id
            },
            success: function(response) {
                if(response.error == true) {
                    alert("Error: " + response.data);
                }
                else {
                    alert("Following Board");
                }
            }
        });
    });
    
    $(document).on('click', ".follow-user", function() {
        var user_id = $(this).data('user');
        $.ajax({
            type: "POST",
            dataType:'json',
            url: "../api/relate.php",
            data: {
                user: user_id
            },
            success: function(response) {
                if(response.error == true) {
                    alert("Error: " + response.data);
                }
                else {
                    alert("Following User");
                }
            }
        });
    });
    
    $(document).on('click', ".retack-tack", function() {
        var tack_id = $(this).data('tack');
        var board_id = $(this).data('board');
        $.ajax({
            type: "POST",
            dataType:'json',
            url: "../api/relate.php",
            data: {
                retackTack: tack_id,
                retackBoard: board_id
            },
            success: function(response) {
                if(response.error == true) {
                    alert("Error: " + response.data);
                }
                else {
                    alert("Retacked Tack " + tack_id + "to" + board_id);
                }
            }
        });  
    });
    
    $(document).on('click', ".email-tack", function() {
        alert("Email" + $(this).data("tack"));
        
    });
    
    $(document).on('click', "a.favorite-tack", function() {
        var tack_id = $(this).data('tack');
        $.ajax({
            type: "POST",
            dataType:'json',
            url: "../api/relate.php",
            data: {
                favorite: tack_id
            },
            success: function(response) {
                if(response.error == true) {
                    alert("Error: " + response.data);
                }
                else {
                    alert("Favorited Tack " + tack_id);
                }
            }
        });       
        
    });
    
    $(document).on('click', ".quickretack-tack", function() {
        var tack_id = $(this).data('tack');
        var user_dashboard_id = $(this).data('user-dashboard-id');
        $.ajax({
            type: "POST",
            dataType:'json',
            url: "../api/relate.php",
            data: {
                retackTack: tack_id,
                retackBoard: user_dashboard_id
            },
            success: function(response) {
                if(response.error == true) {
                    alert("Error: " + response.data);
                }
                else {
                    alert("Retacked Tack " + tack_id + "to Dashboard");
                }
            }
        });       
    });
    
    
    //Changes the text of the search type button.
    $('#searchTacks').click(function() {
        $('#activeSearch').html("Tacks");
    });

    $('#searchBoards').click(function() {
        $('#activeSearch').html("Boards");
    });

    $('#searchUsers').click(function() {
        $('#activeSearch').html("Users");
    });

    //This function will take the search parameter and type and return results accordingly.
    $('#search_page_form').submit(function(e) {
        e.preventDefault();
        var search_param = $('#searchTerm').val();
        var msg;
        if($('#activeSearch').text() == "Tacks")
            msg = {
                tack: search_param
            };
        else if($('#activeSearch').text() == "Boards")
            msg = {
                board: search_param
            };
        else
            msg = {
                user: search_param
            };

        $.ajax({
            type: "POST",
            dataType:'JSON',
            url: "../api/search.php",
            data: msg,
            success: function(response) {

                if($('#activeSearch').text() == "Tacks"){
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
                    $('#search_results').empty();
                    $('#searchResultType').html('<h3>Tack results for "' + search_param +'" (# results)</h3>');
                    $('#search_results').attr('class', 'tackResults col-md-12 center');
                    for(i = 0; i < response.data.length; i++) {
                        var tack_results_string = '<div class="tack">' +
                        '<div class="panel panel-default">' +
                        '<div class="panel-heading">' +
                        '<h6 class="panel-title">' + response.data[i].title + '</h6>' +
                        '<div class="btn-group btn-group-sm right">' +
                        '<button type="button" data-tack=' + response.data[i].id + ' data-user-dashboard-id=' + user_dashboard_id + ' class="btn btn-primary quickretack-tack"><span class="glyphicon glyphicon-pushpin"></span></button>' +
                        '<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">' +
                        '<span class="caret"></span>' +
                        '</button>' +
                        '<ul class="dropdown-menu" role="menu">' +
                        '<li class="dropdown-submenu">' +
                        '<a tabindex="-1" href="#">Retack</a>' +
                        '<ul class="dropdown-menu">';
                        for(j = 0; j < board_list.length; j++) {
                            tack_results_string += '<li><a href="#" data-board=' + board_list[j].id + ' data-tack=' + response.data[i].id + ' class="retack-tack">' + board_list[j].title + '</a></li>';
                        }
                        tack_results_string += '</ul>' +
                        '</li>' +
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

                        $('#search_results').append(tack_results_string);
                    }
                    $(function(){
                        var $container = $('#search_results');

                        $container.masonry('destroy')
                        $container.masonry({
                            itemSelector : '.tack'
                        });
                    });
                }

                if($('#activeSearch').text() == "Boards"){
                    $('#search_results').empty();
                    $('#searchResultType').html('<h3>Board results for "' + search_param + '" (# results)</h3>');
                    $('#search_results').attr('class', 'boardList col-sm-8 col-sm-offset-2');
                    for(i = 0; i < response.data.length; i++) {
                        var tack_results_string = '<div class="panel panel-default">' +
                        '<a href="#test">' +
                        '<div class="panel-body">' +
                        '<div class="title">' + response.data[i].title + '</div>' +
                        '<div class="description">' + response.data[i].description + '</div>' +
                        '<button type="button" data-board=' + response.data[i].id + ' class="btn btn-primary right follow-board">Follow</button>' +
                        '</div>' +
                        '</a>' +
                        '</div>';

                        $('#search_results').append(tack_results_string);
                    }

                }

                if($('#activeSearch').text() == "Users"){
                    $('#search_results').empty();
                    $('#searchResultType').html('<h3>User results for "' + search_param + '" (# results)</h3>');
                    $('#search_results').attr('class', 'boardList col-sm-8 col-sm-offset-2');
                    for(i = 0; i < response.data.length; i++){
                        var tack_results_string = '<div class="userList col-sm-8 col-sm-offset-2">' +
                        '<a href="#test">' +
                        '<div class="panel panel-default">' +
                        '<div class="panel-body">' +
                        '<img id="userAvatar" class="avatar" align="left" src="../lib/sample-avatars/avatar_1.jpg"></img>' +
                        '<div class="title">' + response.data[i].username + '</div>' +
                        '<div id="user0FollowCount" class="followCount">' + '# Followers' + '</div>' +
                        '<button type="button" data-user=' + response.data[i].id + ' class="btn btn-primary right follow-user">Follow</button>' +
                        '</div>' +
                        '</div>' +
                        '</a>' +
                        '</div>';

                        $('#search_results').append(tack_results_string);
                    }
                }
            }
        });
    });
});