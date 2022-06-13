<?php 
	error_reporting(0);
	try {
		if ($_SERVER['REQUEST_METHOD'] == "POST") {

			include '../conn/conn.php';

			/*reg_no*/
			$reg_no = $_REQUEST['reg_no'];
			if(empty($reg_no)) throw new Exception("Registration No. is invalid");
			/*yearID*/
			// $yearID = $_REQUEST['yearID'];
			$year = date("y-m-d h:i:sa");
			// if(empty($yearID)) throw new Exception("YearID name invalid");
			/*dev_imei*/
			$dev_imei = $_REQUEST['uuid'];
			if(empty($dev_imei) || strlen($dev_imei) > 50) throw new Exception("Invalid Device UUID");

			/*If the same are in db, allow*/
			$sql = "SELECT * FROM students WHERE reg_no = '$reg_no' AND dev_imei = '$dev_imei'";
			$statement = $conn->query($sql);

			if ($statement->num_rows > 0) {
				header('HTTP/1.1 200 OK');
				header('Content-Type: application/json; charset=UTF-8');
				echo json_encode(array("msg"=>"Student Information Saved", "status"=> true));
				exit();
			}

			/*If the same are in db, allow*/

			$sql = "INSERT INTO students(reg_no,dev_imei,yearID) VALUES('$reg_no','$dev_imei','$year')";
			if ($conn->query($sql)) {

				header('HTTP/1.1 200 OK');
				header('Content-Type: application/json; charset=UTF-8');
				echo json_encode(array("msg"=>"Student Information Saved", "status"=> true));

			}else{
				throw new Exception("Submission Failed");
			}

		}else{
			throw new Exception("Invalid Request Method");
		}
	} catch (Exception $e) {
		header('HTTP/1.1 200 OK');
		header('Content-Type: application/json; charset=UTF-8');
		echo json_encode(array('errorMsg' => $e->getMessage(), "status"=> false));
	}

 ?>