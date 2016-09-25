<?php
	session_start();
	if(!isset($_SESSION['s_id'])){
		header("location:index.php");
	}

	$c_id     = $_SESSION['s_id'];
	$c_tip    = $_SESSION['s_tip'];
	$c_nomape = mb_convert_case(trim($_SESSION['s_nomape']), MB_CASE_TITLE, "UTF-8");

?>