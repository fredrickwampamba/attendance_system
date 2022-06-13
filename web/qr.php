<?php 
	function produce_qr_code($qrcode_text,$qr_layout = 'H', $qr_size = 2, $qr_param = 1){
	    include('phpqrcode/qrlib.php');
	    $path = 'qrcode.png';
	    QRcode::png($qrcode_text, $path, $qr_layout, $qr_size, $qr_param);
	    $type = pathinfo($path, PATHINFO_EXTENSION);
	    $data = file_get_contents($path);
	    unlink($path);
	    return $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
	}

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

	if (empty($lecturerID)) {
		header("Location: login.php");
		exit();
	}
	if (empty($_GET['lecID'])) {
		header("Location: index.php");
		exit();
	}

	$currentURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[SERVER_ADDR]$_SERVER[REQUEST_URI]";
	// $currentURL = substr($currentURL, 0, strpos($currentURL, "web/qr.php"))."api/insert_attendance.php?lectureID=";
	$currentURL = "https://kwaug.com/api/insert_attendance.php?lectureID=";
	echo produce_qr_code($currentURL.$_GET['lecID'],"L",20);
 ?>