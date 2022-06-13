<?php 
	session_start();
	$_SESSION['lecturerID'] = null;

	header("Location:./");
	exit();
 ?>