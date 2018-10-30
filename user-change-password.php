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
			<h1 class="text-center"><span class="fa fa-lock"></span> Change Password</h1>
			<hr>
			<h5>Change Password for <span class="text-warning"><?php echo $_SESSION['username']; ?></span></h5>
		</div>
		<div class="row">
			<form class="col-md-6" method="post">
				<div class="md-form">
					<i class="fa fa-lock prefix"></i>
					<input class="form-control" type="password" name="old_pass">
					<label>Old Password</label>
				</div>
				<div class="md-form">
					<i class="fa fa-lock prefix"></i>
					<input class="form-control" type="password" name="new_pass">
					<label>New Password</label>
				</div>
				<div class="md-form">
					<i class="fa fa-lock prefix"></i>
					<input class="form-control" type="password" name="conf_pass">
					<label>Confirm Password</label>
				</div>
				<div class="md-form">
					<button class="btn btn-success" type="submit" name="change_pass"><span class="fa fa-save"></span> Save Changes</button>
				</div>
			</form>
		</div>
	</div>
<?php
	if (isset($_POST['change_pass'])) {
		
		$old_pass = mysqli_real_escape_string($conn, $_POST['old_pass']);
		$new_pass = mysqli_real_escape_string($conn, $_POST['new_pass']);
		$conf_pass = mysqli_real_escape_string($conn, $_POST['conf_pass']);

		$sql = "SELECT * FROM users WHERE Username = '$username'";
		$res = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($res);

		if ($row['UserPass'] == $old_pass) {
			if ($new_pass == $conf_pass) {
				
				$update_pass = "UPDATE users SET UserPass = '$new_pass' WHERE Username = '$username'";
				$update_res = mysqli_query($conn, $update_pass);

				if ($update_res) {
					echo "<script>
						alert('Successfully changed password');
					</script>
					<meta http-equiv='refresh' content='0; url=user-change-password.php'>";
				
				} else {
					echo "<script>
						alert('Failure in changing password');
					</script>";
				}
			} else {
				echo "<script>
					alert('Passwords do not match');
				</script>";
			}
		} else {
			echo "<script>
				alert('Old Passwords do not match');
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