<?php 
	class Db_info{
		private $conn;
		private $results;

		public function __constructor($conn){
			$this->conn = $conn;
		}

		function set_conn($conn){
			$this->conn = $conn;
		}

		function get_results(){
			return $this->results;
		}

		function get_year_info(){
			return $this->conn->query("SELECT * FROM years WHERE active = 1 LIMIT 1")->fetch_assoc();
		}

		function get_last_login($lecturerID){
			return $this->conn->query("SELECT * FROM last_login WHERE lecturerID = '$lecturerID' ORDER BY date_time DESC LIMIT 1")->fetch_assoc();
		}

		function get_all_logins($lecturerID){
			$statement = $this->conn->query("SELECT * FROM last_login WHERE lecturerID = '$lecturerID' ORDER BY date_time DESC LIMIT 20");
			$i = 1;
			while ($row = $statement->fetch_assoc()) {
				$id = $row['id'];
				$res[] = array($i, $row['remote_ip'], date("D, M dS Y",strtotime($row['date_time'])), date("h:i:s a",strtotime($row['date_time'])));
				$i++;
			}
			return $res;
		}

		function get_lecturer_info($lecturerID){
			return $this->conn->query("SELECT lecturer_name,lecturerID,lecturer_phone,lecturer_email FROM lecturers WHERE lecturerID = '$lecturerID' LIMIT 1")->fetch_assoc();
		}

		function get_lecturer_lectures($lecturerID,$course_unit_id,$yearID){
			$res = array();
			$statement = $this->conn->query("SELECT * FROM lectures WHERE lecturerID = '$lecturerID' AND course_unit_id = '$course_unit_id' AND yearID = '$yearID' AND del !=1");
			$i = 1;
			while ($row = $statement->fetch_assoc()) {
				$id = $row['id'];
				$res[] = array($i, $row['lecture_id'], $row['lecture'], $row['lecture_date'], $row['lecture_time'], $row['time_bound'], "<a href='attendance.php?lec=$id' class='text-primary float-left text-left'>View</a><a href='javascript:void(0);' class='text-right float-right text-danger pl-3 del_lecture' data-id='$id'>Delete</a>");
				$i++;
			}
			return $res;
		}

		function get_lecture_info($lecture_id){
			$res = array();
			$lecture_info = $this->conn->query("SELECT * FROM lectures WHERE id = '$lecture_id' AND del !=1 LIMIT 1")->fetch_assoc();
			$i = 1;
			$lecture_id = $lecture_info['lecture_id'];
			$attendance = $this->conn->query("SELECT * FROM attendance WHERE lectureID = '$lecture_id'");
			while ($row = $attendance->fetch_assoc()) {
				$res[] = array($i, $row['reg_no'], $row['date_time'], $row['gps'], $row['ip'], $row['mac']);
				$i++;
			}
			return array($lecture_info,$res);
		}

		function get_lecturer_course_units($lecturerID, $yearID=null){
			$where_query = "";
			if (!empty($yearID)) {
				$where_query .= " AND years.yearID = '".$yearID."'";
			}
			if (!empty($lecturerID)) {
				$where_query .= " AND lecturer_course_units.lecturerID = '".$lecturerID."'";
			}
			$statement = $this->conn->query("SELECT *, lecturer_course_units.id as lect_course_id, lecturer_course_units.course_unit_id as lect_course_unit_id, years.semester as year_sem FROM lecturer_course_units LEFT JOIN years ON years.yearID = lecturer_course_units.yearID LEFT JOIN course_units ON course_units.id = lecturer_course_units.course_unit_id WHERE del != 1 ".$where_query);
			$i = 1;

			$res = array();

			while ($row = $statement->fetch_assoc()) {
				$id = $row['lect_course_id'];
				$lect_course_unit_id = $row['lect_course_unit_id'];
				$res[] = array($i, $id, $row['course_unit'], $row['course_unitID'], $row['year_sem'], $row['year'], "<a href='lectures.php?course_unit=$lect_course_unit_id' class='text-primary float-left text-left'>View</a><a href='percentages.php?course_unit=$lect_course_unit_id' class='text-dark text-center pl-3'>Percentages</a><a href='javascript:void(0);' class='text-danger pl-3 del_un_enroll_course_unit' data-id='$id'>Delete</a>");
				$i++;
			}
			return $res;
		}

		function get_all_course_units($semester){

			$statement = $this->conn->query("SELECT * FROM course_units WHERE semester = '$semester' ORDER BY course_unit ASC");
			$i = 1;

			$res = array();

			while ($row = $statement->fetch_assoc()) {
				$id = $row['id'];
				$res[] = array($i, $id, $row['course_unit'], $row['course_unitID'], $row['semester'], "<a href='lectures.php?course_unit=$id' class='text-primary float-left text-left'>View</a><a href='javascript:void(0);' class='text-right float-right text-danger pl-3 del_lecture' data-id='$id'>Delete</a>");
				$i++;
			}
			return $res;
		}

		function lecturer_enrolled_check($count){
			if ($count < 1) {
				return false;
			}
			return true;
		}

		function get_course_unit_info($course_unit_id){
			$sql = "SELECT * FROM course_units WHERE id ='$course_unit_id' LIMIT 1";
			$res = $this->conn->query($sql)->fetch_assoc();
			return $res;
		}


	}
 ?>