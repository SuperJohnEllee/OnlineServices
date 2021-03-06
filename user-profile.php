<!DOCTYPE html>
<?php
	session_start();

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
	<style>.container{ padding:5%;}.container .img{ text-align:center; } .container .details{ border-left:3px solid #ded4da; } .container .details h3{ font-size:25px; font-weight:bold; }
	</style>
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
	</nav><br><br>
	<div class="container">
		<div class="page-header">
			<h1>User Profile</h1>
			<hr>
		</div>
		 <div class="row">
    <div class="col-md-6">
    	<?php if ($_SESSION['gender'] == "Male") { 
    		echo "<img src='img/gender/men.svg' alt='Male' height='200'>";
    	} else if ($_SESSION['gender'] == "Female") {
    		echo "<img src='img/gender/women.svg' alt='Female' height='200'>";
    	}
     ?>
    </div>
    <div class="col-md-6 details">
      <blockquote>
      	<h1><?php echo $name; ?></h1>
      </blockquote>
      <h3>Email: <?php echo $_SESSION['email']; ?></h3>
      <h3>Username: <?php echo $_SESSION['username']; ?></h3>
      <a class="btn btn-primary" href="user-edit-profile.php?id=<?php echo $_SESSION['user_id']; ?>"><span class="fa fa-edit"></span> Edit Profile</a>
      <a class="btn btn-dark" href="user-change-password.php?<?php echo $user; ?>"><span class="fa fa-lock"></span> Change Password</a>
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