<!DOCTYPE html>
<?php
	session_start(); //starts session
	$conn = mysqli_connect('localhost', 'root', '', 'online_services');
	//define 
	$name = htmlspecialchars($_SESSION['admin_name']);
	$email = htmlspecialchars($_SESSION['admin_email']);
	$user = htmlspecialchars($_SESSION['admin_user']);

	//if user is not logged in
	if (!$user) {
		header("location: index.php");
	}

?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-wdith, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>BF Online Services </title>
	<link rel="icon" href="img/logo.png">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/mdb.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<nav class="navbar navbar-expand-lg mdb-color darken-4 fixed-top">
		<a class="navbar-brand" href="#"><img src="img/logo.png" height="30" width="30"></a>
		<button type="button" class="navbar-toggler mdb-color grey-2" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle Navigation">
			<span class="fa fa-bars text-white"></span>
		</button>
		<div class="navbar-collapse collapse" id="navbar">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link text-white" href="admin-dashboard.php"><span class="fa fa-home"></span> Home</a>
				</li>
			</ul>
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link text-white" href="admin-profile.php?<?php echo $user; ?>"><span class="fa fa-user-secret"></span> <?php echo $user; ?></a>
				</li>
				<li class="nav-item">
					<a class="nav-link text-white" href="logout.php"><span class="fa fa-sign-out"></span> Logout</a>
				</li>
			</ul>
		</div>
	</nav><br><br><br>
	<div class="container">
		<div class="page-header">
			<h1>Hello, <?php echo $name; ?></h1>
			<p>This is your dashboard</p>
			<hr>
			<h1 class="text-center">Administrator Dashboard</h1>
		</div>
		<div class="row">
			<div class="col-4">
				<h1><a class="btn btn-info btn-lg" href="admin-manage-services.php"><span class="fa fa-wrench fa-5x"></span> Manage Services</a></h1>
			</div>
			<!--<div class="col-4">
				<h1><a class="btn btn-warning btn-lg" href="admin-view-services.php"><span class="fa fa-eye fa-5x"></span> View Services</a></h1>
			</div> -->
			<div class="col-4">
				<h1><a class="btn btn-secondary btn-lg" href="admin-manage-bookings.php"><span class="fa fa-ticket fa-5x"></span> Manage Booking</a></h1>
			</div>
			<div class="col-4">
				<h1><a class="btn btn-success btn-lg" href="admin-approved-bookings.php"><span class="fa fa-thumbs-up fa-5x"></span> Approved Bookings</a></h1>
			</div>
			<div class="col-4">
				<h1><a class="btn btn-danger btn-lg" href="#"><span class="fa fa-thumbs-down fa-5x"></span> Rejected Bookings</a></h1>
			</div>
			<div class="col-4">
				<h1><a class="btn btn-teal btn-lg" href="admin-user-accounts.php"><span class="fa fa-user fa-5x"></span> Manage Users Accounts</a></h1>
			</div>
			<div class="col-4">
				<h1><a class="btn btn-dark btn-lg" href="admin-accounts.php"><span class="fa fa-user-secret fa-5x"></span> Manage Admin Accounts</a></h1>
			</div>
			<div class="col-4">
				<h1><a class="btn btn-indigo btn-lg" href="admin-manage-contact.php"><span class="fa fa-address-book-o fa-5x"></span> Manage Contact</a></h1>
			</div>
		</div>
	</div>
<script src="js/jquery.min.js"></script>	
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/mdb.min.js"></script>
<script src="js/popper.min.js"></script>
</body>
</html>