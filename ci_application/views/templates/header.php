<html>
	<head>
		<title><?php echo $title; ?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()."css/cosmos.min.css"; ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()."css/datatables.bootstrap.css"; ?>" />
		<link rel="shortcut icon" href="<?= base_url()."favicon.ico" ?>" />
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
				<a class="navbar-brand" href="/index.php">
					<img src="<?php echo base_url()."css/logo.png"; ?>" alt="csdl" height="25px" />csdl
				</a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="<?php echo $active['home']; ?>">
						<a href="/index.php">
							<span class="glyphicon glyphicon-home"></span>
							Home
						</a>
					</li>
					<li class="<?php echo $active['login']; ?>">
						<a href="/index.php/login/">
							<span class="glyphicon glyphicon-edit"></span>
							Login
						</a>
					</li>
					<li class="<?php echo $active['view']; ?>">
						<a href="/index.php/book/"><span class="glyphicon glyphicon-list-alt"></span>
							View Books
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="container">