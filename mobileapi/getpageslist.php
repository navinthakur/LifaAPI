<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);
	$subcategoryllistid = $hugeArray{"subcategoryllistid"};
	$getfaq = mysql_query("select * from subcategorylist where (subcategoryllistid='$subcategoryllistid')");
	
	$getfaqcount = mysql_num_rows($getfaq);
	if ($getfaqcount > 0) {
		while($getfaqrows = mysql_fetch_array($getfaq)){

			$subcategorytablename = $getfaqrows["subcategorytablename"];
			$getdetails = mysql_query("select * from $subcategorytablename");
			$getdetailsrows = mysql_fetch_assoc($getdetails);

			$faqarray[] = ["subcategoryllistid"=>$getfaqrows["subcategoryllistid"],"content"=>$getdetailsrows["content"]];
		}
		$json_output = array("status" => "1","msg"=> "Record Found","data"=> $faqarray);
	}else{
		$json_output = array("status" => "0","msg" => "No Record Found!!");
	}

	
	header('Content-type: application/json');
	echo json_encode($json_output);
?>