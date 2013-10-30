<?php include "../lib/php/header.php";?>

<link type="text/css" rel="stylesheet" href="../lib/css/search.css">
<link type="text/css" rel="stylesheet" href="../lib/css/userList.css">

	<div class="row">
	    <div class="col-lg-8 col-lg-offset-2">
		    <div class="input-group">
		    	<input type="text" class="form-control" placeholder="Search">
			    <div class="input-group-btn">
			    	<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Tacks</button>
						<ul class="dropdown-menu pull-right" role="menu">
							<li><a href="#">Tacks</a></li>
							<li><a href="#">Boards</a></li>
							<li><a href="#">Users</a></li>
						</ul>
			    </div>
		    </div>
	    </div>
	</div>

	<div class="row">
		<div class="col-lg-8 col-lg-offset-2">
			<h3>User results for "?????"</h3>
		</div>
	</div>

	<div class="userList col-sm-8 col-sm-offset-2">
		<a href="#test">
		<div class="panel panel-default">
	  		<div class="panel-body">
	  			<img id="userAvatar" class="avatar" align="left" src="../lib/sample-avatars/avatar_1.jpg"></img>
	  			<div class="title">
	    		BoardTitle BoardTitle BoardTitle BoardTitle BoardTitle BoardTitle
	    		</div>
	    		<div id="user0FollowCount" class="followCount">
	    			# Followers
	    		</div>
<!-- 	    		<div id="user0Tacks" class="recentTacks">
	    			<img class="img-rounded" src="../lib/sample-images/image_1.jpg">
	    		</div> -->
	  		</div>
	  	</a>
  		</div>

		<div class="panel panel-default">
			<a href="#">
	  		<div class="panel-body">
	  			<img id="userAvatar" class="avatar" align="left" src="../lib/sample-avatars/avatar_2.jpg"></img>
	  			<div class="title">
	    		BoardTitle BoardTitle BoardTitle BoardTitle BoardTitle BoardTitle
	    		</div>
	    		<div id="user0FollowCount" class="followCount">
	    			# Followers
	    		</div>
<!-- 	    		<div id="user0Tacks" class="recentTacks">
	    			<img class="img-rounded" src="../lib/sample-images/image_1.jpg">
	    		</div> -->
	  		</div>
	  		</a>
  		</div>


	</div>




<?php include "../lib/php/footer.php"; ?>