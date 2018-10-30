<!DOCTYPE html>
<?php
	session_start(); //starts session
	$conn = mysqli_connect('localhost', 'root', '', 'online_services'); //connection

	//if user is not logged in
	if (!isset($_SESSION['admin_user'])) {
		header("location: index.php");
	}

	$edit_service = $_GET['edit_service'];
	$edit_service_sql = mysqli_query($conn, "SELECT * FROM services WHERE ServiceID = '$edit_service'");
	$edit_service_row = mysqli_fetch_assoc($edit_service_sql);
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
			<h1 class="text-center"><span class="fa fa-pencil"></span> Edit Services</h1>
		</div>

		<div class="row">
			<form class="col-md-6" method="post" enctype="multipart/form-data">
				<div class="md-form">
					<input type="hidden" name="id" value="<?php echo $edit_service_row['ServiceID'] ?>">
				</div>
				<div class="md-form mb-4">
					<img height="250" width="300" src="<?php echo "service_image/".$edit_service_row['ServiceImage']; ?>">
					<input class="form-control" type="file" name="image" value="<?php echo "service_image/".$edit_service_row['ServiceImage']; ?>">
				</div>
				<div class="md-form mb-4">
					<i class="fa fa-wrench prefix"></i>
					<input class="form-control" type="text" name="service_name" value="<?php echo $edit_service_row['ServiceName'] ?>">
					<label>Name of Service</label>
				</div>
				<div class="md-form mb-4">
					<i class="fa fa-wrench prefix"></i>
					<input class="form-control" type="text" name="service_type" value="<?php echo $edit_service_row['ServiceType'] ?>">
					<label>Type of Service</label>
				</div>
				<div class="md-form mb-4">
					<i class="fa fa-pencil prefix"></i>
					<textarea class="form-control md-textarea" name="service_description" rows="5"><?php echo$edit_service_row['ServiceDescription'] ?></textarea>
					<label>Service Description</label>
				</div>
				<div class="md-form mb-4">
					<i class="fa fa-dollar prefix"></i>
					<input class="form-control" type="text" name="service_price" value="<?php echo $edit_service_row['ServicePrice'] ?>">
					<label>Service Price</label>
				</div>
				<div class="md-form mb-4">
					<button type="submit" class="btn btn-success" name="update_service"><span class="fa fa-refresh"></span> Update Services</button>
				</div>
			</form>
		</div>
	</div>
<?php
	
	if (isset($_POST['update_service'])) {
		
		$service_name = mysqli_real_escape_string($conn, $_POST['service_name']);
		$service_type = mysqli_real_escape_string($conn, $_POST['service_type']);
		$service_description = mysqli_real_escape_string($conn, $_POST['service_description']);
		$service_price = mysqli_real_escape_string($conn, $_POST['service_price']);

		$id = $_POST['id'];

		$update_service_sql = "UPDATE services SET ServiceName = '$service_name', ServiceType = '$service_type',
		ServiceDescription = '$service_description', ServicePrice = '$service_price' WHERE ServiceID = '$id'";

		$update_service_res = mysqli_query($conn, $update_service_sql);

		if ($update_service_res) {
			echo "<script>
				alert('Updated services successfully');
			</script>
			<meta http-equiv='refresh' content='0; url=admin-manage-services.php'>";
		} else {
			echo "<script>
				alert('Failure in updating services');
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