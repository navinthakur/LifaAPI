<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);
	$courtid = $hugeArray{"courtid"};


	$faqarray[] = ["directoryid"=>"1","title"=>"This is dummy Title","date"=>"02-04-2020","url" => "http://35.194.40.144/agentbhai/law/mobileapi/images/noimage.png"];
	$faqarray[] = ["directoryid"=>"2","title"=>"This is dummy Title","date"=>"02-04-2020","url" => "http://35.194.40.144/agentbhai/law/mobileapi/images/noimage.png"];
	$faqarray[] = ["directoryid"=>"3","title"=>"This is dummy Title","date"=>"02-04-2020","url" => "http://35.194.40.144/agentbhai/law/mobileapi/images/noimage.png"];
	$faqarray[] = ["directoryid"=>"4","title"=>"This is dummy Title","date"=>"02-04-2020","url" => "http://35.194.40.144/agentbhai/law/mobileapi/images/noimage.png"];
	

	



	$json_output = array("status" => "1","videourl"=>"https://flutter.github.io/assets-for-api-docs/assets/videos/butterfly.mp4","msg"=> "Record Found","data"=> $faqarray);
	
	/*$getfaq = mysql_query("select * from questionlist where (questionid='$questionid')");
	$getfaqcount = mysql_num_rows($getfaq);
	if ($getfaqcount > 0) {
		$count = "1";
		while($getfaqrows = mysql_fetch_array($getfaq)){
			$answer = $getfaqrows["fullanswer"];
			if ($answer == "" || $answer == null || $answer == "null") {
				$answer = 'No Answer Added';
			}
			$faqarray[] = ["questionid"=>$getfaqrows["questionid"],"question"=>$getfaqrows["questionfull"],"answer" => $answer,"videourl" =>"https://flutter.github.io/assets-for-api-docs/assets/videos/butterfly.mp4" ];
			
		}
		$json_output = array("status" => "1","msg"=> "Record Found","data"=> $faqarray);
	}else{
		$json_output = array("status" => "0","msg" => "No Record Found!!");
	}*/

	
	header('Content-type: application/json');
	echo json_encode($json_output);
?>