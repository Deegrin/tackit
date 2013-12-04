<?php include "../lib/php/header.php" ?>
<link type="text/css" rel="stylesheet" href="../lib/css/boardList.css">
<link type="text/css" rel="stylesheet" href="../lib/css/board.css">
<script src = "../lib/javascript/user_page.js"></script>

<?php
require_once '../lib/php/Board.php';
require_once '../lib/php/User.php';
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $user = User::getUserFromUserID($id);
        $username = $user[0]->get_username();
    
?>
<div class="dashboard row">

    <h3 style="text-align: center"> <?php echo $username ?>'s boards </h3>

<div id="users_boards" class="boardList" data-user="<?php echo $id ?>"></div>
    
</div>

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
