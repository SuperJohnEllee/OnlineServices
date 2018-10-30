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
	<div class="container">
		<div class="page-header">
			<h1 class="text-center">Manage User Accounts</h1>
			<hr>
		</div>
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
						$disp_user = "SELECT * FROM users ORDER BY UsersID DESC";
						$disp_res = mysqli_query($conn, $disp_user);

						if (mysqli_num_rows($disp_res) > 0) {
							while ($disp_row = mysqli_fetch_assoc($disp_res)) {
								echo "<tr>
									<td>".$disp_row['UserFName']. " " . $disp_row['UserLName']. "</td>
									<td>".$disp_row['UserEmail']."</td>
									<td>".$disp_row['Username']."</td>
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
</body>
</html>