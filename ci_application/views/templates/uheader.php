<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $title; ?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()."css/readable.min.css"; ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()."css/datatables.bootstrap.css"; ?>" />
		<script src="<?php echo base_url()."js/jquery.js"; ?>"></script>
		<script src="<?php echo base_url()."js/bootstrap.min.js"; ?>"></script>
		<script src="<?php echo base_url()."js/datatables.js"; ?>"></script>
		<script src="<?php echo base_url()."js/datatables.bootstrap.js"; ?>"></script>
		<style>
			body {
				padding-top:70px;
				padding-bottom:30px;
			}
		</style>
	</head>
	<body>
	<div class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="/index.php/user">
					<img src="<?php echo base_url()."css/logo.png"; ?>" alt="csdl" height="25px" />csdl
				</a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="<?php echo $active['home']; ?>">
						<a href="/index.php/user">
							<span class="glyphicon glyphicon-home"></span>
							Home
						</a>
					</li>
					<li class="<?php echo $active['view']; ?>">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<span class="glyphicon glyphicon-book"></span>
							View
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li class="dropdown-header">Book Section</li>
							<li><a href="/index.php/user/view/viewpublishers">View Publishers</a></li>
							<li><a href="/index.php/user/view/viewauthors">View Authors</a></li>
							<li><a href="/index.php/user/view/viewbooks/all">View All Books</a></li>
							<li><a href="/index.php/user/view/viewbooks/available">View Available Books</a></li>
							<li role="separator" class="divider"></li>
							<li class="dropdown-header">Issue Section</li>
							<li><a href="/index.php/user/view/viewissues/all">View Issue History</a></li>
							<li><a href="/index.php/user/view/viewissues/pending">View Pending Issues</a></li>
						</ul>
					</li>
				</ul>
				<span class="navbar-right">
					<ul class="nav navbar-nav">
						<li class="dropdown navbar-right active">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								<span class="glyphicon glyphicon-cog"></span>
								<span style="font-weight:bold;"><?php echo $realname; ?></span>
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li class="dropdown-header">Profile Actions</li>
								<li><a href="#">View Profile</a></li>
								<li><a href="#">Edit Profile</a></li>
								<li role="separator" class="divider"></li>
								<li class="dropdown-header">User Actions</li>
								<li><a href="/index.php/login/logout">Logout</a></li>
							</ul>
						</li>
					</ul>
					
				</span>
			</div>
		</div>
	</div>
	<div class="container">