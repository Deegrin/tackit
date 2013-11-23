
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
            }
        });
    })
    
    
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
    $('#search').click(function() {
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
                    $('#search_results').empty();
                    $('#searchResultType').html('<h3>Tack results for "' + search_param +'" (# results)</h3>');
                    $('#search_results').attr('class', 'tackResults col-md-12 center');
                    for(i = 0; i < response.data.length; i++) {
                        var tack_results_string = '<div class="tack">' +
                        '<div class="panel panel-default">' +
                        '<div class="panel-heading">' +
                        '<h6 class="panel-title">' + response.data[i].title + '</h6>' +
                        '<div class="btn-group btn-group-sm right">' +
                        '<button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-pushpin"></span></button>' +
                        '<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">' +
                        '<span class="caret"></span>' +
                        '</button>' +
                        '<ul class="dropdown-menu" role="menu">' +
                        '<li><a href="">Retack</a></li>' +
                        '<li><a href="#">Email</a></li>' +
                        '<li><a href="#">Favorite</a></li>' +
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