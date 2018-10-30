<!DOCTYPE html>
<?php
    
    $conn = mysqli_connect('localhost', 'root', '', 'ccs_3400')
    or die('Connection Failed: ' . mysqli_error());
        
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
                $_SESSION['username'] = $row['Username'];
                $_SESSION['email'] = $row['UserEmail'];
                $_SESSION['name'] = $row['UserFName'] . ' ' . $row['UserLName'];   
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
    }
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-wdith, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Advertisement </title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/mdb.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
		.img_center{
			margin-right: auto;
			margin-left: auto;
			display: block;
			width: 100%;
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-expand-lg mdb-color darken-4 fixed-top">
		<a class="navbar-brand" href="#"><img src=""></a>
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
				<li class="nav-item">
					<a class="nav-link text-white" data-toggle="modal" data-target="#loginForm"><span class="fa fa-user-circle"></span> Login</a>
				</li>
			</ul>
		</div>
	</nav>
		<img class="img_center" src="img/bus_service.png">
		<div style="padding: 15px 0;" class="mdb-color darken-4 text-center text-white">
			<h6 class="col-lg-12">Develop by Bryle_Frank Solutions &copy 2018. All Rights Reserved</h6>
		</div>


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
                                <i class="fa fa-envelope prefix"></i>
                                <input type="text" id="modalLRInput10" name="user_username" class="form-control form-control-sm validate">
                                <label data-error="wrong" data-success="right" for="modalLRInput10">Your Username</label>
                            </div>

                            <div class="md-form form-sm mb-4">
                                <i class="fa fa-lock prefix"></i>
                                <input type="password" name="user_password" id="modalLRInput11" class="form-control form-control-sm validate">
                                <label data-error="wrong" data-success="right" for="modalLRInput11">Your password</label>
                            </div>
                            <div class="text-center mt-2">
                                <button type="submit" name="user_login" class="btn btn-info">Log in <i class="fa fa-sign-in ml-1"></i></button>
                            </div>
                        </form>
                        </div>
                        <!--Footer-->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <!--/.Panel 7-->

                    <!--Panel 8-->
                    <div class="tab-pane fade" id="panel8" role="tabpanel">

                        <!--Body-->
                        <div class="modal-body">
                        <form method="post">
                            <div class="md-form form-sm mb-5">
                                <i class="fa fa-envelope prefix"></i>
                                <input type="text" id="modalLRInput10" name="admin_username" class="form-control form-control-sm validate">
                                <label data-error="wrong" data-success="right" for="modalLRInput10">Your Username</label>
                            </div>
                            <div class="md-form form-sm mb-4">
                                <i class="fa fa-lock prefix"></i>
                                <input type="password" id="modalLRInput11" name="admin_password" class="form-control form-control-sm validate">
                                <label data-error="wrong" data-success="right" for="modalLRInput11">Your password</label>
                            </div>
                                 <div class="text-center mt-2">
                                <button type="submit" class="btn btn-info" name="admin_login">Log in <i class="fa fa-sign-in ml-1"></i></button>
                            </div>
                        </form>
                        </div>
                        <!--Footer-->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <!--/.Panel 8-->
                </div>

            </div>
        </div>
        <!--/.Content-->
    </div>
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
