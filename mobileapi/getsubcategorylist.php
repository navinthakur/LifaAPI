<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);
	$logid = $hugeArray{"logid"};
	$categoryid = $hugeArray{"categoryid"};
	$categorytype = $hugeArray{"categorytype"};

	$gettestseries = mysql_query("SELECT * FROM `collegeslider`");
    while($gettestseriesrows = mysql_fetch_array($gettestseries)){
    	$sliderarray[] = ["sliderid"=>$gettestseriesrows["collegesliderid"],"sliderimg"=>"http://35.208.120.139/agentbhai/law/mobileapi/".$gettestseriesrows["collegesliderurl"]];
    }

	



	$getfaq = mysql_query("select * from subcategorylist where (categoryrefid='$categoryid') and (subcategorytype='$categorytype')");
	
	$getfaqcount = mysql_num_rows($getfaq);
	if ($getfaqcount > 0) {
		while($getfaqrows = mysql_fetch_array($getfaq)){
			$faqarray[] = ["subcategoryllistid"=>$getfaqrows["subcategoryllistid"],"subcategoryname"=>$getfaqrows["subcategoryname"],"subcategoryimage"=> "http://35.208.120.139/agentbhai/law/mobileapi/".$getfaqrows["subcategoryimage"],"subcategorytype" => $getfaqrows["subcategorytype"]];
		}
		$json_output = array("status" => "1","msg"=> "Record Found","data"=> $faqarray,"sliderdata"=>$sliderarray);
	}else{
		$json_output = array("status" => "0","msg" => "No Record Found!!");
	}

	
	header('Content-type: application/json');
	echo json_encode($json_output);
?>