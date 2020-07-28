<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);
	$languagetype = $hugeArray{"languagetype"};

	$getcontent = mysql_query("SELECT * FROM tblindianacts");
	$getcontentcount = mysql_num_rows($getcontent);
	if ($getcontentcount > 0) {
		while($getcontentrows = mysql_fetch_array($getcontent)){
			$faqarray[] = ["actid"=>$getcontentrows["actid"],"acttitle"=>$getcontentrows["acttitle"]];
		}
		$json_output = array("status" => "1","msg"=> "Record Found","data"=> $faqarray);
	}else{
		$json_output = array("status" => "0","msg"=> "No Record Found");
	}

	
	
	header('Content-type: application/json');
	echo json_encode($json_output);
?>