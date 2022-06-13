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

			/*lecturer_name*/
			$lecturer_name = $_REQUEST['lecturer_name'];
			if(empty($lecturer_name)) throw new Exception("Name is invalid");
			/*lecturer_phone*/
			$lecturer_phone = $_REQUEST['lecturer_phone'];
			if(empty($lecturer_phone)) throw new Exception("Phone invalid");
			/*lecturer_email*/
			$lecturer_email = $_REQUEST['lecturer_email'];
			if(empty($lecturer_email)) throw new Exception("Email is invalid");

			$sql = "UPDATE lecturers SET lecturer_name = '$lecturer_name', lecturer_email = '$lecturer_email', lecturer_phone = '$lecturer_phone' WHERE lecturerID = '$lecturerID'";
			if ($conn->query($sql)) {

				header('HTTP/1.1 200 OK');
				header('Content-Type: application/json; charset=UTF-8');
				echo json_encode(array("msg"=>"Profile Information Updated Successfully"));

			}else{
				throw new Exception("Submission Failed");
			}

		}else{
			throw new Exception("Invalid Request Method");
		}
	} catch (Exception $e) {
		header('HTTP/1.1 422 Unprocessable Entity');
		header('Content-Type: application/json; charset=UTF-8');
		echo json_encode(array('errorMsg' => $e->getMessage()));
	}

	function generate_lecturer_id($conn){
		$lecturerID = rand(0,100000);
		if($conn->query("SELECT * FROM lecturers WHERE lecturerID = '$lecturerID'")->num_rows > 0) generate_lecturer_id();
		return $lecturerID;
	}

 ?>