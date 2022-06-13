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
				$lecturer_course_unit = trim($_POST['lecturer_course_unit']);
				if (empty($lecturer_course_unit)) throw new Exception("Lecture ID is required");
				$sql = "SELECT * FROM lecturer_course_units WHERE id = '$lecturer_course_unit'";
				$statement = $conn->query($sql);
				if ($statement->num_rows < 1) throw new Exception("Course Unit enrollment not found");
				$information = $statement->fetch_assoc();
				$course_unit_id = $information['course_unit_id'];
				$yearID = $information['yearID'];
				$lecturerID = $information['lecturerID'];

				try {
					$conn->autocommit(FALSE);
				    if(!$conn->query("UPDATE lectures SET del = 1 WHERE course_unit_id = '$course_unit_id' AND yearID = '$yearID' AND lecturerID = '$lecturerID'")) throw new Exception("An error Occured");
				    if(!$conn->query("UPDATE lecturer_course_units SET del = 1 WHERE id = '$lecturer_course_unit'")) throw new Exception("An error Occured");
				    $conn->commit();
				} catch (Exception $e) {
					$conn->rollback();
					throw new Exception($e->getMessage());
				}

				header('HTTP/1.1 200 OK');
				header('Content-Type: application/json; charset=UTF-8');
				echo json_encode(array("msg"=>"Un enrollment Successfully"));
		}else{
			throw new Exception("Invalid Request Method");
		}

	} catch (Exception $e) {
		header('HTTP/1.1 422 Unprocessable Entity');
		header('Content-Type: application/json; charset=UTF-8');
		echo json_encode(array('errorMsg' => $e->getMessage()));
	}

 ?>