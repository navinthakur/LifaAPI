<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);
	$testpaperid = $hugeArray{"testpaperid"};
	$testuniqueid =$hugeArray{"testuniqueid"};
	$pageno = $hugeArray{"pageno"};

	if ($pageno != "" || $pageno != null)
	{
		$pageno = $hugeArray{"pageno"};
	} 
	else 
	{
		$pageno = 1;
	}
	$no_of_records_per_page = 1;
	$offset = ($pageno-1) * $no_of_records_per_page;

	$total_pages_sql = "select count(*) from tblseriesquestion where serrefid='$testpaperid'";
	$result = mysql_query($total_pages_sql);
	$total_rows = mysql_fetch_array($result)[0];
	$total_pages = ceil($total_rows / $no_of_records_per_page);


	$getdetails = mysql_query("select * from tblseriesquestion where serrefid='$testpaperid' limit $offset, $no_of_records_per_page");
	$getdetailscount = mysql_num_rows($getdetails);
	if ($getdetailscount > 0) {
		
		$getdetailsrows = mysql_fetch_assoc($getdetails);
		$faqarray[] = ["optionid"=>"1","option"=>$getdetailsrows["serfirstoption"]];
		$faqarray[] = ["optionid"=>"2","option"=>$getdetailsrows["sersecondoption"]];
		$faqarray[] = ["optionid"=>"3","option"=>$getdetailsrows["serthirdoption"]];
		$faqarray[] = ["optionid"=>"4","option"=>$getdetailsrows["serforthoption"]];

	$json_output = array("status"=>"1","msg"=>"Record Found","questionid"=>$getdetailsrows["serquestionid"],"questioninhindi"=>$getdetailsrows["serquestionhindi"],"questioninenglish"=>$getdetailsrows["serquestion"],"questiontime"=>$getdetailsrows["serquestiontime"],"questiontimeformat"=>$getdetailsrows["serquestiontimeformat"],"options"=>$faqarray);		
	}else{
		$json_output = array("status"=>"0","msg"=>"No Record Found");
	}	
	
	header('Content-type: application/json');
	echo json_encode($json_output);
?>