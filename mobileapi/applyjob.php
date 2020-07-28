<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);
	$jobapplieddate = date("d-m-Y H:i:s");
	$jobid = $hugeArray{"jobid"};
	$loginid = $hugeArray{"loginid"};

	$applyjob = mysql_query("INSERT INTO `tbljobapplied`(`jobrefid`, `jobrefloginid`, `jobapplieddate`) VALUES ('$jobid','$loginid','$jobapplieddate')");
	if ($applyjob) {
		$json_output = array("status"=>"1","msg"=>"Applied Successfully");
	}else{
		$json_output = array("status"=>"0","msg"=>"Sorry Something went wrong!!");
	}


	header('Content-type: application/json');
	echo json_encode($json_output);
?>