<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);
	
	$getfaq = mysql_query("select * from tblcollegedirectory");
	$getfaqcount = mysql_num_rows($getfaq);
	if ($getfaqcount > 0) {
		$count = "1";
		while($getfaqrows = mysql_fetch_array($getfaq)){
				$faqarray[] = ["directoryid"=>$getfaqrows["directoryid"],"directoryname"=>$getfaqrows["directoryname"],"image" => "http://35.194.40.144/agentbhai/law/mobileapi/". $getfaqrows["iconimage"]];
		}
		$json_output = array("status" => "1","msg"=> "Record Found","data"=> $faqarray);
	}else{
		$json_output = array("status" => "0","msg" => "No Record Found!!");
	}

	
	header('Content-type: application/json');
	echo json_encode($json_output);
?>