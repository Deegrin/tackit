
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
		$('#searchTerm').val("");

    });

	});
});