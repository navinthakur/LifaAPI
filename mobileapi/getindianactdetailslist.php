<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);
	$indianactuniqueid=  $hugeArray{"indianactuniqueid"};
	$languagetype = $hugeArray{"languagetype"};
	if ($languagetype == "" || $languagetype == null) {
		$languagetype = 'English';
	}
	$getunique = mysql_query("select * from tblindianactchapter where (indianactuniqueid='$indianactuniqueid')");
	$getuniquerows = mysql_fetch_assoc($getunique);
	$indianacttile = $getuniquerows["indianacttile"];


	$getcontent = mysql_query("SELECT * FROM tblindianactssection where (indianactsectionrefid='$indianactuniqueid') and (indianactsectionlanguagetype='$languagetype') order by CAST(indianactsectionactno AS UNSIGNED) asc");
	$getcontentcount = mysql_num_rows($getcontent);
	if ($getcontentcount > 0) {
		while($getcontentrows = mysql_fetch_array($getcontent)){
			$faqarray[] = ["indianactsectionid"=>$getcontentrows["indianactsectionid"],"indianactsectionactno"=>$getcontentrows["indianactsectionactno"],"indianactsectionacttitle"=>$getcontentrows["indianactsectionacttitle"]];
		}
		$json_output = array("status" => "1","msg"=> "Record Found","actexplanation"=>$indianacttile,"data"=> $faqarray);
	}else{
		$json_output = array("status" => "0","msg"=> "No Record Found");
	}

	
	
	header('Content-type: application/json');
	echo json_encode($json_output);
?>