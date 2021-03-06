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
			<h1 class="text-center"><span class="fa fa-ticket"></span> Manage Bookings</h1>
			<hr>
		</div>
		<div class="table-responsive">
			<table class="table table-hover">
				<thead class="thead-inverse">
					<tr>
						<th style="font-size: 20px;"><span class="fa fa-image"></span> Image</th>
						<th style="font-size: 20px;"><span class="fa fa-user"></span> Customer Name</th>
						<th style="font-size: 20px;"><span class="fa fa-wrench"></span> Name of Service</th>
						<th style="font-size: 20px;"><span class="fa fa-wrench"></span> Type of Service</th>
						<th style="font-size: 20px;"><span class="fa fa-calendar"></span> Booking Date</th>
						<th style="font-size: 20px;"><span class="fa fa-info-circle"></span> Status</th>
						<th style="font-size: 20px;"><span class="fa fa-calendar"></span> Date of Booking</th>
						<th class="text-center" colspan="3" style="font-size: 20px;"><span class="fa fa-tasks"></span> Action</th>
					</tr>
				</thead>
				<tbody class="mdb-color text-white">
					
					<?php
						$disp_bookings = "SELECT * FROM booking INNER JOIN services USING(ServiceID) INNER JOIN users USING(UsersID) WHERE Status = 'Pending' ORDER BY DateBooked DESC";
						$bookings_res = mysqli_query($conn, $disp_bookings);

						if (mysqli_num_rows($bookings_res) > 0) {
							while ($bookings_row = mysqli_fetch_assoc($bookings_res)) {
								$name = $bookings_row['UserFName'] . " " . $bookings_row['UserLName'];
							?>
								<tr>
									<td><img src="<?php echo "service_image/".$bookings_row['ServiceImage']."" ?>" height='150' width='150'></td>
									<td style='font-size:20px;'><?php echo $name; ?></td>		
									<td style='font-size:20px;'><?php echo $bookings_row['ServiceName'] ?></td>	
									<td style='font-size:20px;'><?php echo $bookings_row['ServiceType'] ?></td>
									<td style='font-size:20px;' class='text-center'><?php echo $bookings_row['BookDate']?></td>
									<td style='font-size:20px;' class='text-center'><?php echo $bookings_row['Status']?></td>
									<td style='font-size:20px;' class='text-center'><?php echo $bookings_row['DateBooked']?></td>
									<td><a class='btn btn-info' onclick="return confirm('Approved this boooking?')" href='actions.php?approved_service=<?php echo $bookings_row['bookingID']?>'><span class='fa fa-check'></span> Approved</a></td>
									<td><a class='btn btn-danger' onclick="return confirm('Reject this service?')" href='actions.php?reject_service=<?php echo $bookings_row['bookingID']?>'><span class='fa fa-close'></span> Reject</a></td>
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
	
<script src="js/jquery.min.js"></script>	
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/mdb.min.js"></script>
<script src="js/popper.min.js"></script>
</body>
</html>