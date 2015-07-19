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
		<div class="modal-body">
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
				<a class="navbar-brand" href="/index.php/librarian">
					<img src="<?php echo base_url()."css/logo.png"; ?>" alt="csdl" height="25px" />csdl
				</a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="<?php echo $active['home']; ?>">
						<a href="/index.php/librarian">
							<span class="glyphicon glyphicon-home"></span>
							Home
						</a>
					</li>
					<li class="<?php echo $active['books']; ?>">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<span class="glyphicon glyphicon-book"></span>
							Books
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li class="dropdown-header">Add Section</li>
							<li><a href="/index.php/librarian/view/addbook">Add Book</a></li>
							<li><a href="/index.php/librarian/view/addcopy">Add Copies</a></li>
							<li><a href="/index.php/librarian/view/addauthor">Add Author</a></li>
							<li><a href="/index.php/librarian/view/addpublisher">Add Publisher</a></li>
							<li role="separator" class="divider"></li>
							<li class="dropdown-header">Remove Section</li>
							<li><a href="/index.php/librarian/view/damagecopy">Report Damage</a></li>
							<li><a href="/index.php/librarian/view/removecopy">Remove Copies</a></li>
						</ul>
					</li>
					<li class="<?php echo $active['stats']; ?>">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<span class="glyphicon glyphicon-bookmark"></span>
							Issues
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li class="dropdown-header">Issue Section</li>
							<li><a href="/index.php/librarian/view/issue">Issue Book</a></li>
							<li><a href="/index.php/librarian/view/renew">Renew Book</a></li>
							<li role="separator" class="divider"></li>
							<li class="dropdown-header">Return Section</li>
							<li><a href="/index.php/librarian/view/return">Return Book</a></li>
						</ul>
					</li>
					<li class="<?php echo $active['view']; ?>">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<span class="glyphicon glyphicon-book"></span>
							View
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li class="dropdown-header">Book Section</li>
							<li><a href="/index.php/librarian/view/viewpublishers">View Publishers</a></li>
							<li><a href="/index.php/librarian/view/viewauthors">View Authors</a></li>
							<li><a href="/index.php/librarian/view/viewbooks/all">View All Books</a></li>
							<li><a href="/index.php/librarian/view/viewbooks/available">View Available Books</a></li>
							<li role="separator" class="divider"></li>
							<li class="dropdown-header">Issue Section</li>
							<li><a href="/index.php/librarian/view/viewissues/all">View Issue History</a></li>
							<li><a href="/index.php/librarian/view/viewissues/pending">View Pending Issues</a></li>
						</ul>
					</li>
					<li class="<?php echo $active['user']; ?>">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<span class="glyphicon glyphicon-user"></span>
							Users
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li class="dropdown-header">Management Section</li>
							<li><a href="/index.php/librarian/view/adduser">Add User</a></li>
							<li><a href="/index.php/librarian/view/suspenduser">Suspend User</a></li>
							<li><a href="/index.php/librarian/view/revokesuspension">Revoke Suspension</a></li>
							<li><a href="/index.php/librarian/view/removeuser">Remove User</a></li>
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