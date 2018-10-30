<!DOCTYPE html>
<?php
	
	session_start();

	$conn = mysqli_connect('localhost', 'root', '', 'online_services');
	$username = htmlspecialchars($_SESSION['username']);

	//if user is not logged in
	if (!isset($_SESSION['username'])) {
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
					<a class="nav-link text-white" href="user-dashboard.php"><span class="fa fa-home"></span> Home</a>
				</li>
			</ul>
		</div>
	</nav><br><br><br>
	<div class="container">
		<div class="page-header">
			<h1 class="text-center"><span class="fa fa-lock"></span> Edit User Account</h1>
			<hr>
			<h5>Edit User Account for <span class="text-warning"><?php echo $_SESSION['username']; ?></span></h5>
		</div>
		<div class="row">
			<form class="col-md-6" method="post">
				<div class="md-form">
					<i class="fa fa-user prefix"></i>
					<input class="form-control" type="hidden" name="id" value="<?php echo $_SESSION['user_id'] ?>">
				</div>
				<div class="md-form mb-4">
					<i class="fa fa-user prefix"></i>
					<input class="form-control" type="text" name="lastname" value="<?php echo $_SESSION['lastname'] ?>">
					<label>Last Name</label>
				</div>
				<div class="md-form mb-4">
					<i class="fa fa-user prefix"></i>
					<input class="form-control" type="text" name="firstname" value="<?php echo $_SESSION['firstname'] ?>">
					<label>First Name</label>
				</div>
				<div class="md-form mb-4">
					<i class="fa fa-envelope prefix"></i>
					<input class="form-control" type="text" name="email" value="<?php echo $_SESSION['email']; ?>">
					<label>Email</label>
				</div>
				<div class="md-form mb-4">
					<i class="fa fa-user prefix"></i>
					<input class="form-control" type="text" name="username" value="<?php echo $username; ?>">
					<label>Username</label>
				</div>	
				<div class="md-form">
					<button class="btn btn-success" type="submit" name="update_account"><span class="fa fa-save"></span> Save Changes</button>
				</div>
			</form>
		</div>
	</div>

<?php

	if (isset($_POST['update_account'])) {

		$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
		$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$edit_id = $_POST['id'];

		$update_account_sql = "UPDATE users SET UserFName = '$firstname',
		 UserLName = '$lastname', UserEmail = '$email', Username = '$username' WHERE UsersID = '$edit_id'";

		$update_account_res = mysqli_query($conn, $update_account_sql);

		if ($update_account_res) {
			echo "<script>
				alert('Profile updated Successfully');
			</script>
			<meta http-equiv='refresh' content='0; url=user-profile.php'>";
		
		} else {
			echo "<script>
				alert('Failure in updating profile');
			</script>";
		}

	}
?>
<script src="js/jquery.min.js"></script>	
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/mdb.min.js"></script>
<script src="js/popper.min.js"></script>
</body>
</html>