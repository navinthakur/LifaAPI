<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);

	
	$faqarray[] = ["jobid"=>"1","title"=>"Law Officer - Real Estate Division Opportunity Yours","location"=>"Mumbai, Maharashtra","from"=>"limejob.com","postedfrom"=>"26 days ago","jobtype"=>"Full-Time","companyicon"=>"http://35.194.40.144/agentbhai/law/mobileapi/images/subcategory.jpg"];
	
	


	$json_output = array("status" => "1","msg"=> "Record Found","data"=> $faqarray);


	/*$getfaq = mysql_query("select * from tblcasestudies");
	$getfaqcount = mysql_num_rows($getfaq);
	if ($getfaqcount > 0) {
		$count = "1";
		while($getfaqrows = mysql_fetch_array($getfaq)){

			$faqarray[] = ["casestudyid"=>$getfaqrows["casestudyid"],"courtname"=>$getfaqrows["courtname"].' - '. $getfaqrows["courtlocation"],"clientname" => $getfaqrows["clientname"],"casestudyno"=>$getfaqrows["casestudyno"],"status"=> $getfaqrows["status"],"casestudydate"=>$getfaqrows["casestudydate"],"casestudymonth" =>$getfaqrows["casestudymonth"],"casestudyday"=>$getfaqrows["casestudyday"],"citationno"=>"4601 of 1997 (Civil) Appeal","benchname"=>"Ramaswami, Sagir, Ahmad, B.Patil"];
		}
		$json_output = array("status" => "1","msg"=> "Record Found","data"=> $faqarray);
	}else{
		$json_output = array("status" => "0","msg" => "No Record Found!!");
	}
*/
	
	header('Content-type: application/json');
	echo json_encode($json_output);
?>