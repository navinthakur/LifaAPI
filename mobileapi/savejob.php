<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);
	$loginid = $hugeArray{"loginid"};
	$jobid = $hugeArray{"jobid"};
	$checksavejob = mysql_query("select * from tbljobsaved where (jobmainid='$jobid') and (jobloginrefid='$loginid')");
	$checksavejobcount = mysql_num_rows($checksavejob);
	if ($checksavejobcount > 0) {
		$delquery = mysql_query("delete from tbljobsaved where (jobmainid='$jobid') and (jobloginrefid='$loginid')");
		if ($delquery) {
			$json_output = array("status"=>"1","msg"=>"Saved Job Removed");
		}else{
			$json_output = array("status" => "0","msg" => "Sorry Something went wrong!!");
		}
		
	}else{
		$jobsave = mysql_query("INSERT INTO `tbljobsaved`(`jobmainid`, `jobloginrefid`) VALUES ('$jobid','$loginid')");	
		if ($jobsave) {
			$json_output = array("status" => "1","msg"=> "Job Saved Successfully");
		}else{
			$json_output = array("status" => "0","msg" => "Sorry Something went wrong!!");
		}
	}
	
	header('Content-type: application/json');
	echo json_encode($json_output);
?>