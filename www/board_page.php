<?php include "../lib/php/header.php" ?>
<link type="text/css" rel="stylesheet" href="../lib/css/boardList.css">
<link type="text/css" rel="stylesheet" href="../lib/css/board.css">
<script src = "../lib/javascript/board_page.js"></script>

<?php
require_once '../lib/php/Board.php';
require_once '../lib/php/User.php';
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $board = Board::getBoardFromID($id);
        $title = $board->get_title();
        $description = $board->get_description();
        $user_array = User::getUserFromUserID($board->get_user_id());
        $username = $user_array[0]->get_username();
        
    
?>
<div class="dashboard row">

    <h3 style="text-align: center"> <?php echo $title ?> </h3>
    <p style="text-align: center"> <?php echo $description ?> </p>
    <h4 style="text-align: center"> User: <?php echo $username ?> </h4>

<div id="boards_tacks" data-board="<?php echo $id ?>"></div>
    
</div>

<script src="../lib/masonry/masonry.pkgd.min.js"></script>
<script src="../lib/masonry/bower_components/imagesloaded/imagesloaded.js"></script>

<script>
    //Masonry organizing tacks
    $(function(){
        var $container = $('.tackResults');

        $container.masonry({
            itemSelector : '.tack'
        });

        //Gives each tack it's own ID
        // $(".tack").each(function(index) {
        //     $(this).attr("id", "tack"+index);
        // });
    });
</script>

<?php
    }
    else {
        ?>
<script> 

    window.location = "dashboard.php";

</script>
        <?php
    }
?>
