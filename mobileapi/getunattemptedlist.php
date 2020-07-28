<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);

	$gettestseries = mysql_query("SELECT * FROM `tbltestseries` order by seriesid desc");
	$gettestseriescount = mysql_num_rows($gettestseries);
	if ($gettestseriescount > 0) {
		$count = 1;
		while($gettestseriesrows = mysql_fetch_array($gettestseries)){

			$faqarray[] = ["testpaperid"=>$gettestseriesrows["seriesid"],"testuniqueid"=>$gettestseriesrows["seriesuniqueid"],"testtitle"=>$gettestseriesrows["seriessectionheading"] ,"testtime"=>$gettestseriesrows["seriesexamtime"].' '. $gettestseriesrows["seriesexamtimeformat"],"testcounter"=>(string)$count++];	
		}
		$json_output = array("status"=>"1","msg"=>"Record Found","data"=>$faqarray);

	}else{
		$json_output = array("status"=>"0","msg"=>"No Record Found");		
	}

	
	header('Content-type: application/json');
	echo json_encode($json_output);
?>