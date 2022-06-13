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

			/*Lecture ID to be auto generated*/
			$lecture_id = generate_lecture_id($conn);
			/*lecture date*/
			$lecture_date = $_REQUEST['lecture_date'];
			if(empty($lecture_date) || strtotime($lecture_date) < strtotime(date("Y-m-d"))) throw new Exception("Lecture Date invalid");
			/*lecturer course unit*/
			$lecture_course_unit = $_REQUEST['lecture_course_unit'];
			if(empty($lecture_course_unit)) throw new Exception("Course Unit is invalid");
			$sql = "SELECT * FROM lecturer_course_units WHERE id = '$lecture_course_unit' LIMIT 1";
			$statement = $conn->query($sql)->fetch_assoc();
			$course_unit_id = $statement['course_unit_id'];
			/*Lecture Time*/
			$lecture_time = $_REQUEST['lecture_time'];
			if(empty($lecture_time)) throw new Exception("Lecture Time invalid");
			/*Time Bound*/
			$time_bound = $_REQUEST['time_bound'];
			if(empty($time_bound)) throw new Exception("Time invalid");
			/*Lecture GPS*/
			$lecture_gps = $_REQUEST['lecture_gps'];
			if(empty($lecture_gps)) throw new Exception("Lecture GPS is invalid... <br> Allow location pop up !!<br> Location loading. Please wait.");
			/*Lecture Name*/
			$lecture = $lecture_date."/".$lecture_id."/".$lecture_time;
			/*Lecturer ID*/
			// $lecturerID = $_REQUEST['lecturerID'];
			// if(empty($lecturerID)) throw new Exception("LectureID is invalid");

			/*Get active year*/
			$statement = $conn->query("SELECT * FROM years WHERE active = 1")->fetch_assoc();
			$yearID = $statement['yearID'];
			/*Get active year*/

			$sql = "INSERT INTO lectures(course_unit_id,lecture_id,lecture_date,lecture_time,time_bound,lecture_gps,lecture,lecturerID,yearID) VALUES('$course_unit_id','$lecture_id','$lecture_date','$lecture_time','$time_bound','$lecture_gps','$lecture','$lecturerID','$yearID')";
			if ($conn->query($sql)) {
				$url_to_qr_code = "qr.php?lecID=".$lecture_id;
				header('HTTP/1.1 200 OK');
				header('Content-Type: application/json; charset=UTF-8');
				echo json_encode(array("msg"=>"Lecture Submitted Successfully", "url"=>$url_to_qr_code));

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

	function generate_lecture_id($conn){
		$lecture_id = rand(0,100000);
		if($conn->query("SELECT * FROM lectures WHERE lecture_id = '$lecture_id'")->num_rows > 0) generate_lecture_id();
		return $lecture_id;
	}

 ?>