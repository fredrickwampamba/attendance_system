<?php 
	error_reporting(0);
	try {
		if ($_SERVER['REQUEST_METHOD'] == "POST") {

			include '../conn/conn.php';

			/*lecturer_email*/
			$lecturer_email = $_REQUEST['lecturer_email'];
			if(empty($lecturer_email)) throw new Exception("Email is invalid");

			$sql = "SELECT * FROM lecturers WHERE lecturer_email = '$lecturer_email' LIMIT 1";
			$statement = $conn->query($sql);
			if ($statement->num_rows < 1) throw new Exception("No email found");

			$fetch_data = $statement->fetch_assoc();

			$lecturerID = $fetch_data['lecturerID'];
			$lecturer_name = $fetch_data['lecturer_name'];

			$new_password = substr(md5(rand(0,100000)), 0, 7);

			/*html for the email*/
			$html = "
				<html>
				<head>
				  <title>Password Reset</title>
				</head>
				<body>
				  <p>Your requested for a password reset: <strong>$new_password</strong> is your new password.</p>
				  <p>Please reply to: $email_from</p>
				</body>
				</html>
				";
			/*To send HTML mail, the Content-type header must be set*/
			$headers[] = 'MIME-Version: 1.0';
			$headers[] = 'Content-type: text/html; charset=iso-8859-1';

			$headers[] = 'From: Dear '.$lecturer_name.' -  <'.EMAILING_EMAIL.'>';

			if(!mail($lecturer_email, $subject, $html, implode("\r\n", $headers))){
				throw new Exception("Email sending failed");
			}
			$new_password = md5($new_password);
			$conn->query("UPDATE lecturers SET lecturer_password = '$new_password' WHERE lecturerID = '$lecturerID'");

			header('HTTP/1.1 200 OK');
			header('Content-Type: application/json; charset=UTF-8');
			echo json_encode(array("msg"=>"Check your email", "redirect"=>"./index.php"));

		}else{
			throw new Exception("Invalid Request Method");
		}
	} catch (Exception $e) {
		header('HTTP/1.1 422 Unprocessable Entity');
		header('Content-Type: application/json; charset=UTF-8');
		echo json_encode(array('errorMsg' => $e->getMessage()));
	}

 ?>