<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);
	//$courtid = $hugeArray{"courtid"};
	$advocateid = $hugeArray{"advocateid"};

	$faqarray[] = ["advocateid"=>$advocateid,"name"=>"Navin Chand Thakur","contactno"=>"9833989222","landlineno"=>"022 1111 1111","emailid"=>"info@advocatelaw.com","website"=>"NA","address"=>"306 B wing lodha supremus, near new passport office, Thane West 400604","affiliatewith"=>"Mumbai High Court","aboutadvocate"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat","image"=>"https://www.zica.org/images/icon-student.jpg"];
	
	

	



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