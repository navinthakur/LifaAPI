<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);
	$loginid = $hugeArray{"loginid"};
	$searchval = $hugeArray{"searchval"};
	$and = '';
	if ($searchval != "" || $searchval != null) {
		$and .= ' where (VideoProfessorName like "%'.$searchval.'%") ';
	}

	$getbanner = mysql_query("select * from tblpostvideos ".$and." order by videoid desc");
	$getbannercount = mysql_num_rows($getbanner);
	if ($getbannercount > 0) {
		while($getbannerrows = mysql_fetch_array($getbanner)){
			$VideoProfessorName = $getbannerrows["VideoProfessorName"];
			if ($VideoProfessorName == "" || $VideoProfessorName == null) {
				$VideoProfessorName = '';
			}	
			$faqarray[] = ["postid"=>$getbannerrows["videoid"],"professorname"=>$VideoProfessorName,"subjectname"=>$getbannerrows["VideoTitle"],"posturl"=>"https://agentbhai.in/ServeSeva/UserPanel/images/user.png"];
		}
		$json_output = array("status" => "1","msg"=> "Record Found","data"=> $faqarray);
	}else{
		$json_output = array("status" => "0","msg"=> "No Video Found");
	}
	

	
	header('Content-type: application/json');
	echo json_encode($json_output);
?>