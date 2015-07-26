<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $title; ?></title>
		<link rel="stylesheet" type="text/css" href="<?= base_url()."css/readable.css" ?>" />
		<link rel="stylesheet" type="text/css" href="<?= base_url()."css/datatables.bootstrap.css" ?>" />
		<link rel="stylesheet" type="text/css" href="<?= base_url()."css/jasny.css" ?>" />
		<link rel="shortcut icon" href="<?= base_url()."favicon.ico" ?>" />
		<script src="<?= base_url()."js/jquery.js" ?>"></script>
		<script src="<?= base_url()."js/bootstrap.js" ?>"></script>
		<script src="<?= base_url()."js/datatables.js" ?>"></script>
		<script src="<?= base_url()."js/datatables.bootstrap.js" ?>"></script>
		<script src="<?= base_url()."js/jasny.js" ?>"></script>
		<style>
			body {
				padding-top:70px;
				padding-bottom:30px;
			}
		</style>
		<?php
			if( $this->session->userdata('message') ) {
				echo "
					<script>
						$(document).ready(function(){
							$('#myModal').modal();
						});
					</script>
				";
			}
		?>
	</head>
	<body>
<?php
if( $this->session->userdata('message') ) {
?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<h4 class="modal-title" id="myModalLabel">Success</h4>
		</div>
		<div class="modal-body" style="word-wrap:break-word">
			<?= $this->session->userdata('message') ?>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
		</div>
		</div>
	</div>
</div>
<?php
}
$this->session->unset_userdata('message');
?>
	<div class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="/index.php/user">
					<img src="<?= base_url()."css/logo.png" ?>" alt="csdl" height="25px" />csdl
				</a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="active">
						<a href="/index.php/user">
							<span class="glyphicon glyphicon-home"></span>
							Home
						</a>
					</li>
					<li class="active">
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
					<li class="active">
						<a href="/index.php/user/view/suggestion"><span class="glyphicon glyphicon-list-alt"></span>
							Suggest Books
						</a>
					</li>
				</ul>
				<span class="navbar-right">
					<ul class="nav navbar-nav">
						<li class="dropdown navbar-right active">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								<span class="glyphicon glyphicon-cog"></span>
								<span style="font-weight:bold;"><?= $realname ?></span>
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li class="dropdown-header">Profile Actions</li>
								<li><a href="/index.php/user/view/viewprofile">View Profile</a></li>
								<li><a href="/index.php/user/view/editprofile">Edit Profile</a></li>
								<li><a href="/index.php/user/view/changepassword">Change Password</a></li>
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