<!DOCTYPE html>
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
</head>
<body>
	<div class="container py-5 mt-5">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-6 mx-auto">
						<div class="card yellow lighten-1 rounded-0">
							 <div class="card-header orange lighten-1">
                            	<h3 class="text-center text-dark mb-0"><span class="fa fa-lock"></span> Forgot Password</h3>
                        	</div>
							<div class="card-body">
								<form class="form" method="post" role="form" autocomplete="off" id="formLogin">
									<div class="md-form">
										<i class="fa fa-envelope prefix"></i>
										<input class="form-control form-control-lg rounded-0" type="email" name="email" required>
										<label class="text-dark">Email</label>
									</div>
									<button class="btn btn-success btn-lg float-right" type="submit" name="forgot_pass" id="forgot_pass"><i class="fa fa-paper-plane-o"></i> Send
									</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
	
    $conn = mysqli_connect('localhost', 'root', '', 'online_services')
    or die('Connection Failed: ' . mysqli_error());

	if (isset($_POST['forgot_pass'])) {
		
			require 'PHPMailer/PHPMailerAutoload.php';

			//define var
			$email = mysqli_real_escape_string($conn, $_POST['email']);

			//query start
        	$res = mysqli_query($conn, "SELECT * FROM users WHERE UserEmail = '$email'");
        	$count = mysqli_num_rows($res);
        	$row = mysqli_fetch_assoc($res);

        	//concatinate name
        	$name = htmlspecialchars($row['UserFName']) . " " . htmlspecialchars($row['UserLName']);

        	//check if email is valid
        	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            	echo "This $email is invalid";
        	}

        if ($count > 0 ) {
            
            $mail = new PHPMailer();

            $mail->SMTPDebug = 2; //Debugging
            $mail->isSMTP(); //Set Mailer to use SMTP
            $mail->Host = "ssl://smtp.gmail.com:465"; //Host Name
            $mail->SMTPAuth = true; //if SMTP Host requires authentication to send email
            $mail->SMTPSecure = "ssl"; //set encryption system
            $mail->mailer = "smtp"; //set Email protocol
            $mail->Port = 465; // set SMTP Port
            $mail->setFrom('cputheolib@gmail.com', 'BF Online Service Provider');
            $mail->AddReplyTo('cputheolib@gmail.com', 'BF Online Service Provider');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 
                'verify_peer_name' => false, 'allow_self_signed' => true)); //start connection

            //You must have an unsecured email to perform this
            $mail->Username = "cputheolib@gmail.com"; // set email add
            $mail->Password = "theolibrary"; // set password
            $mail->FromName = 'BF Administrator';
            $mail->Subject = "BF Online Service Provider Forgot Password";
            $mail->Body = "<h3>Hello ".$name. " this is your Password --> '".$row['UserPass']. "'</h3>";
            $mail->AltBody = "This is the plain text version of the email content";
            if (!$mail->send()) {
                ob_end_clean();
                echo "<script>
                        alert('Failure in sending a Password to email, please check your internet connection'); 
                        </script>". $mail->ErrorInfo;
            } else {
                    ob_end_clean();
                    echo "<script>
                        alert('Password sent succesfully');
                    </script>";
                    return true;
            }
        
        } else {
            echo "<script>
                alert('$email is not existing in the database'); 
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