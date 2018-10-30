<!DOCTYPE html>
<?php
	session_start();

	$conn = mysqli_connect('localhost', 'root', '', 'online_services');

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
	<style>
		.center{ margin-right: auto; margin-left: auto; display: block; width: 100%; opacity: 1.0; }
	</style>
</head>
<body>
	<nav class="navbar navbar-expand-lg mdb-color darken-4 fixed-top">
		<a class="navbar-brand" href="#"><img src="img/logo.png" height="40" width="40"></a>
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
	<div class="modal fade" id="bookModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header teal lighten-3 text-center">
					<h4 class="modal-title w-100 font-weight-bold">Book a Service</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="close">
						<span aria-label="true">&times;</span>
					</button>
				</div>
            	<div class="modal-body mx-3">
			    <form method="post">
                    <div class="form-group mb-5">		
                    	<label for="date_reserved">Date of Reservation</label>
						<input type="date" name="booking_date" id="booking_date" class="form-control">
                    </div>
                    <div class="md-form mx-auto">
                        <button type="submit" class="btn btn-default" name="btn_reserved" data-loading-text="Reserving in.."><span class="fa fa-chevron-circle-right"></span> Reserved</button>
                    </div>
                </form>
            	</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="page-header">
			<h1 class="text-center"> Service Information</h1>
		</div>
		<div class="container-fluid span6">
			<hr>
			<?php
				$id = $_GET['id'];
				$sql = "SELECT * FROM services WHERE ServiceID = '$id'";
				$res = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($res);
				$service_image = "service_image/".$row['ServiceImage'];
			?>
			<div class="row">
				<div class="span8">
					<img class="center" src="<?php echo $service_image; ?>" alt="image" height="400px" width="300px">
					<h4>Service Name: <span class="font-weight-bold"><?php echo $row['ServiceName']; ?></span></h4>
					<h4>Service Type: <span class="font-weight-bold"><?php echo $row['ServiceType']; ?></span></h4>
					<h4>Service Description: <span class="font-weight-bold"><?php echo $row['ServiceDescription']; ?></span></h4>
					<h4>Service Price: <span class="font-weight-bold"><?php echo number_format($row['ServicePrice'], '2'); ?></span></h4>
				</div>
				<div class="mx-auto">
					<a class="btn btn-teal btn-lg col-12" data-toggle="modal" data-target="#bookModal"><span class="fa fa-ticket"></span> Book</a>
				</div>
			</div>
			</div>
		</div>
	</div>
	<?php

		if (isset($_POST['btn_reserved'])) {
			
			$booking_date = mysqli_real_escape_string($conn, $_POST['booking_date']);
			$name = $_SESSION['name'];
			$service_id = $row['ServiceID'];
			$user_id = $_SESSION['user_id'];

			$booking_sql = "INSERT INTO booking(ServiceID, UsersID, Status, BookDate, DateBooked)
			VALUES('$service_id', '$user_id', 'Pending', '$booking_date', NOW())";

			$booking_res = mysqli_query($conn, $booking_sql);

			if ($booking_res) {

				echo "<script>
					alert('Sucessfully booked a service');
				</script>
				<meta http-equiv='refresh' content='0; url=user-dashboard.php'>";
			} else {
				echo "<script>
					alert('Failure in booking a service');
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