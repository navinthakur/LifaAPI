<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);
	$actid = $hugeArray{"actid"};
	$languagetype = $hugeArray{"languagetype"};
	if ($languagetype == "" || $languagetype == null) {
		$languagetype = 'English';
	}


	$getcontent = mysql_query("SELECT * FROM tblindianactchapter where (actnametyperefid='$actid') and (coilanguagetype='$languagetype')");
	$getcontentcount = mysql_num_rows($getcontent);
	if ($getcontentcount > 0) {
		while($getcontentrows = mysql_fetch_array($getcontent)){
			$faqarray[] = ["indianactchapterid"=>$getcontentrows["indianactchapterid"],"coilanguagetype"=>$getcontentrows["coilanguagetype"],"finalacttype"=>$getcontentrows["finalacttype"],"indianactuniqueid"=>$getcontentrows["indianactuniqueid"],"indianacttile"=>$getcontentrows["indianacttile"],"indianactchapter"=>$getcontentrows["indianactchapter"],"indiansectionchapterno"=> $getcontentrows["indiansectionchapter"]];
		}
		$json_output = array("status" => "1","msg"=> "Record Found","data"=> $faqarray);
	}else{
		$json_output = array("status" => "0","msg"=> "No Record Found");
	}

	
	
	header('Content-type: application/json');
	echo json_encode($json_output);
?>