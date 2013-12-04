/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function tack_feed_to_dom(board_list, id) {
    
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "../api/retrievetack.php",
        data: {
            board: id
        },
        success: function(response) {
            tack_loader(response, '#boards_tacks', board_list);
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
    var id = $('#boards_tacks').data('board');
    tack_feed_to_dom(board_list, id);

    var $container = $('.tackResults');
    $container.imagesLoaded(function() {
        $container.masonry({
            itemSelector: '.tack'
        });
    });

});

