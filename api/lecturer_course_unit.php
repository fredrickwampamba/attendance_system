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

			/*course_unit_id*/
			$course_unit_id = $_REQUEST['course_unit_id'];
			if(empty($course_unit_id)) throw new Exception("Course unit is invalid");

			/*Get active year*/
			$statement = $conn->query("SELECT * FROM years WHERE active = 1")->fetch_assoc();
			$yearID = $statement['yearID'];
			/*Get active year*/

			if ($conn->query("SELECT * FROM lecturer_course_units WHERE yearID = '$yearID' AND lecturerID = '$lecturerID' AND course_unit_id = '$course_unit_id' AND del !=1")->num_rows > 0) {
				throw new Exception("Already enrolled !!");
			}

			$sql = "INSERT INTO lecturer_course_units(yearID,course_unit_id,lecturerID) VALUES('$yearID','$course_unit_id','$lecturerID')";
			if ($conn->query($sql)) {

				header('HTTP/1.1 200 OK');
				header('Content-Type: application/json; charset=UTF-8');
				echo json_encode(array("msg"=>"Enrolled Successfully"));

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

 ?>