<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);


	$faqarray[] = ["stateid"=>"1","statename"=>"Maharashtra"];

	$json_output = array("status" => "1","msg"=> "Record Found","data"=> $faqarray);



	
	
	/*$getfaq = mysql_query("select * from sectionactintro where (sectionsubid='$sectionsubid')");
	$getfaqcount = mysql_num_rows($getfaq);
	if ($getfaqcount > 0) {
		$count = "1";
		while($getfaqrows = mysql_fetch_array($getfaq)){
			$sectionrefid = $getfaqrows["sectionrefid"];
			$getsec = mysql_query("select * from lawsectionact where actuniqueid='$sectionrefid'");
			$getsecrows = mysql_fetch_assoc($getsec);

			$faqarray[] = ["sectionname"=>$getsecrows["actchapter"],"sectontitle"=>$count++,"actintro" =>$getfaqrows["actintro"]];
			
		}
		$json_output = array("status" => "1","msg"=> "Record Found","videourl"=>"https://flutter.github.io/assets-for-api-docs/assets/videos/butterfly.mp4","data"=> $faqarray);
	}else{
		$json_output = array("status" => "0","msg" => "No Record Found!!");
	}*/

	
	header('Content-type: application/json');
	echo json_encode($json_output);
?>