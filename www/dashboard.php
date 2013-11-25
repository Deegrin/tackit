<?php include "../lib/php/header.php" ?>

<link type="text/css" rel="stylesheet" href="../lib/css/board.css">
<script src = "../lib/javascript/dashboard.js"></script>

<div class="dashboard row">
    <div class="col-sm-2">
        <ul id="dashboard-sidebar-nav" class="nav nav-pills nav-stacked">
            <li><a data-toggle="modal" href="#createTackModal">Create Tack</a></li>
            <li><a data-toggle="modal" href="#createBoardModal">Create Board</a></li>
            <li class="active"><a href="#feed" data-toggle="pill">Feed</a></li>
            <li><a href="#favorites" data-toggle="pill">Favorites</a></li>
            <li><a href="#self" data-toggle="pill">Own Tacks</a></li>
        </ul>
    </div>
    <div class="col-sm-10">
        <div id="content" class="tab-content">
            <div class="tab-pane active" id="home"> 
                <div class="tackResults col-md-12">

                    <!--                     <div id="tack0" class="tack">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h6 class="panel-title">Panel Title Panel Title Panel Title Panel Title</h6>
                                                    <div class="btn-group btn-group-sm right">
                                                        <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-pushpin"></span></button>
                                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu pull-right" role="menu">
                                                            <li><a data-toggle="modal" href="#viewTack">Retack</a></li>
                                                            <li><a href="#">Email</a></li>
                                                            <li><a href="#">Favorite</a></li>
                                                        </ul>
                                                    </div>
                    
                                                </div>
                    
                                                <div class="panel-body">
                                                    <img class="img-rounded" src="../lib/sample-images/image_1.jpg">
                                                </div>
                                                <div class="panel-footer">
                                                    hi al;sdfkj a;lkdfjl aeksjf;lasdfj; alkdfj l alsdkjf;ladj al;ksdfjl;saj lakssdjf ;aj ksf alksdfj;las f;lka dfl;kaj dfl;kjasd fla;kj df;laksj dflks;aj dflakjd flks djf;lalkjsd flaskdj ;lkasdfj aosdknf;ask
                                                    <div class="likes">
                                                        <a href="#"># likes</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                    
                                        <div id="tack1" class="tack">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h6 class="panel-title">Panel Title Panel Title Panel Title Panel Title</h6>
                                                    <div class="btn-group btn-group-sm right">
                                                        <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-pushpin"></span></button>
                                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu pull-right" role="menu">
                                                            <li><a href="#">Retack</a></li>
                                                            <li><a href="#">Email</a></li>
                                                            <li><a href="#">Favorite</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="panel-body">
                                                    <img class="img-rounded" src="../lib/sample-images/image_2.jpg">
                                                </div>
                                                <div class="panel-footer">
                                                    hi al;sdfkj a;lkdfjl aeksjf;lasdfj; alkdfj l alsdkjf;ladj al;ksdfjl;saj lakssdjf ;aj ksf alksdfj;las f;lka dfl;kaj dfl;kjasd fla;kj df;laksj dflks;aj dflakjd flks djf;lalkjsd flaskdj ;lkasdfj aosdknf;ask  
                                                    <div class="likes">
                                                        <a href="#"># likes</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                    
                                        <div id="tack2" class="tack">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h6 class="panel-title">Panel Title Panel Title Panel Title Panel Title</h6>
                                                    <div class="btn-group btn-group-sm right">
                                                        <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-pushpin"></span></button>
                                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu pull-right" role="menu">
                                                            <li><a href="#">Retack</a></li>
                                                            <li><a href="#">Email</a></li>
                                                            <li><a href="#">Favorite</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="panel-body">
                                                    <img class="img-rounded" src="../lib/sample-images/image_3.jpg">
                                                </div>
                                                <div class="panel-footer">
                                                    hi al;sdfkj a;lkdfjl aeksjf;lasdfj; alkdfj l alsdkjf;ladj al;ksdfjl;saj lakssdjf ;aj ksf alksdfj;las f;lka dfl;kaj dfl;kjasd fla;kj df;laksj dflks;aj dflakjd flks djf;lalkjsd flaskdj ;lkasdfj aosdknf;ask
                                                    <div class="likes">
                                                        <a href="#"># likes</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                    
                                        <div id="tack10" class="tack">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h6 class="panel-title">Panel Title Panel Title Panel Title Panel Title</h6>
                                                    <div class="btn-group btn-group-sm right">
                                                        <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-pushpin"></span></button>
                                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu pull-right" role="menu">
                                                            <li><a href="#">Retack</a></li>
                                                            <li><a href="#">Email</a></li>
                                                            <li><a href="#">Favorite</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="panel-body">
                                                    <img class="img-rounded" src="../lib/sample-images/floralhairtie.jpg">
                                                </div>
                                                <div class="panel-footer">
                                                    hi al;sdfkj a;lkdfjl aeksjf;lasdfj; alkdfj l alsdkjf;ladj al;ksdfjl;saj lakssdjf ;aj ksf alksdfj;las f;lka dfl;kaj dfl;kjasd fla;kj df;laksj dflks;aj dflakjd flks djf;lalkjsd flaskdj ;lkasdfj aosdknf;ask
                                                    <div class="likes">
                                                        <a href="#"># likes</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                    
                                        <div id="tack11" class="tack">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h6 class="panel-title">Panel Title Panel Title Panel Title Panel Title</h6>
                                                    <div class="btn-group btn-group-sm right">
                                                        <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-pushpin"></span></button>
                                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu pull-right" role="menu">
                                                            <li><a href="#">Retack</a></li>
                                                            <li><a href="#">Email</a></li>
                                                            <li><a href="#">Favorite</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="panel-body">
                                                    <img class="img-rounded" src="../lib/sample-images/meow.jpg">
                                                </div>
                                                <div class="panel-footer">
                                                    hi al;sdfkj a;lkdfjl aeksjf;lasdfj; alkdfj l alsdkjf;ladj al;ksdfjl;saj lakssdjf ;aj ksf alksdfj;las f;lka dfl;kaj dfl;kjasd fla;kj df;laksj dflks;aj dflakjd flks djf;lalkjsd flaskdj ;lkasdfj aosdknf;ask
                                                    <div class="likes">
                                                        <a href="#"># likes</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->  
                </div>
            </div>
            <div class="tab-pane" id="feed"> Feed </div>
            <div class="tab-pane" id="favorites"> Favorites </div>
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
            <form id="create_tack_form">
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
                <button id="submit_tack_create" type="submit" class="btn btn-danger">Save changes</button>
            </div>
        </form>
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
            <form id="create_board_form">
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
                    <button id="submit_board_create" type="submit" class="btn btn-danger">Save changes</button>
                </div>
            </form>
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