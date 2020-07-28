<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);
	$isstateselected = $hugeArray{"isstateselected"};
	$statename = $hugeArray{"statename"};

	if ($isstateselected == "true") {
		$getfaq = mysql_query("select * from collegedetails where (collegestaterefname='$statename')");
		$getfaqcount = mysql_num_rows($getfaq);
		if ($getfaqcount > 0) {
			$count = "1";
			while($getfaqrows = mysql_fetch_array($getfaq)){

				$faqarray[] = ["collegeid"=>$getfaqrows["collegeid"],"universityname"=>$getfaqrows["universityname"],"collegestate"=> $getfaqrows["collegestaterefname"]];
				
			}
				$json_output = array("status" => "1","msg"=> "Record Found","data"=> $faqarray);
		}else{
			$json_output = array("status" => "0","msg" => "No Record Found!!");
		}

	}
	else{
		$getfaq = mysql_query("select * from collegedetails");
		$getfaqcount = mysql_num_rows($getfaq);
		if ($getfaqcount > 0) {
			$count = "1";
			while($getfaqrows = mysql_fetch_array($getfaq)){

				$faqarray[] = ["collegeid"=>$getfaqrows["collegeid"],"collegename"=>$getfaqrows["collegename"],"universityname"=>$getfaqrows["universityname"]];
				
			}
				$json_output = array("status" => "1","msg"=> "Record Found","data"=> $faqarray);
		}else{
			$json_output = array("status" => "0","msg" => "No Record Found!!");
		}

	}
	
	header('Content-type: application/json');
	echo json_encode($json_output);
?>