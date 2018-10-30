<!DOCTYPE html>
<?php
	session_start(); //starts session
	$conn = mysqli_connect('localhost', 'root', '', 'online_services');
	//define 
	$name = htmlspecialchars($_SESSION['name']);
	$email = htmlspecialchars($_SESSION['email']);
	$user = htmlspecialchars($_SESSION['username']);

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
			<ul class="navbar-nav ml-auto"> 
				<li class="nav-item">
					<a class="nav-link text-white" href="user-profile.php?<?php echo $_SESSION['username']; ?>"><span class="fa fa-user-circle"></span> <?php echo $_SESSION['username']; ?></a>
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
			<hr>
			<h1 class="text-center">We offer you our best services</h1>
		</div>
		<div class="row">
			<?php
				$disp_services = "SELECT * FROM services ORDER BY ServiceID DESC";
              	$disp_res = mysqli_query($conn, $disp_services);

              	if (mysqli_num_rows($disp_res) > 0) {
              		while($services_row = mysqli_fetch_assoc($disp_res)) {
              			$service_image = "service_image/".$services_row['ServiceImage'];
              	?>
              	<div class="card" style="width: 17rem;">
              		<div class="view overlay">
              			<img class="card-img-top" height="200" src="<?php echo $service_image; ?>">
              			<a href="#"><div class="mask rgba-white-slight"></div></a>
              		</div>
              		<div class="card-body">
              			<h3 class="card-title"><?php echo $services_row['ServiceName']; ?></h3>
              			<h4 class="card-title">P<?php echo number_format($services_row['ServicePrice'], '2'); ?></h4>
              			<div class="btn-group">
                      		<a class="btn btn-primary" href="view-services.php?id=<?php echo $services_row['ServiceID'] ?>"><span class="fa fa-eye"></span> View</a>
              			</div>
              		</div>
              	</div>
              	<?php	} ?>

              <?php	} else {


              } ?>
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