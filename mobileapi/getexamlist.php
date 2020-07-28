<?php
include("confi.php");
$json = file_get_contents('php://input');
$hugeArray = json_decode($json,true);
date_default_timezone_set("Asia/Kolkata");

$getserieslist = mysql_query("select * from tbl_testseries");
$getserieslistcount = mysql_num_rows($getserieslist);
if ($getserieslistcount > 0 ) {
		
	while($getserieslistrows = mysql_fetch_array($getserieslist)){

		$data_array[] = ["examid"=> $getserieslistrows["examid"],"examtitle"=>$getserieslistrows["seriestitle"],"examdetails"=>$getserieslistrows["seriesdetails"],"examicon"=>"http://35.194.40.144/agentbhai/law/mobileapi/".$getserieslistrows["seriesicon"]];
	}	
	$json_output = array("status" => "1","msg" =>"Record Found!!","data"=>$data_array);
}else{
	$json_output = array("status" => "0","msg" =>"No Record Found!!");
}




header('Content-type: application/json');
echo json_encode($json_output);
?>