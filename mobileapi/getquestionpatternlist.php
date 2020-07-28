<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);
	$subjectid =$hugeArray{"subjectid"};


	$getfaq = mysql_query("select * from tblquestionpatten where (questionpatternsubjectrefid='$subjectid')");
	$getfaqcount = mysql_num_rows($getfaq);
	if ($getfaqcount > 0) {
		$count = "1";
		while($getfaqrows = mysql_fetch_array($getfaq)){
			$faqarray[] = ["qpid"=>$getfaqrows["qpid"],"patterntitle"=>$getfaqrows["patterntitle"],"questionpatternmarks"=> $getfaqrows["questionpatternmarks"]];
			
		}

		$getyear = mysql_query("select distinct(questionyear) as questionyear from questionlist");
		while($getyearrows = mysql_fetch_array($getyear)){
			$questionyear = $getyearrows["questionyear"];
			if ($questionyear != "" || $questionyear != null) {
				$yeararray[] = ["year"=> $getyearrows["questionyear"]];
			}
			
		}

		$json_output = array("status" => "1","msg"=> "Record Found","data"=> $faqarray,"year"=>$yeararray);
	}else{
		$json_output = array("status" => "0","msg" => "No Record Found!!");
	}

	
	header('Content-type: application/json');
	echo json_encode($json_output);
?>