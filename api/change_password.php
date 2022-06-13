<?php 
	error_reporting(0);

	if (version_compare(PHP_VERSION, '5.4.0') >= 0) {
	    if (session_status() === PHP_SESSION_NONE) {
	        session_start();
	    }
	}else{
	    if(session_id() == null) {
	        session_start();
	    }
	}

	$lecturerID = $_SESSION['lecturerID'];

	try {
		if ($_SERVER['REQUEST_METHOD'] == "POST") {

			include '../conn/conn.php';

			/*lecturer_password*/
			$lecturer_password = $_REQUEST['lecturer_password'];
			if(empty($lecturer_password)) throw new Exception("Password is invalid");

			/*new_lecturer_password*/
			$new_lecturer_password = $_REQUEST['new_lecturer_password'];
			if(empty($new_lecturer_password) || strlen($lecturer_password) <= 3) throw new Exception("New password is invalid (4 characters minimum)");

			$sql = "SELECT * FROM lecturers WHERE lecturerID = '$lecturerID' LIMIT 1";
			$statement = $conn->query($sql);
			if ($statement->num_rows < 1) throw new Exception("No account found");

			$fetch_data = $statement->fetch_assoc();

			$db_pass = $fetch_data['lecturer_password'];
			$lecturerID = $fetch_data['lecturerID'];

			if (md5($lecturer_password) != $db_pass) throw new Exception("Current Password is Invalid");
			
			$new_lecturer_password = md5($new_lecturer_password);/*encrypting new pass*/

			$conn->query("UPDATE lecturers SET lecturer_password = '$new_lecturer_password' WHERE lecturerID = '$lecturerID'");

			header('HTTP/1.1 200 OK');
			header('Content-Type: application/json; charset=UTF-8');
			echo json_encode(array("msg"=>"Password updated"));

		}else{
			throw new Exception("Invalid Request Method");
		}
	} catch (Exception $e) {
		header('HTTP/1.1 422 Unprocessable Entity');
		header('Content-Type: application/json; charset=UTF-8');
		echo json_encode(array('errorMsg' => $e->getMessage()));
	}

 ?>