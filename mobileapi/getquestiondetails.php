<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);
	$questionid = $hugeArray{"questionid"};

	
	$getfaq = mysql_query("select * from questionlist where (questionid='$questionid')");
	$getfaqcount = mysql_num_rows($getfaq);
	if ($getfaqcount > 0) {
		$count = "1";
		while($getfaqrows = mysql_fetch_array($getfaq)){
			$answer = $getfaqrows["fullanswer"];
			if ($answer == "" || $answer == null || $answer == "null") {
				$answer = 'No Answer Added';
			}
			$youtubelink = $getfaqrows["youtubelink"];
			if ($youtubelink == "" || $youtubelink == null) {
				$youtubelink = 'https://flutter.github.io/assets-for-api-docs/assets/videos/butterfly.mp4';
			}
			$faqarray[] = ["questionid"=>$getfaqrows["questionid"],"question"=>$getfaqrows["questionfull"],"answer" => $answer,"videourl" =>$youtubelink,"additionaldetails"=>""];
			
		}
		$json_output = array("status" => "1","msg"=> "Record Found","data"=> $faqarray);
	}else{
		$json_output = array("status" => "0","msg" => "No Record Found!!");
	}

	
	header('Content-type: application/json');
	echo json_encode($json_output);
?>