<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);
	

	$getfaq = mysql_query("select * from tblcasestudies limit 30");
	$getfaqcount = mysql_num_rows($getfaq);
	if ($getfaqcount > 0) {
		while($getfaqrows = mysql_fetch_array($getfaq)){

			$faqarray[] = ["casestudyid"=>$getfaqrows["casestudyid"],"courtname"=>$getfaqrows["casestudycourtname"],"clientname" => $getfaqrows["clientname"],"casestudyno"=>"","status"=> "","casestudydate"=>$getfaqrows["petitiondate"],"casestudymonth" =>"","casestudyday"=>"","citationno"=>$getfaqrows["petitiondetails"],"benchname"=>$getfaqrows["benchcontent"]];
		}
		$json_output = array("status" => "1","msg"=> "Record Found","data"=> $faqarray);
	}else{
		$json_output = array("status" => "0","msg" => "No Record Found!!");
	}

	
	header('Content-type: application/json');
	echo json_encode($json_output);
?>