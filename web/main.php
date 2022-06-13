<?php 
	if (version_compare(PHP_VERSION, '5.4.0') >= 0) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }else{
        if(session_id() == null) {
            session_start();
        }
    }

	if (empty($_SESSION['lecturerID'])) {
		header("Location: login.php");
		exit();
	}

	function fileNameBeautifier($filename) {
	    $filename = str_replace('-', ' ', $filename);
	    $filename = str_replace('_', ' ', $filename);
	    $filename = ucwords(strtolower($filename));
	    if ($filename === 'Index') {
	        $filename = "Lecturer Dashboard";
	    }
	    return $filename;
	}

	if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
		$location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		header('HTTP/1.1 301 Moved Permanently');
		header('Location: ' . $location);
		exit;
	}

	define("LECTURERID", $_SESSION['lecturerID']);
	
	require '../conn/conn.php';

	require '../api/db_info.php';

	$db_info = new Db_info();
	$db_info->set_conn($conn);
	$lecturer_info = $db_info->get_lecturer_info(LECTURERID);
	$academic_year = $db_info->get_year_info();
	$last_login_info = $db_info->get_last_login(LECTURERID);

 ?>