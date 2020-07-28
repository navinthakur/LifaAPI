<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);
	$indianactsectionid=  $hugeArray{"indianactsectionid"};
	$languagetype = $hugeArray{"languagetype"};
	if ($languagetype == "" || $languagetype == null) {
		$languagetype = 'English';
	}
	
	$getcontent = mysql_query("SELECT * FROM tblindianactssection where (indianactsectionid='$indianactsectionid') and (indianactsectionlanguagetype='$languagetype') order by CAST(indianactsectionactno AS UNSIGNED) asc");
	$getcontentcount = mysql_num_rows($getcontent);
	if ($getcontentcount > 0) {
		while($getcontentrows = mysql_fetch_array($getcontent)){
			$indianactsectionrefid = $getcontentrows["indianactsectionrefid"];

			$getsec = mysql_query("select * from tblindianactchapter where indianactuniqueid='$indianactsectionrefid'");
			$getsecrows = mysql_fetch_assoc($getsec);

			$faqarray[] = ["indianactsectionid"=>$getcontentrows["indianactsectionid"],"sectionname"=>$getsecrows["indianactchapter"],"indianactsectionactno"=>$getcontentrows["indianactsectionactno"],"indianactsectionacttitle"=>$getcontentrows["indianactsectionacttitle"],"description"=>$getcontentrows["indianactactintro"],"additionaldetails"=>""];
		}
		$json_output = array("status" => "1","msg"=> "Record Found","videourl"=>"https://flutter.github.io/assets-for-api-docs/assets/videos/butterfly.mp4","data"=> $faqarray);
	}else{
		$json_output = array("status" => "0","msg"=> "No Record Found");
	}

	
	
	header('Content-type: application/json');
	echo json_encode($json_output);
?>