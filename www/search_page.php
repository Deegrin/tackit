<?php include "../lib/php/header.php"; ?>

<!--<link type="text/css" rel="stylesheet" href="../lib/css/search.css">-->
<script src="../lib/javascript/search.js"></script>
<link type="text/css" rel="stylesheet" href="../lib/css/boardList.css">
<link type="text/css" rel="stylesheet" href="../lib/css/userList.css">

<div class="row">
    <div class="col-lg-8 col-lg-offset-2">
        <form id="search_page_form" class="input-group">
            <input type="text" id="searchTerm" class="form-control" placeholder="Search">
            <div class="input-group-btn">
                <button type="submit" id="search" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                <button type="button" id="activeSearch" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Tacks</button>
                <ul class="dropdown-menu pull-right" role="menu">
                    <li><a id="searchTacks">Tacks</a></li>
                    <li><a id="searchBoards">Boards</a></li>
                    <li><a id="searchUsers">Users</a></li>
                </ul>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div id="searchResultType" class="col-lg-8 col-lg-offset-2">
    </div>
</div>

<div id="search_results">
</div>

<script src="../lib/masonry/masonry.pkgd.min.js"></script>

<?php
if (isset($_GET['search'])) {
    ?>
    <script> 
        $(document).ready(function() {
            var param = '<?php echo $_GET['search']; ?>';
            $('#searchTerm').val(param);
            $('#search_page_form').submit(); 
        });
    </script>
    <?php
}
?>


<?php include "../lib/php/footer.php"; ?>