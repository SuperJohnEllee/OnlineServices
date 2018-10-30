<!DOCTYPE html>
<?php
	session_start(); //starts session
	$conn = mysqli_connect('localhost', 'root', '', 'online_services'); //connection

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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.13/css/mdb.min.css" rel="stylesheet">
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
			<h1 class="text-center"><span class="fa fa-wrench"></span> Manage Services</h1>
		</div>
		<div class="row">
			<form class="col-md-6" method="post" enctype="multipart/form-data">
				<div class="md-form mb-4">
					<i class="fa fa-image prefix"></i>
					<input class="form-control" type="file" name="image">
				</div>
				<div class="md-form mb-4">
					<i class="fa fa-wrench prefix"></i>
					<input class="form-control" type="text" name="service_name">
					<label>Name of Service</label>
				</div>
				<div class="form-group">
					<select class="form-control" name="service_type">
						<option>Type of Service</option>
						<option value="Electrical">Electrical</option>
						<option value="Plumbing">Plumbing</option>
						<option value="Water">Water</option>
						<option value="Internet">Internet</option>
						<option value="Computer">Computer</option>
						<option value="Household">Household</option>
						<option value="Trucking">Trucking</option>
					</select>
				</div>
				<div class="md-form mb-4">
					<i class="fa fa-pencil prefix"></i>
					<textarea class="form-control md-textarea" name="service_description" rows="5"></textarea>
					<label>Service Description</label>
				</div>
				<div class="md-form mb-4">
					<i class="fa fa-dollar prefix"></i>
					<input class="form-control" type="text" name="service_price">
					<label>Service Price</label>
				</div>
				<div class="md-form mb-4">
					<button type="submit" class="btn btn-success" name="add_service"><span class="fa fa-plus"></span> Add Services</button>
				</div>
			</form>
		</div>
		<div class="table-responsive">
			<table class="table table-hover">
				<thead class="thead-dark">
					<tr>
						<th style="font-size: 20px;"><span class="fa fa-image"></span> Service Image</th>
						<th class="text-center" colspan="2" style="font-size: 20px;"><span class="fa fa-wrench"></span> Service Name</th>
						<th class="text-center" colspan="3" style="font-size: 20px;"><span class="fa fa-wrench"></span> Service Type</th>
						<th class="text-center" colspan="2" class="text-center" style="font-size: 20px;"><span class="fa fa-info-circle"></span> Service Description</th>	
						<th  class="text-center" style="font-size: 20px;"><span class="fa fa-dollar"></span> Service Price</th>	
						<th colspan="2" class="text-center" colspan="2" style="font-size: 20px;"><span class="fa fa-tasks"></span> Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$disp_service = "SELECT * FROM services ORDER BY ServiceID";
						$service_res = mysqli_query($conn, $disp_service);

						if (mysqli_num_rows($service_res) > 0) {
							while ($service_row = mysqli_fetch_assoc($service_res)) {

							?>
								<tr>
									<td><img src="<?php echo "service_image/".$service_row['ServiceImage']."" ?>" height='250' width='250'></td>
									<td style='font-size:20px;' colspan='3'><?php echo $service_row['ServiceName'] ?></td>	
									<td style='font-size:20px;' colspan='3'><?php echo $service_row['ServiceType'] ?></td>
									<td style='font-size:20px;' class='text-center'><?php echo $service_row['ServiceDescription']?>"</td>
									<td style='font-size:20px;' class='text-center'><?php echo number_format($service_row['ServicePrice'], '2')?></td>
									<td><a class='btn btn-info' href='edit-services.php?edit_service=<?php echo $service_row['ServiceID']?>'><span class='fa fa-edit'></span> Edit</a></td>
									<td><a class='btn btn-danger' onclick="return confirm('Delete this service?')" href='actions.php?delete_service=<?php echo $service_row['ServiceID']?>'><span class='fa fa-trash'></span> Delete</a></td>
								</tr>
						<?php	} ?>
					
					<?php	} else {
							echo "<tr><td colspan='11'><h3 class='alert alert-warning text-center'>
                            <span class='fa fa-info-circle'></span> No Services Found</h3></td></tr>";
						} ?>
				</tbody>
			</table>
		</div>
	</div>
<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.13/js/mdb.min.js"></script>
<?php
	
	if (isset($_POST['add_service'])) {
		
		//define variables
		$service_image = mysqli_real_escape_string($conn, $_FILES['image']['name']);
		$service_name = mysqli_real_escape_string($conn, $_POST['service_name']);
		$service_type = mysqli_real_escape_string($conn, $_POST['service_type']);
		$service_description = mysqli_real_escape_string($conn, $_POST['service_description']);
		$service_price = mysqli_real_escape_string($conn, $_POST['service_price']);

		//image directory
		$image_target = "service_image/".basename($service_image);

		//execute query
		$add_service_sql = "INSERT INTO services(ServiceImage, ServiceName, ServiceType, 
		ServiceDescription, ServicePrice) 
		VALUES('$service_image', '$service_name', '$service_type', '$service_description', '$service_price')";

		$add_service_res = mysqli_query($conn, $add_service_sql);

		//move image to folder and check if query is succesfull or fail
		if (move_uploaded_file($_FILES['image']['tmp_name'], $image_target) && $add_service_res) {
			
			echo "<script>
				alert('Succesfully added a service');
			</script>
			<meta http-equiv='refresh' content='0; url=admin-manage-services.php'>";
		} else {
			echo "<script>
				alert('Failure in adding a service');
			</script>";
		}
	}
?>
</body>
</html>