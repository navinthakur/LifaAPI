<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);
	$sectionid = $hugeArray{"sectionid"};

	$getunique = mysql_query("select * from lawsectionact where sectionid='$sectionid'");
	$getuniquerows = mysql_fetch_assoc($getunique);
	$actuniqueid = $getuniquerows["actuniqueid"];
	$acttitle = $getuniquerows["acttile"];
		
	$getfaq = mysql_query("select * from sectionactintro where (sectionrefid='$actuniqueid') order by CAST(sectionactno AS UNSIGNED) asc");
	$getfaqcount = mysql_num_rows($getfaq);
	if ($getfaqcount > 0) {
		$count = 1;
		while($getfaqrows = mysql_fetch_array($getfaq)){
			
			$faqarray[] = ["sectionsubid"=>$getfaqrows["sectionsubid"],"sectionactno"=>$getfaqrows["sectionactno"],"actintro" => $getfaqrows["sectionacttitle"]];
		}
		$json_output = array("status" => "1","msg"=> "Record Found","actexplanation"=>$acttitle,"data"=> $faqarray);
	}else{
		$json_output = array("status" => "0","msg" => "No Record Found!!");
	}

	
	header('Content-type: application/json');
	echo json_encode($json_output);
?>