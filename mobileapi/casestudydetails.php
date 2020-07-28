<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);
	$casestudyid = $hugeArray{"casestudyid"};

	$getfaq = mysql_query("select * from tblcasestudies where casestudyid='$casestudyid'");
	$getfaqrows = mysql_fetch_assoc($getfaq);

	$bencharray[] = ["benchid"=>$casestudyid,"benchcount"=>"1","benchname"=>$getfaqrows["benchcontent"]];

	$faceofcasearray[] = ["factd"=>"1","facttitle"=>"This is fact 1"];
	$faceofcasearray[] = ["factd"=>"2","facttitle"=>"This is fact 2"];
	$faceofcasearray[] = ["factd"=>"3","facttitle"=>"This is fact 3"];

	$issuesarray[] = ["issueid"=>"1","issuetitle"=>"This is issue 1"];
	$issuesarray[] = ["issueid"=>"2","issuetitle"=>"This is issue 2"];
	$issuesarray[] = ["issueid"=>"3","issuetitle"=>"This is issue 3"];

	$faqarray[] =  ["courtname"=>$getfaqrows["casestudycourtname"],"clientname" =>$getfaqrows["clientname"],"citationno"=>$getfaqrows["citationcontent"]];

	$json_output = array("status" => "1","msg"=> "Record Found","introduction"=>$getfaqrows["judgmentcontent"],"videourl"=>"https://flutter.github.io/assets-for-api-docs/assets/videos/butterfly.mp4","data"=> $faqarray,"bencharray"=>$bencharray,"faceofcasearray"=>$faceofcasearray,"issuesarray"=>$issuesarray);
	

	/*$getfaq = mysql_query("select * from tblcasestudies");
	$getfaqcount = mysql_num_rows($getfaq);
	if ($getfaqcount > 0) {
		$count = "1";
		while($getfaqrows = mysql_fetch_array($getfaq)){

			$faqarray[] = ["casestudyid"=>$getfaqrows["casestudyid"],"courtname"=>$getfaqrows["courtname"].' - '. $getfaqrows["courtlocation"],"clientname" => $getfaqrows["clientname"],"casestudyno"=>$getfaqrows["casestudyno"],"status"=> $getfaqrows["status"],"casestudydate"=>$getfaqrows["casestudydate"],"casestudymonth" =>$getfaqrows["casestudymonth"],"casestudyday"=>$getfaqrows["casestudyday"],"citationno"=>"4601 of 1997 (Civil) Appeal","benchname"=>"Ramaswami, Sagir, Ahmad, B.Patil"];
		}
		$json_output = array("status" => "1","msg"=> "Record Found","introduction"=>"This case related to the granting of mining license of the schedule","data"=> $faqarray);
	}else{
		$json_output = array("status" => "0","msg" => "No Record Found!!");
	}*/

	
	header('Content-type: application/json');
	echo json_encode($json_output);
?>