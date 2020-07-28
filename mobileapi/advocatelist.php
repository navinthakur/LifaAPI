<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);
	//$courtid = $hugeArray{"courtid"};


	$faqarray[] = ["advocateid"=>"1","name"=>"Navin Chand Thakur","contactno"=>"9833989222","course"=>"BA - LLB","coursetype"=>"CRIMINOLOGY","courtname" => "HIGH COURT","location"=>"Mumbai","image"=>"https://www.zica.org/images/icon-student.jpg"];
	$faqarray[] = ["advocateid"=>"2","name"=>"Navin Chand Thakur","contactno"=>"9833989222","course"=>"BA - LLB","coursetype"=>"CRIMINOLOGY","courtname" => "HIGH COURT","location"=>"Mumbai","image"=>"https://www.zica.org/images/icon-student.jpg"];
	$faqarray[] = ["advocateid"=>"3","name"=>"Navin Chand Thakur","contactno"=>"9833989222","course"=>"BA - LLB","coursetype"=>"CRIMINOLOGY","courtname" => "HIGH COURT","location"=>"Mumbai","image"=>"https://www.zica.org/images/icon-student.jpg"];
	

	



	$json_output = array("status" => "1","msg"=> "Record Found","data"=> $faqarray);
	
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