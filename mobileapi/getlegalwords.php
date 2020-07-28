<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);
	$pageno = $hugeArray{"pageno"};
	if ($pageno != "" || $pageno != null)
	{
		$pageno = $hugeArray{"pageno"};
	} 
	else 
	{
		$pageno = 1;
	}
	$no_of_records_per_page = 15;
	$offset = ($pageno-1) * $no_of_records_per_page;

	$total_pages_sql = "select count(*) from tbllegalwords";
	$result = mysql_query($total_pages_sql);
	$total_rows = mysql_fetch_array($result)[0];
	$total_pages = ceil($total_rows / $no_of_records_per_page);


	//$alphabettype = $hugeArray{"alphabettype"};


	$getfaq = mysql_query("select * from tbllegalwords limit $offset, $no_of_records_per_page");
	$getfaqcount = mysql_num_rows($getfaq);
	if ($getfaqcount > 0) {
		while($getfaqrows = mysql_fetch_array($getfaq)){
			$faqarray[] = ["legalwordid"=>$getfaqrows["legalwordid"],"alphabettype"=>$getfaqrows["alphabettype"],"wordtitle"=>$getfaqrows["wordtitle"],"worddescription"=> $getfaqrows["worddescription"]];
		}
		$json_output = array("status" => "1","msg"=> "Record Found","data"=> $faqarray);
	}else{
		$json_output = array("status" => "0","msg" => "No Record Found!!");
	}
	
	header('Content-type: application/json');
	echo json_encode($json_output);
?>