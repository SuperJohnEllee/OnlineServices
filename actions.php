<?php
	$conn = mysqli_connect('localhost', 'root', '', 'online_services'); //connection

	//Approved and Reject
	//set url name
	if (isset($_GET['approved_service'])) {
		
		$approved_service = $_GET['approved_service']; //get url name
		$approved_service_sql = mysqli_query($conn, "UPDATE booking SET Status = 'Approved'"); //query if approved

		$select_booking = "SELECT * FROM booking INNER JOIN services USING(ServiceID) INNER JOIN users USING(UsersID) WHERE bookingID = '$approved_service' ORDER BY DateBooked";
		$booking_res = mysqli_query($conn, $select_booking);

		$booking_row = mysqli_fetch_assoc($booking_res);

		$name = $booking_row['UserFName'] . " " . $booking_row['UserLName']; 
		$email = $booking_row['UserEmail'];

		require 'PHPMailer/PHPMailerAutoload.php'; //PHPMailer

		$mail = new PHPMailer();

		//Configuration
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
        $mail->Subject = "BF Online Service Provider Service Approval";
        $mail->Body = "<h3>Hello ".$name. ", we approved your service from '".$booking_row['ServiceName']. "' 
        a '".$booking_row['ServiceType']."' company</h3>";
        $mail->AltBody = "This is the plain text version of the email content";

        if ($mail->send() && $approved_service_sql) {
        	ob_end_clean();
			echo "<script>
				alert('Sucessfully approved a service and notifies the user in the email');
			</script>
			<meta http-equiv='refresh' content='0; url=admin-manage-bookings.php'>";
			return true;
		
		} else if (!$mail->send()) {
             ob_end_clean();
             echo "<script>
              alert('Failure in sending notifications to email, please check your internet connection'); 
            </script>". $mail->ErrorInfo;
		}
	
	} elseif (isset($_GET['reject_service'])) {
		
		$reject_service = $_GET['reject_service'];
		$reject_service_sql = mysqli_query($conn,  "UPDATE booking SET Status = 'Rejected' WHERE bookingID = '$reject_service'");
		
		echo "<script>
			alert('Sucessfully rejected a service');
		</script>
		<meta http-equiv='refresh' content='0; url=admin-manage-bookings.php'>";
	}

	//Delete Data
	if (isset($_GET['delete_service'])) {
		
		$del_service = $_GET['delete_service'];
		$del_service_sql = mysqli_query($conn, "DELETE FROM services WHERE ServiceID = '$del_service'");

		echo "<script>
			alert('Sucessfully deleted a service');
		</script>
		<meta http-equiv='refresh' content='0; url=admin-manage-services.php'>";
	}
?>