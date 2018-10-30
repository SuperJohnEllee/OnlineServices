<!DOCTYPE html>
<?php
	session_start(); //starts session
	$conn = mysqli_connect('localhost', 'root', '', 'online_services');

	//if user is not logged in
	if (!isset($_SESSION['admin_user'])) {
		header("location: index.php");
	}

	$sql = "SELECT * FROM contact_us";
	$res = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($res);
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
	<nav class="navbar navbar-expand-lg bg-primary fixed-top">
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
			<h1 class="text-center"><span class="fa fa-address-book-o"></span> Manage Contact</h1>
			<hr>
		</div>
		<div class="row">
			<form class="col-md-6" method="post">
				<div class="md-form">
					<input class="form-control" type="hidden" name="id" value="<?php echo $row['contact_usID'] ?>">
				</div>
				<div class="md-form">
					<i class="fa fa-map-marker prefix"></i>
					<input class="form-control" type="text" name="address" value="<?php echo $row['Address'] ?>">
					<label>Address</label>
				</div>
				<div class="md-form">
					<i class="fa fa-phone prefix"></i>
					<input class="form-control" type="text" name="contact_number" value="<?php echo $row['ContactNumber'] ?>">
					<label>Contact Number</label>
				</div>
				<div class="md-form">
					<i class="fa fa-envelope prefix"></i>
					<input class="form-control" type="text" name="contact_email" value="<?php echo $row['ContactEmail'] ?>">
					<label>Email</label>
				</div>
				<div class="md-form">
					<i class="fa fa-calendar prefix"></i>
					<input class="form-control" type="text" name="contact_schedule" value="<?php echo $row['ContactSchedule'] ?>">
					<label>Schedule</label>
				</div>
				<div class="md-form">
						<button class="btn btn-primary" type="submit" name="save_contact"><span class="fa fa-save"></span> Save Changes</button>
				</div>
				</div>

			</form>
		</div>
	</div>
<?php
	if (isset($_POST['save_contact'])) {
			
			$address = mysqli_real_escape_string($conn, $_POST['address']);
			$contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
			$contact_email = mysqli_real_escape_string($conn, $_POST['contact_email']);
			$contact_schedule = mysqli_real_escape_string($conn, $_POST['contact_schedule']);
			$contact_id = htmlspecialchars($_POST['id']);

			$contact_update = mysqli_query($conn, "UPDATE contact_us SET Address = '$address', 
				ContactNumber = '$contact_number', ContactEmail = '$contact_email', ContactSchedule = '$contact_schedule' WHERE contact_usID = '$contact_id'");

			if ($contact_update) {
				echo "<script>
					alert('successfully updated contact us information');
				</script>
				<meta http-equiv='refresh' content='0; url=admin-manage-contact.php'>";
			} else {
				echo "<script>
					alert('Failure in updating contact us information');
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