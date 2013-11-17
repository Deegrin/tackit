
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
        $.ajax({
            type: "POST",
            dataType:'json',
            url: "../api/search.php",
            data: {
                tack: search_param
            },
            success: function(response) {
                $('#search_results').empty();
                
                $('#search_results').attr('class', 'tackResults col-md-12 center');
                for(i = 0; i < response.data.length; i++) {
                    var tack_results_string = '<div class="tack">' +
                    '<div class="panel panel-default">' +
                        '<div class="panel-heading">' +
                            '<h6 class="panel-title">' + 'Panel Title' + '</h6>' +
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
                    //$('.panel-title').append(response.data[i].title);

                }
                $(function(){
                    var $container = $('#search_results');

                  $container.masonry({
                    itemSelector : '.tack'
                  });

                });
            }
        });


    });
});