/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {
    
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
        $("#form_create_board_title").val("");
        $("#form_create_board_description").val("");
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
                    $("#dashboard-sidebar-nav").append('<li><a href="#following_board_' + response.data[i].title + '" data-toggle="pill">' + response.data[i].title + '</a></li>');
                    $('#form_create_tack_board_dropdown').append('<option value="' + response.data[i].id + '">' + response.data[i].title + '</option>');
                }
            }
        }
    });
    
});

