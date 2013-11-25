<?php include "../lib/php/header.php" ?>

<link type="text/css" rel="stylesheet" href="../lib/css/board.css">
<script src = "../lib/javascript/dashboard.js"></script>

<div class="dashboard row">
    <div class="col-sm-2">
        <ul id="dashboard-sidebar-nav" class="nav nav-pills nav-stacked">
            <li><a data-toggle="modal" href="#createTackModal">Create Tack</a></li>
            <li><a data-toggle="modal" href="#createBoardModal">Create Board</a></li>
            <li id="feedButton" class="active"><a href="#feed" data-toggle="pill">Feed</a></li>
            <li id="favoriteButton"><a href="#favorites" data-toggle="pill">Favorites</a></li>
            <li id="selfButton"><a href="#self" data-toggle="pill">Own Tacks</a></li>
        </ul>
    </div>
    <div class="col-sm-10">
        <div id="content" class="tab-content">
            <div class="tab-pane active" id="feed">

            </div>
            <div class="tab-pane" id="favorites"> 

            </div>
            <div class="tab-pane" id="self"> Self </div>
        </div> 
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="createTackModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <h4 class="modal-title">Create Tack</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input id="form_create_tack_title" type="text" placeholder="Title" class="form-control">
                </div>

                <div class="form-group">
                    <input id="form_create_tack_description" type="text" placeholder="Description" class="form-control">
                </div>

                <div class="form-group">
                    <input id="form_create_tack_url" type="text" placeholder="URL" class="form-control">
                </div>

                <div class="form-group">
                    <input id="form_create_tack_img" type="text" placeholder="Image URL" class="form-control">
                </div>
                
                <select id="form_create_tack_board_dropdown" class="form-control">
                </select>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="submit_tack_create" type="button" class="btn btn-danger">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal -->
<div class="modal fade" id="createBoardModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <h4 class="modal-title">Create Board</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input id="form_create_board_title" type="text" placeholder="Title" class="form-control">
                </div>

                <div class="form-group">
                    <input id="form_create_board_description" type="text" placeholder="Description" class="form-control">
                </div>


                <div id="board_access" class="btn-group" data-toggle="buttons">
                     <label class="btn  btn-sm btn-info">
                        <input type="radio" name="board_access" value="1"> Private
                    </label>
                    <label class="btn active btn-sm btn-info">
                        <input type="radio" name="board_access" value="0" checked="checked"> Public
                    </label>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="submit_board_create" type="button" class="btn btn-danger">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="viewTack" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            
          <h4 class="modal-title">View Tack</h4>
       </div>
         <div class="modal-body">
        <div class="form-group">
              <input type="text" placeholder="Title" class="form-control">
        </div>
              
            <button type="button" class="btn btn-primary btn-lg btn-block">Favorite</button>
            <button type="button" class="btn btn-primary btn-lg btn-block">Retack</button>
            <button type="button" class="btn btn-primary btn-lg btn-block">Follow Board</button>
                
        
        </div>
        
        <div class="modal-footer">
        
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


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

<?php include "../lib/php/footer.php" ?>