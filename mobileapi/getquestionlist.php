<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);
	$refcourseid =$hugeArray{"refcourseid"};
	$refsemesterid =$hugeArray{"refsemesterid"};
	$refsubjectid = $hugeArray{"refsubjectid"};
	$refpatternid = $hugeArray{"refpatternid"};
	$yearfilter = $hugeArray{"yearfilter"};

	$query = 'select * from questionlist';
	$where = ' Where';
	$and = ' (refcourseid="'.$refcourseid.'") and (refsemesterid = "'.$refsemesterid.'") and (refsubjectid="'.$refsubjectid.'") and (refpatternid="'.$refpatternid.'")';

	if($yearfilter != "" && $yearfilter != null && $yearfilter != "All"){
		 $and .= ' and (questionyear="'.$yearfilter.'")';	
	}
	
	/*$getfaq = mysql_query("select * from questionlist where (refcourseid='$refcourseid') and (refsemesterid='$refsemesterid') and (refsubjectid='$refsubjectid') and (refpatternid='$refpatternid')");*/
	$getfaq = mysql_query($query.''.$where.''.$and);
	$getfaqcount = mysql_num_rows($getfaq);
	if ($getfaqcount > 0) {
		$count = "1";
		while($getfaqrows = mysql_fetch_array($getfaq)){
			$faqarray[] = ["questionid"=>$getfaqrows["questionid"],"question"=>$getfaqrows["questionfull"]];
			
		}
		$json_output = array("status" => "1","msg"=> "Record Found","data"=> $faqarray);
	}else{
		$json_output = array("status" => "0","msg" => "No Record Found!!");
	}

	
	header('Content-type: application/json');
	echo json_encode($json_output);
?>