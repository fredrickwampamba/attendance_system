<?php 
	error_reporting(0);
	try {
		if ($_SERVER['REQUEST_METHOD'] == "POST") {

			include '../conn/conn.php';

			/*Registration Number*/
			$reg_no = strtoupper($_REQUEST['reg_no']);
			if(empty($reg_no)) throw new Exception("Registration No. invalid");
			/*Date and time*/
			$date_time = date("Y-m-d H:i:s");
			/*GPS*/
			$gps = $_REQUEST['gps'];
			if(empty($gps)) throw new Exception("Location invalid");
			/*Ip address*/
			// $ip = $_REQUEST['ip'];
			if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			    $ip = $_SERVER['HTTP_CLIENT_IP'];
			} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
			    $ip = $_SERVER['REMOTE_ADDR'];
			}
			
			if(empty($ip)) throw new Exception("IP address invalid");
			/*Mac Address*/
			$mac = strtoupper($_REQUEST['mac']);
			if(empty($mac)) throw new Exception("Mac Address invalid");
			/*Lecture ID*/

			/*dev_imei ///  UUID*/
			$dev_imei = strtoupper($_REQUEST['uuid']);
			$statement = $conn->query("SELECT * FROM students WHERE reg_no = '$reg_no' AND dev_imei = '$dev_imei'")->fetch_assoc();
			$db_dev_imei = strtoupper($statement['dev_imei']);
			if($dev_imei != $db_dev_imei) throw new Exception("Unknown device, visit ICT center");

			$lectureID = $_REQUEST['lectureID'];
			if(empty($lectureID)) throw new Exception("Lecture is invalid");
			$sql = "SELECT * FROM lectures WHERE lecture_id = '$lectureID'";
			$statement = $conn->query($sql);
			if($statement->num_rows < 1){
				throw new Exception("Lecture Not Found: Did you scan the right QR code?");
			}

			$lec_res = $statement->fetch_assoc();
			$duration = $lec_res['time_bound'];
			$lecture_date = $lec_res['lecture_date']." ".$lec_res['lecture_time'];

			$a = strtotime(date('Y-m-d h:i:sa'));
	        $b = strtotime(date('Y-m-d h:i:sa', strtotime(" +".$duration." minutes", strtotime($lecture_date))));

			if ($a > $b) {
				throw new Exception("Lecture Ended", 1);
			}

			validate_attendance($conn,$lectureID,$reg_no,$gps);

			$sql = "INSERT INTO attendance(reg_no,date_time,gps,ip,mac,lectureID) VALUES('$reg_no','$date_time','$gps','$ip','$mac','$lectureID')";
			if ($conn->query($sql)) {

				header('HTTP/1.1 200 OK');
				header('Content-Type: application/json; charset=UTF-8');
				echo json_encode(array("msg"=>"Attendance Taken", "status"=> true));

			}else{
				throw new Exception("Submission Failed");
			}

		}else{
			throw new Exception("Invalid Request Method");
		}
	} catch (Exception $e) {
		// header('HTTP/1.1 422 Unprocessable Entity');
		header('HTTP/1.1 200 OK');
		header('Content-Type: application/json; charset=UTF-8');
		echo json_encode(array('errorMsg' => $e->getMessage(), "status"=> false));
	}

	function validate_attendance($conn,$lectureID,$reg_no,$stud_gps){
		if ($conn->query("SELECT * FROM attendance WHERE reg_no = '$reg_no' AND lectureID = '$lectureID'  ")->num_rows > 0) {
			throw new Exception("Attendance already taken");
		}
		
		/*Lecture gps*/
		$gps_sql = $conn->query("SELECT * FROM lectures WHERE lecture_id = '$lectureID'")->fetch_assoc();
		$gps = explode(',', $gps_sql['lecture_gps']);
		$lat = (double)$gps[0];
        $long = (double)$gps[1];
		/*Lecture gps*/

		/*Student gps*/
		$gpss = explode(',', $stud_gps);
		$lat_stud = (double)$gpss[0];
		$long_stud = (double)$gpss[1];
		/*Student gps*/

		if (getDistance($lat,$long,$lat_stud,$long_stud) > 700) {
			throw new Exception("Location out of range");
		}

	}

	

	function getDistance($lat1, $lot1, $lat2, $lot2, $earthRadius = 6371000)
	{
	  // convert from degrees to radians
	  $latFrom = deg2rad($lat1);
	  $lonFrom = deg2rad($lot1);
	  $latTo = deg2rad($lat2);
	  $lonTo = deg2rad($lot2);

	  $latDelta = $latTo - $latFrom;
	  $lonDelta = $lonTo - $lonFrom;

	  $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
	  return $angle * $earthRadius;
	}
 ?>