<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);
	$testpaperid = $hugeArray{"testpaperid"};

	$gettestseries = mysql_query("SELECT * FROM `tbltestseries` where seriesid='$testpaperid'");

	$gettestseriescount = mysql_num_rows($gettestseries);
	if ($gettestseriescount > 0) {
		while($gettestseriesrows = mysql_fetch_array($gettestseries)){
			
			$seriesid = $gettestseriesrows["seriesid"];
			$getquestioncount = mysql_query("select count(*) as quecount from tblseriesquestion where serrefid='$seriesid'");
			$getquestioncountrows = mysql_fetch_assoc($getquestioncount);

			$faqarray[] = ["testpaperid"=>$gettestseriesrows["seriesid"],"testuniqueid"=>$gettestseriesrows["seriesuniqueid"],"subject"=>$gettestseriesrows["seriessectionheading"],"section"=>$gettestseriesrows["seriessection"],"testtime"=>$gettestseriesrows["seriesexamtime"],"testtimeformat"=>$gettestseriesrows["seriesexamtimeformat"],"totalquestions"=>$getquestioncountrows["quecount"],"astarmarks"=>$gettestseriesrows["seriesastarmarks"],"instrcutions"=>$gettestseriesrows["seriesinstructions"]];

		}
		$json_output = array("status"=>"1","msg"=>"Record Found","data"=>$faqarray);
	}
	else{
		$json_output = array("status"=>"0","msg"=>"No Record Found");		
	}
	
	header('Content-type: application/json');
	echo json_encode($json_output);
?>