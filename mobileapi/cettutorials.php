<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);
	//$questionid = $hugeArray{"questionid"};

	$gettestseries = mysql_query("SELECT * FROM `clatslider`");
    while($gettestseriesrows = mysql_fetch_array($gettestseries)){
    	$sliderarray[] = ["sliderid"=>$gettestseriesrows["clatsliderid"],"sliderimg"=>"http://35.194.40.144/agentbhai/law/mobileapi/".$gettestseriesrows["clatsliderurl"]];
    }
/*
	$faqarray[] = ["cetlistid" =>"1","cetlisttitle"=>"ABOUT","cetlisticon"=>"http://35.194.40.144/agentbhai/law/mobileapi/images/subcategory.jpg"];
	$faqarray[] = ["cetlistid" =>"2","cetlisttitle"=>"TEST SERIES","cetlisticon"=>"http://35.194.40.144/agentbhai/law/mobileapi/images/subcategory.jpg"];
	$faqarray[] = ["cetlistid" =>"3","cetlisttitle"=>"SYLLABUS","cetlisticon"=>"http://35.194.40.144/agentbhai/law/mobileapi/images/subcategory.jpg"];
	$faqarray[] = ["cetlistid" =>"4","cetlisttitle"=>"FIND COLLEGE","cetlisticon"=>"http://35.194.40.144/agentbhai/law/mobileapi/images/subcategory.jpg"];*/

	$getfaq = mysql_query("select * from subcategorylist where (categoryrefid='1')");
	
	$getfaqcount = mysql_num_rows($getfaq);
	if ($getfaqcount > 0) {
		while($getfaqrows = mysql_fetch_array($getfaq)){

			$faqarray[] = ["cetlistid"=>$getfaqrows["subcategoryllistid"],"cetlisttitle"=>$getfaqrows["subcategoryname"],"subcategoryimage"=> "http://35.194.40.144/agentbhai/law/mobileapi/".$getfaqrows["subcategoryimage"]];
		}
		$json_output = array("status" => "1","msg"=> "Record Found","data"=> $faqarray,"sliderdata"=>$sliderarray);
	}else{
		$json_output = array("status" => "0","msg" => "No Record Found!!");
	}
	
	header('Content-type: application/json');
	echo json_encode($json_output);
?>