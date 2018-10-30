<!DOCTYPE html>	
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>BF Online Services</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/logo.png">
</head>
<body>
<!-- Registration form here -->
<div class="container">
        <div class="row main">
            <div class="text-dark ml-5">
                <h1 class="text-center"><img style="border-radius: 50%; " src="img/logo.png" alt="Theology" height="80" width="80"> Sign Up In BF Online Services</h1>
                    <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="row">   
                        <div class="form-group col-md-6">
                            <label for="lastname" class="cols-sm-2 control-label">Last Name</label>
                            <div class="cols-sm-10">
                                    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name" required>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="firstname" class="cols-sm-2 control-label">First Name</label>
                            <div class="cols-sm-10">
                                    <input type="text" class="form-control" name="firstname" id="firstname"  placeholder="First Name" required />
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="gender" class="cols-sm-2 control-label">Gender</label>
                            <div class="cols-sm-10">
                                <select id="gender" class="form-control" name="gender" required>
                                    <option value="">Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email" class="cols-sm-2 control-label">Email</label>
                            <div class="cols-sm-10">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" required />
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="username" class="cols-sm-2 control-label">Username</label>
                            <div class="cols-sm-10">
                                    <input class="form-control" type="text" name="username" id="username" placeholder="Username" required>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password" class="cols-sm-2 control-label">Password</label>
                            <div class="cols-sm-10">
                                    <input class="form-control" type="password" name="password" id="password" placeholder="Password" required>
                            </div>
                        </div>
                            <div class="form-group col-md-6">
                                <label for="confirm_pass" class="cols-sm-2 control-label">Confirm Password</label>
                                <div class="cols-sm-10">
                                        <input class="form-control" type="password" name="confirm_pass" id="confirm_pass" placeholder="Confirm Password" required>
                                </div>
                            </div>
                        <div class="form-group mx-auto col-md-6">
                            <button class="btn btn-success btn-lg col-md-10"  name="register" id="register">REGISTER</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
<?php
    if (isset($_POST['register'])) {
        $conn = mysqli_connect('localhost', 'root', '', 'online_services') or 
        die("Connection Failed: " . mysqli_error());
        
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $confirm_pass = htmlspecialchars($_POST['confirm_pass']);

        $check_email_sql = mysqli_query($conn, "SELECT * FROM users WHERE UserEmail = '$email'");
        $check_user_sql = mysqli_query($conn, "SELECT * FROM users WHERE Username = '$username'");

        if (mysqli_num_rows($check_email_sql) > 0) {
            echo "<script>
                alert('Email is already existing');
            </script>";
        } else if (mysqli_num_rows($check_user_sql) > 0) {
            echo "<script>
                alert('Username is already existing');
            </script>";
        } else if ($password != $confirm_pass) {
            echo "<script>
                alert('Password do not match');
            </script>";
        } else {
            //query
            $register_sql = mysqli_query($conn, "INSERT INTO users(UserLName, UserFName, UserEmail, UserGender, Username, UserPass) VALUES('$lastname', '$firstname', '$email', '$gender', '$username', '$password')");

            //check if query is correct or not
            if ($register_sql) {
                echo "<script>
                    alert('Successfully registered');
                </script>
                <meta http-equiv='refresh' content='0; url=index.php?remarks=success'>";
            } else {
                echo "<script>
                    alert('Failure in registration');
                </script>";
            }
        }

    }
?>
    <script>
        var gender = document.getElementById('gender').value;
        
         if(gender == " ") {
            alert('Please specify your gender');
        }
    </script>    <!-- JavaScript Libraries -->
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/popper.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/jquery.js"></script>
</body>
</html>

