<!DOCTYPE html>
<?php
	session_start(); //starts session
	$conn = mysqli_connect('localhost', 'root', '', 'online_services');

	//if user is not logged in
	if (!isset($_SESSION['admin_user'])) {
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
		</div>
	</nav><br><br><br>
	<div class="modal fade" id="addAdminModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content cyan lighten-4">
				<div class="modal-header text-center orange lighten-2">
					<h4 class="modal-title w-100 font-weight-bold">Add Admin</h4>
                	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    	<span aria-hidden="true">&times;</span>
                	</button>
				</div>
				<div class="modal-body mx-3">
						<form method="post">
							<div class="md-form mb-4">
								<i class="fa fa-user prefix"></i>
								<input class="form-control" type="text" name="lastname">
								<label>Last Name</label>
							</div>
							<div class="md-form mb-4">
								<i class="fa fa-user prefix"></i>
								<input class="form-control" type="text" name="firstname">
								<label>First Name</label>
							</div>
							<div class="md-form mb-4">
								<i class="fa fa-envelope prefix"></i>
								<input class="form-control" type="email" name="email">
								<label>Last Name</label>
							</div>
							<div class="md-form mb-4">
								<i class="fa fa-user prefix"></i>
								<input class="form-control" type="text" name="username">
								<label>Username</label>
							</div>
							<div class="md-form mb-4">
								<i class="fa fa-lock prefix"></i>
								<input class="form-control" type="password" name="password">
								<label>Password</label>
							</div>
							<div class="md-form mb-4">
								<i class="fa fa-lock prefix"></i>
								<input class="form-control" type="password" name="confirm_password">
								<label>Confirm Password</label>
							</div>
							   <div class="modal-footer d-flex justify-content-center">
                					<button type="submit" class="btn btn-success" name="add_admin"><span class="fa fa-plus"></span> Add</button>
            					</div>
						</form>
					</div>
				</div>
			</div>
	</div>
	<div class="container">
		<div class="page-header">
			<h1 class="text-center"><span class="fa fa-user-secret"></span> Manage Admin Accounts</h1>
			<hr>
		</div>
		<a class="btn btn-info" data-toggle="modal" data-target="#addAdminModal"><span class="fa fa-user-secret"></span><span class="fa fa-plus"></span> Add Admin</a>
		<div class="table-responsive">
			<table class="table table-hover">
				<thead class="thead-inverse">
					<tr>
						<th style="font-size: 20px;"><span class="fa fa-user"></span> Name</th>
						<th style="font-size: 20px;"><span class="fa fa-envelope"></span> Email</th>
						<th style="font-size: 20px;"><span class="fa fa-user"></span> Username</th>
					</tr>
				</thead>
				<tbody class="mdb-color text-white">
					<?php
						$disp_user = "SELECT * FROM admin ORDER BY AdminID DESC";
						$disp_res = mysqli_query($conn, $disp_user);

						if (mysqli_num_rows($disp_res) > 0) {
							while ($disp_row = mysqli_fetch_assoc($disp_res)) {
								echo "<tr>
									<td>".$disp_row['AdminFName']. " " . $disp_row['AdminLName']. "</td>
									<td>".$disp_row['AdminEmail']."</td>
									<td>".$disp_row['AdminUser']."</td>
								</tr>";
							}
						} else {
							echo "<tr><td colspan='11'><h3 class='alert alert-warning text-center'>
                            	<span class='fa fa-info-circle'></span> No Services Found</h3></td></tr>";
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
<?php
	if (isset($_POST['add_admin'])) {
		
        //set the admin information details
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']); //escapes string
        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $confirm_password = htmlspecialchars($_POST['confirm_password']);

        $check_user = mysqli_query($conn, "SELECT * FROM admin WHERE AdminEmail = '$username'");
        $check_email = mysqli_query($conn, "SELECT * FROM admin WHERE AdminUser = '$email'");

        if (mysqli_num_rows($check_user) > 0) {
        	
        	echo "<script>
        		alert('Username is already existing');
        	</script>";
       
        } else if (mysqli_num_rows($check_email) > 0) {
        	
        	echo "<script>
        		alert('Email is already existing');
        	</script>";
        
        } else if ($password != $confirm_password) {
        	
        	echo "<script>
        		alert('Password do not match');
        	</script>";	
        } else {

        	$add_admin_sql = mysqli_query($conn, "INSERT INTO admin(AdminLName, AdminFName, AdminEmail, AdminUser, AdminPass) VALUES('$lastname', '$firstname', '$email', '$username', '$password')");

        	if ($add_admin_sql) {
        		echo "<script>
        			alert('Sucessfully added an admin');
        		</script>
        		<meta http-equiv='refresh' content='0; url=admin-accounts.php'>";
        	} else {
        		echo "<script>
        			alert('Failure in adding an admin');
        		</script>";
        	}
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