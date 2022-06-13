<?php 
	error_reporting(0);
	try {
		if ($_SERVER['REQUEST_METHOD'] == "POST") {

			include '../conn/conn.php';

			/*lecturer_email*/
			$lecturer_email = $_REQUEST['lecturer_email'];
			if(empty($lecturer_email)) throw new Exception("Email is invalid");
			/*lecturer_password*/
			$lecturer_password = $_REQUEST['lecturer_password'];
			if(empty($lecturer_password)) throw new Exception("Password is invalid");

			$sql = "SELECT * FROM lecturers WHERE lecturer_email = '$lecturer_email' LIMIT 1";
			$statement = $conn->query($sql);
			if ($statement->num_rows < 1) throw new Exception("No account found");

			$fetch_data = $statement->fetch_assoc();

			$db_pass = $fetch_data['lecturer_password'];
			$lecturerID = $fetch_data['lecturerID'];

			if (md5($lecturer_password) != $db_pass) throw new Exception("Invalid Credentials");

			if (version_compare(PHP_VERSION, '5.4.0') >= 0) {
			    if (session_status() === PHP_SESSION_NONE) {
			        session_start();
			    }
			}else{
			    if(session_id() == null) {
			        session_start();
			    }
			}

			$_SESSION['lecturerID'] = $lecturerID;
			$sub_date = date("Y-m-d H:i:s");
			$remote_ip_address = $_SERVER['REMOTE_ADDR'];

			$conn->query("INSERT INTO last_login (lecturerID,date_time,remote_ip) VALUES ('$lecturerID','$sub_date','$remote_ip_address')");

			header('HTTP/1.1 200 OK');
			header('Content-Type: application/json; charset=UTF-8');
			echo json_encode(array("msg"=>"Login Successful", "redirect"=>"index.php"));

		}else{
			throw new Exception("Invalid Request Method");
		}
	} catch (Exception $e) {
		header('HTTP/1.1 422 Unprocessable Entity');
		header('Content-Type: application/json; charset=UTF-8');
		echo json_encode(array('errorMsg' => $e->getMessage()));
	}

 ?>