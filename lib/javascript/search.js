
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
                alert("hey");
            }
        });

    });
});