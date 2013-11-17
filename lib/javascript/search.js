
$(document).ready(function() {

    $('#searchTacks').click(function() {
        $('#activeSearch').html("Tacks");
    });

    $('#searchBoards').click(function() {
        $('#activeSearch').html("Boards");
    });

    $('#searchUsers').click(function() {
        $('#activeSearch').html("Users");
    });

    $('#search').click(function() {
        var search_param = $('#searchTerm').val();
        var msg;
        if($('#activeSearch').text() == "Tacks")
            msg = {tack: search_param};
        else if($('#activeSearch').text() == "Boards")
            msg = {board: search_param};
        else
            msg = {user: search_param};

        $.ajax({
            type: "POST",
            dataType:'JSON',
            url: "../api/search.php",
            data: msg,
            success: function(response) {

                if($('#activeSearch').text() == "Tacks"){
                    $('#search_results').empty();
                    
                    $('#search_results').attr('class', 'tackResults col-md-12 center');
                    for(i = 0; i < response.data.length; i++) {
                        var tack_results_string = '<div class="tack">' +
                        '<div class="panel panel-default">' +
                            '<div class="panel-heading">' +
                                '<h6 class="panel-title">' + response.data[i].title + '</h6>' +
                                '<div class="btn-group btn-group-sm right1">' +
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

                    $('#search_results').attr('class', 'boardList col-sm-8 col-sm-offset-2')
                    for(i = 0; i < response.data.length; i++) {
                        var tack_results_string = '<div class="panel panel-default">' +
                            '<a href="#test">' +
                                '<div class="panel-body">' +
                            '<div class="title">' + response.data[i].title + '</div>' +
                            '<div class="description">' + response.data[i].description + '</div>' +
                            '<button type="button" class="btn btn-primary right">Follow</button>' +
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