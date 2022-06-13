<?php 
	error_reporting(0);
	try {
		if ($_SERVER['REQUEST_METHOD'] == "POST") {

			include '../conn/conn.php';

			/*year*/
			$year = $_REQUEST['year']; /*Expected format 2021/2022*/
			if(empty($year)) throw new Exception("Year is invalid");
			/*yearID*/
			$yearID = uniqid();
			if(empty($yearID)) throw new Exception("YearID name invalid");
			/*Semester*/
			$semester = $_REQUEST['semester'];/*Expected format Semester I*/
			if(empty($semester)) throw new Exception("Semester invalid");
			/*sem*/
			$sem = $_REQUEST['sem'];/*Expected format sem I*/
			if(empty($sem)) throw new Exception("sem invalid");
			/*Semester*/
			$sql = "INSERT INTO years(yearID,year,semester,sem) VALUES('$yearID','$year','$semester','$sem')";
			if ($conn->query($sql)) {

				header('HTTP/1.1 200 OK');
				header('Content-Type: application/json; charset=UTF-8');
				echo json_encode(array("msg"=>"Year Information Submitted Successfully"));

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