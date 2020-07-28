<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);
	$collegeid = $hugeArray{"collegeid"};

	$getfaq = mysql_query("select * from collegedetails where collegeid='$collegeid'");
	$getfaqcount = mysql_num_rows($getfaq);
	if ($getfaqcount > 0) {
		while($getfaqrows = mysql_fetch_array($getfaq)){

			$faqarray[] = ["collegeid"=>$getfaqrows["collegeid"],"collegename"=>$getfaqrows["collegename"],
			"affilatename"=>$getfaqrows["universityname"],"collegestate"=> $getfaqrows["collegestaterefname"],
			"collegelocation"=>"NA","collegecontactno"=>"9999999999","collegeemail"=>"contact@collegedomain.com","collegeaddress"=>$getfaqrows["collegeaddress"],"landlineno"=>"NA","website"=>"NA",
			"collegeimage"=>"https://images.static-collegedunia.com/public/college_data/images/appImage/8871_m1.png"];
			
		}
			$json_output = array("status" => "1","msg"=> "Record Found","data"=> $faqarray);
	}else{
		$json_output = array("status" => "0","msg" => "No Record Found!!");
	}

	
	
	
	header('Content-type: application/json');
	echo json_encode($json_output);
?>