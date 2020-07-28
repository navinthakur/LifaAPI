<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);
	$sectionid = $hugeArray{"sectionid"};

	$getunique = mysql_query("select * from crpclawsectionact where crpcsectionid='$sectionid'");
	$getuniquerows = mysql_fetch_assoc($getunique);
	$actuniqueid = $getuniquerows["crpcactuniqueid"];
	$acttitle = $getuniquerows["crpcacttile"];
		
	$getfaq = mysql_query("select * from crpcsectionactintro where (crpcsectionrefid='$actuniqueid') order by CAST(crpcsectionactno AS UNSIGNED) asc");
	$getfaqcount = mysql_num_rows($getfaq);
	if ($getfaqcount > 0) {
		$count = 1;
		while($getfaqrows = mysql_fetch_array($getfaq)){
			
			$faqarray[] = ["sectionsubid"=>$getfaqrows["crpcsectionsubid"],"sectionactno"=>$getfaqrows["crpcsectionactno"],"actintro" => $getfaqrows["crpcsectionacttitle"]];
		}
		$json_output = array("status" => "1","msg"=> "Record Found","actexplanation"=>$acttitle,"data"=> $faqarray);
	}else{
		$json_output = array("status" => "0","msg" => "No Record Found!!");
	}

	
	header('Content-type: application/json');
	echo json_encode($json_output);
?>