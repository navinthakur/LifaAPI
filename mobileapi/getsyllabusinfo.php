<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);
	
	$syllabusindexid = $hugeArray{"syllabusindexid"};
	
	//$alphabettype = $hugeArray{"alphabettype"};


	$getfaq = mysql_query("select * from  tblsyllabussubindex where refsyllabusindexid='$syllabusindexid'");
	$getfaqcount = mysql_num_rows($getfaq);
	if ($getfaqcount > 0) {
		while($getfaqrows = mysql_fetch_array($getfaq)){
			$faqarray[] = ["syllabussubindexid"=>$getfaqrows["syllabussubindexid"],"actchapter"=>$getfaqrows["subactchapter"],"subheading"=>$getfaqrows["subheading"],"sectionchapterno"=>$getfaqrows["subchapterno"]];
		}
		$json_output = array("status" => "1","msg"=> "Record Found","data"=> $faqarray);
	}else{
		$json_output = array("status" => "0","msg" => "No Record Found!!");
	}
	
	header('Content-type: application/json');
	echo json_encode($json_output);
?>