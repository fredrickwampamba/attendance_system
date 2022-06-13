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
	try{

		if ($_SERVER['REQUEST_METHOD'] == "POST") {

			include '../conn/conn.php';

			
				if (empty($lecturerID)) throw new Exception("Session expired, Login");
				$lecture_id = trim($_POST['lecture_id']);
				if (empty($lecture_id)) throw new Exception("Lecture ID is required");
				$sql = "SELECT * FROM lectures WHERE id = '$lecture_id'";
				$statement = $conn->query($sql);
				if ($statement->num_rows < 1) throw new Exception("Lecture ID is required");

				if (!$conn->query("UPDATE lectures SET del = 1 WHERE id = '$lecture_id'")) throw new Exception("An error occured");
				header('HTTP/1.1 200 OK');
				header('Content-Type: application/json; charset=UTF-8');
				echo json_encode(array("msg"=>"Lecture Deleted Successfully"));
		}else{
			throw new Exception("Invalid Request Method");
		}

	} catch (Exception $e) {
		header('HTTP/1.1 422 Unprocessable Entity');
		header('Content-Type: application/json; charset=UTF-8');
		echo json_encode(array('errorMsg' => $e->getMessage()));
	}

 ?>