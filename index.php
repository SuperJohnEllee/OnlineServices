<!DOCTYPE html>
<?php
    $conn = mysqli_connect('localhost', 'root', '', 'online_services')
    or die('Connection Failed: ' . mysqli_error()); //connection
        
    session_start();

    if (isset($_POST['user_login'])) {
        
        //define user credentials
        $username = mysqli_real_escape_string($conn, $_POST['user_username']);
        $password = mysqli_real_escape_string($conn, $_POST['user_password']);

        //query start
        $sql = "SELECT * FROM users WHERE Username = '$username'";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);

        $res_pass = $row['UserPass'];

        if (mysqli_num_rows($res) > 0) {
            if ($password == $res_pass) {

                //Session Variables
                $_SESSION['user_id'] = $row['UsersID'];
                $_SESSION['username'] = $row['Username'];
                $_SESSION['email'] = $row['UserEmail'];
                $_SESSION['firstname'] = $row['UserFName'];
                $_SESSION['lastname'] = $row['UserLName'];
                $_SESSION['name'] = $row['UserFName'] . ' ' . $row['UserLName'];  
                $_SESSION['gender'] = $row['UserGender']; 
                header("location: user-dashboard.php");
            
            } else {
                echo "<script>
                    alert('Incorrect Passsword');
                </script>";
            }
        } else {
                echo "<script>
                    alert('Invalid Username);
                </script>";
        }
    
     } else if (isset($_POST['admin_login'])) {
         
         $admin_user = mysqli_real_escape_string($conn, $_POST['admin_username']);
         $admin_pass = mysqli_real_escape_string($conn, $_POST['admin_password']);

         $sql = "SELECT * FROM admin WHERE AdminUser = '$admin_user'";
         $res = mysqli_query($conn, $sql);
         $row = mysqli_fetch_assoc($res);

         $res_pass = $row['AdminPass'];

            if (mysqli_num_rows($res) > 0) {
                if ($admin_pass == $res_pass) {
                    //Session Variables
                    $_SESSION['admin_user'] = $row['AdminUser'];
                    $_SESSION['admin_email'] = $row['AdminEmail'];
                    $_SESSION['admin_fname'] = $row['AdminFName'];
                    $_SESSION['admin_lname'] = $row['UserLName'];
                    $_SESSION['admin_name'] = $row['AdminFName'] . ' ' . $row['AdminLName'];   
                    header("location: admin-dashboard.php");
            
                } else {
                    echo "<script>
                        alert('Incorrect Passsword');
                    </script>";
                }
            } else {
                echo "<script>
                    alert('Invalid Username);
                </script>";
            }
        }
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-wdith, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>BF Online Services</title>
    <link rel="icon" href="img/logo.png">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/mdb.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
		.img_center{ margin-right: auto; margin-left: auto; display: block; width: 100%;
		}
	</style>
</head>
<body>
	<nav class="navbar bg-primary navbar-expand-lg fixed-top top-navbar-collapse">
		<a class="navbar-brand" href="#"><img src="img/logo.png" height="30" width="30"></a>
		<button type="button" class="navbar-toggler mdb-color grey-2" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle Navigation">
			<span class="fa fa-bars text-white"></span>
		</button>
		<div class="navbar-collapse collapse" id="navbar">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link text-white" href="index.php"><span class="fa fa-home"></span> Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link text-white" href="about.php"><span class="fa fa-info-circle"></span> About</a>
				</li>
			</ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="register.php"><span class="fa fa-user-plus"></span> Sign Up</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" data-toggle="modal" data-target="#loginForm"><span class="fa fa-user-circle"></span> Login</a>
                </li>
            </ul>
		</div>
	</nav>

    <!--Modal: Login / Register Form-->
<div class="modal fade" id="loginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog cascading-modal" role="document">
        <!--Content-->
        <div class="modal-content">

            <!--Modal cascading tabs-->
            <div class="modal-c-tabs">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs md-tabs tabs-2 light-blue darken-3" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#panel7" role="tab"><i class="fa fa-user mr-1"></i> User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#panel8" role="tab"><i class="fa fa-user-secret mr-1"></i>Admin</a>
                    </li>
                </ul>

                <!-- Tab panels -->
                <div class="tab-content">
                    <!--Panel 7-->
                    <div class="tab-pane fade in show active" id="panel7" role="tabpanel">

                        <!--Body-->
                        <div class="modal-body mb-1">
                        <form method="post">
                            <div class="md-form form-sm mb-5">
                                <i class="fa fa-user prefix"></i>
                                <input type="text" id="modalLRInput10" name="user_username" class="form-control form-control-lg validate">
                                <label data-error="wrong" data-success="right" for="modalLRInput10">Your Username</label>
                            </div>

                            <div class="md-form form-sm mb-4">
                                <i class="fa fa-lock prefix"></i>
                                <input type="password" name="user_password" id="modalLRInput11" class="form-control form-control-lg validate">
                                <label data-error="wrong" data-success="right" for="modalLRInput11">Your password</label>
                            </div>
                            <div class="text-center mt-2">
                                <a class="btn btn-warning" href="forgot-password.php"><span class="fa fa-lock"></span> Forgot Password?</a>
                                <button type="submit" name="user_login" class="btn btn-info">Log in <i class="fa fa-sign-in ml-1"></i></button>
                            </div>
                        </form>
                        </div>
                    </div>
                    <!--/.Panel 7-->

                    <!--Panel 8-->
                    <div class="tab-pane fade" id="panel8" role="tabpanel">

                        <!--Body-->
                        <div class="modal-body">
                        <form method="post">
                            <div class="md-form form-sm mb-5">
                                <i class="fa fa-user prefix"></i>
                                <input type="text" id="modalLRInput10" name="admin_username" class="form-control form-control-lg validate">
                                <label data-error="wrong" data-success="right" for="modalLRInput10">Your Username</label>
                            </div>
                            <div class="md-form form-sm mb-4">
                                <i class="fa fa-lock prefix"></i>
                                <input type="password" id="modalLRInput11" name="admin_password" class="form-control form-control-lg validate">
                                <label data-error="wrong" data-success="right" for="modalLRInput11">Your password</label>
                            </div>
                                 <div class="text-center mt-2">
                                <button type="submit" class="btn btn-info" name="admin_login">Log in <i class="fa fa-sign-in ml-1"></i></button>
                            </div>
                        </form>
                        </div>
                    </div>
                    <!--/.Panel 8-->
                </div>

            </div>
        </div>
        <!--/.Content-->
    </div>
</div>

    <div class="view jarallax" style="height: 100vh;">
    <img class="jarallax-img" src="https://mdbootstrap.com/img/Photos/Others/img%20%2844%29.jpg" alt="">
    <div class="mask rgba-blue-slight">
      <div class="container flex-center text-center">
        <div class="row mt-5">
          <div class="col-md-12 wow fadeIn mb-3">
            <h1 class="display-3 mb-2 wow fadeInDown" data-wow-delay="0.3s"><a class="text-white font-weight-bold">Bryle and Francis</a><a class="text-warning font-weight-bold"><br>Online Service Provider</a></h1>
          </div>
        </div>
      </div>
    </div>
  </div>
    <!--Parallax Here-->
    <div class="parallax"></div>
		<div class="row text-center mx-auto">
			<div class="col-lg-6 col-lg-md-6 col-sm-12 col-xs-12">
				<h3 style="font-size: 50px; padding-top:20px;" class="col-lg-12 text-center"><span class="fa fa-flag"></span> Our Mission</h3>
				<p style="font-size: 25px;">Through the world's leading technology and services in business process and document management, we're at the heart of enterprises small to large, giving our clients the freedom to focus on what matters most: their real business.</p>
			</div>
            <div class="col-lg-6 col-lg-md-6 col-sm-12 col-xs-12">
                <h3 style="font-size: 50px; padding-top:20px;" class="col-lg-12 text-center"><span class="fa fa-eye"></span> Our Vision</h3>
                <p style="font-size: 25px;">Within the future years, BF Online Service Provider will be the next leading service provider in the country </p>
            </div>
		</div>
<!-- Footer -->
    <section id="footer">
        <div class="container">
            <div class="row text-center text-xs-center text-sm-left text-md-left">
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <h5>Bryle and Frank Online Service Provider</h5>
                    <ul class="list-unstyled quick-links">
                        <h5 class="text-white"><span class="fa fa-info-circle"></span> Our services provides Electric, Water, Plumbing, Household and Computer services. We provide convenient services to help manage your utility</h5>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <h5>Contact Us</h5>
                    <ul class="list-unstyled quick-links">
                        <li><a style="font-size: 20px;" href="javascript:void();"><i class="fa fa-map-marker"></i> Lopez Jaena St., Brgy San Isidro, Jaro, Iloilo City</a></li>
                        <li><a style="font-size: 20px;" href="javascript:void();"><i class="fa fa-mobile"></i>0935675432</a></li>
                        <li><a style="font-size: 20px;" href="javascript:void();"><i class="fa fa-envelope"></i> bf_service_provider@gmail.com</a></li>
                        <li><a style="font-size: 20px;" href="javascript:void();"><i class="fa fa-history"></i> Monday to Sunday - Opens 24 hours</a></li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <h5>Map</h5>
                    <ul class="list-unstyled quick-links">
                        <div id="bf_map" style="width: 400px; height: 250px;"></div>
                        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhBuIWDfjqk26jnvuR95_-ZHXhFV7dcdA&libraries=places&callback=initMap"></script>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-5">
                    <h4 class="text-white text-center">Social Media</h4>
                    <ul class="list-unstyled list-inline social text-center">
                        <li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-facebook"></i></a></li>
                        <li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-instagram"></i></a></li>
                        <li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-google-plus"></i></a></li>
                        <li class="list-inline-item"><a href="javascript:void();" target="_blank"><i class="fa fa-envelope"></i></a></li>
                    </ul>
                </div>
                </hr>
            </div>  
        </div>
    </section>
		<div style="padding: 15px 0;" class="mdb-color darken-4 text-center text-white">
			<h6 class="col-lg-12">Develop by Bryle_Frank Solutions &copy 2018. All Rights Reserved</h6>
		</div>
<script src="js/jquery.min.js"></script>	
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/mdb.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/map.js"></script>
</body>
</html>
