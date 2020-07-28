<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);
	$courseid =$hugeArray{"courseid"};


	$getfaq = mysql_query("select * from tblsemesterlist where courserefid='$courseid'");
	$getfaqcount = mysql_num_rows($getfaq);
	if ($getfaqcount > 0) {
		while($getfaqrows = mysql_fetch_array($getfaq)){
			$faqarray[] = ["semesterid"=>$getfaqrows["semesterid"],"courserefid" => $getfaqrows["courserefid"],"semestername"=>$getfaqrows["semestername"],"semesterimage"=> "http://35.194.40.144/agentbhai/law/mobileapi/".$getfaqrows["semesterimage"]];
		}
		$json_output = array("status" => "1","msg"=> "Record Found","data"=> $faqarray);
	}else{
		$json_output = array("status" => "0","msg" => "No Record Found!!");
	}

	
	header('Content-type: application/json');
	echo json_encode($json_output);
?>