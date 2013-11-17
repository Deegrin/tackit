<?php include "../lib/php/header.php";?>

<link type="text/css" rel="stylesheet" href="../lib/css/search.css">
<script src="../lib/javascript/search.js"></script>
<link type="text/css" rel="stylesheet" href="../lib/css/boardList.css">
<link type="text/css" rel="stylesheet" href="../lib/css/userList.css">

	<div class="row">
	    <div class="col-lg-8 col-lg-offset-2">
		    <div class="input-group">
		    	<input type="text" id="searchTerm" class="form-control" placeholder="Search">
			    <div class="input-group-btn">
			    	<button type="button" id="search" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
					<button type="button" id="activeSearch" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Tacks</button>
						<ul class="dropdown-menu pull-right" role="menu">
							<li><a id="searchTacks">Tacks</a></li>
							<li><a id="searchBoards">Boards</a></li>
							<li><a id="searchUsers">Users</a></li>
						</ul>
			    </div>
		    </div>
	    </div>
	</div>

	<div class="row">
		<div class="col-lg-8 col-lg-offset-2">
			<h3>Tack results for "?????" (# results)</h3>
		</div>
	</div>

	<div id="search_results">
<!-- 
		<div id="tack0" class="tack">
			<div class="panel panel-default">
	  			<div class="panel-heading">
	    			<h6 class="panel-title">Panel Title Panel Title Panel Title Panel Title</h6>
		    			<div class="btn-group btn-group-sm right">
							<button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-pushpin"></span></button>
							<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu" role="menu">
								<li><a href="">Retack</a></li>
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
							<ul class="dropdown-menu" role="menu">
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
							<ul class="dropdown-menu" role="menu">
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

		<div id="tack3" class="tack">
			<div class="panel panel-default">
	  			<div class="panel-heading">
	    			<h6 class="panel-title">Panel Title Panel Title Panel Title Panel Title</h6>
		    			<div class="btn-group btn-group-sm right">
							<button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-pushpin"></span></button>
							<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu" role="menu">
								<li><a href="#">Retack</a></li>
								<li><a href="#">Email</a></li>
								<li><a href="#">Favorite</a></li>
							</ul>
						</div>
	  			</div>
		  		<div class="panel-body">
					<img class="img-rounded" src="../lib/sample-images/image_4.jpg">
		  		</div>
		  		<div class="panel-footer">
		  			hi al;sdfkj a;lkdfjl aeksjf;lasdfj; alkdfj l alsdkjf;ladj al;ksdfjl;saj lakssdjf ;aj ksf alksdfj;las f;lka dfl;kaj dfl;kjasd fla;kj df;laksj dflks;aj dflakjd flks djf;lalkjsd flaskdj ;lkasdfj aosdknf;ask
					<div class="likes">
						<a href="#"># likes</a>
					</div>
		  		</div>
			</div>
		</div>

		<div id="tack4" class="tack">
			<div class="panel panel-default">
	  			<div class="panel-heading">
	    			<h6 class="panel-title">Panel Title Panel Title Panel Title Panel Title</h6>
		    			<div class="btn-group btn-group-sm right">
							<button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-pushpin"></span></button>
							<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu" role="menu">
								<li><a href="#">Retack</a></li>
								<li><a href="#">Email</a></li>
								<li><a href="#">Favorite</a></li>
							</ul>
						</div>
	  			</div>
		  		<div class="panel-body">
					<img class="img-rounded" src="../lib/sample-images/image_5.jpg">
		  		</div>
		  		<div class="panel-footer">
		  			hi al;sdfkj a;lkdfjl aeksjf;lasdfj; alkdfj l alsdkjf;ladj al;ksdfjl;saj lakssdjf ;aj ksf alksdfj;las f;lka dfl;kaj dfl;kjasd fla;kj df;laksj dflks;aj dflakjd flks djf;lalkjsd flaskdj ;lkasdfj aosdknf;ask
					<div class="likes">
						<a href="#"># likes</a>
					</div>
		  		</div>
			</div>
		</div>

		<div id="tack5" class="tack">
			<div class="panel panel-default">
	  			<div class="panel-heading">
	    			<h6 class="panel-title">Panel Title Panel Title Panel Title Panel Title</h6>
		    			<div class="btn-group btn-group-sm right">
							<button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-pushpin"></span></button>
							<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu" role="menu">
								<li><a href="#">Retack</a></li>
								<li><a href="#">Email</a></li>
								<li><a href="#">Favorite</a></li>
							</ul>
						</div>
	  			</div>
		  		<div class="panel-body">
					<img class="img-rounded" src="../lib/sample-images/image_6.jpg">
		  		</div>
		  		<div class="panel-footer">
		  			hi al;sdfkj a;lkdfjl aeksjf;lasdfj; alkdfj l alsdkjf;ladj al;ksdfjl;saj lakssdjf ;aj ksf alksdfj;las f;lka dfl;kaj dfl;kjasd fla;kj df;laksj dflks;aj dflakjd flks djf;lalkjsd flaskdj ;lkasdfj aosdknf;ask
					<div class="likes">
						<a href="#"># likes</a>
					</div>
		  		</div>
			</div>
		</div>

		<div id="tack6" class="tack">
			<div class="panel panel-default">
	  			<div class="panel-heading">
	    			<h6 class="panel-title">Panel Title Panel Title Panel Title Panel Title</h6>
		    			<div class="btn-group btn-group-sm right">
							<button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-pushpin"></span></button>
							<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu" role="menu">
								<li><a href="#">Retack</a></li>
								<li><a href="#">Email</a></li>
								<li><a href="#">Favorite</a></li>
							</ul>
						</div>
	  			</div>
		  		<div class="panel-body">
					<img class="img-rounded" src="../lib/sample-images/image_7.jpg">
		  		</div>
		  		<div class="panel-footer">
		  			hi al;sdfkj a;lkdfjl aeksjf;lasdfj; alkdfj l alsdkjf;ladj al;ksdfjl;saj lakssdjf ;aj ksf alksdfj;las f;lka dfl;kaj dfl;kjasd fla;kj df;laksj dflks;aj dflakjd flks djf;lalkjsd flaskdj ;lkasdfj aosdknf;ask
					<div class="likes">
						<a href="#"># likes</a>
					</div>
		  		</div>
			</div>
		</div>

		<div id="tack7" class="tack">
			<div class="panel panel-default">
	  			<div class="panel-heading">
	    			<h6 class="panel-title">Panel Title Panel Title Panel Title Panel Title</h6>
		    			<div class="btn-group btn-group-sm right">
							<button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-pushpin"></span></button>
							<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu" role="menu">
								<li><a href="#">Retack</a></li>
								<li><a href="#">Email</a></li>
								<li><a href="#">Favorite</a></li>
							</ul>
						</div>
	  			</div>
		  		<div class="panel-body">
					<img class="img-rounded" src="../lib/sample-images/image_8.jpg">
		  		</div>
		  		<div class="panel-footer">
		  			hi al;sdfkj a;lkdfjl aeksjf;lasdfj; alkdfj l alsdkjf;ladj al;ksdfjl;saj lakssdjf ;aj ksf alksdfj;las f;lka dfl;kaj dfl;kjasd fla;kj df;laksj dflks;aj dflakjd flks djf;lalkjsd flaskdj ;lkasdfj aosdknf;ask
					<div class="likes">
						<a href="#"># likes</a>
					</div>
		  		</div>
			</div>
		</div>

		<div id="tack8" class="tack">
			<div class="panel panel-default">
	  			<div class="panel-heading">
	    			<h6 class="panel-title">Panel Title Panel Title Panel Title Panel Title</h6>
		    			<div class="btn-group btn-group-sm right">
							<button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-pushpin"></span></button>
							<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu" role="menu">
								<li><a href="#">Retack</a></li>
								<li><a href="#">Email</a></li>
								<li><a href="#">Favorite</a></li>
							</ul>
						</div>
	  			</div>
		  		<div class="panel-body">
					<img class="img-rounded" src="../lib/sample-images/image_9.jpg">
		  		</div>
		  		<div class="panel-footer">
		  			hi al;sdfkj a;lkdfjl aeksjf;lasdfj; alkdfj l alsdkjf;ladj al;ksdfjl;saj lakssdjf ;aj ksf alksdfj;las f;lka dfl;kaj dfl;kjasd fla;kj df;laksj dflks;aj dflakjd flks djf;lalkjsd flaskdj ;lkasdfj aosdknf;ask
					<div class="likes">
						<a href="#"># likes</a>
					</div>
		  		</div>
			</div>
		</div>

		<div id="tack9" class="tack">
			<div class="panel panel-default">
	  			<div class="panel-heading">
	    			<h6 class="panel-title">Panel Title Panel Title Panel Title Panel Title</h6>
		    			<div class="btn-group btn-group-sm right">
							<button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-pushpin"></span></button>
							<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu" role="menu">
								<li><a href="#">Retack</a></li>
								<li><a href="#">Email</a></li>
								<li><a href="#">Favorite</a></li>
							</ul>
						</div>
	  			</div>
		  		<div class="panel-body">
					<img class="img-rounded" src="../lib/sample-images/image_10.jpg">
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
							<ul class="dropdown-menu" role="menu">
								<li><a href="#">Retack</a></li>
								<li><a href="#">Email</a></li>
								<li><a href="#">Favorite</a></li>
							</ul>
						</div>
	  			</div>
		  		<div class="panel-body">
					<img class="img-rounded" src="../lib/sample-images/image_8.jpg">
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
							<ul class="dropdown-menu" role="menu">
								<li><a href="#">Retack</a></li>
								<li><a href="#">Email</a></li>
								<li><a href="#">Favorite</a></li>
							</ul>
						</div>
	  			</div>
		  		<div class="panel-body">
					<img class="img-rounded" src="../lib/sample-images/image_8.jpg">
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

	<script src="../lib/masonry/masonry.pkgd.min.js"></script>


<?php include "../lib/php/footer.php"; ?>