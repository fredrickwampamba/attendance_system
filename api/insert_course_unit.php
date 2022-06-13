<?php 
	error_reporting(0);
	try {
		if ($_SERVER['REQUEST_METHOD'] == "POST") {

			include '../conn/conn.php';

			/*course_unitID*/
			$course_unitID = $_REQUEST['course_unitID'];
			if(empty($course_unitID)) throw new Exception("Course unit ID / code is invalid");
			/*course_unit*/
			$course_unit = $_REQUEST['course_unit'];
			if(empty($course_unit)) throw new Exception("Course unit name invalid");
			/*semester*/
			$semester = $_REQUEST['semester'];
			if(empty($semester)) throw new Exception("Semester invalid");

			$sql = "INSERT INTO course_units(course_unitID,course_unit,semester) VALUES('$course_unitID','$course_unit','$semester')";
			if ($conn->query($sql)) {

				header('HTTP/1.1 200 OK');
				header('Content-Type: application/json; charset=UTF-8');
				echo json_encode(array("msg"=>"Course Unit Submitted Successfully"));

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