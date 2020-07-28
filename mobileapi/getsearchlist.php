<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);
	$loginid = $hugeArray{"loginid"};
	$searchinput = $hugeArray{"searchinput"};


	$query = 'select * from logintbl';
	$where = ' where';
	$and = ' (usertype !="admin") and (logid != "'.$loginid.'")';
	$or = '';
	$limit = 'limit 1';
	if ($searchinput != "" || $searchinput != null) {
		$and .= ' and ( personname like "'.$searchinput.'%") ';
	}

	$getfaq = mysql_query($query.''.$where.''.$and);
	$getfaqcount = mysql_num_rows($getfaq);
	if ($getfaqcount > 0) {
		while($getfaqrows = mysql_fetch_array($getfaq)){
			$courttype = $getfaqrows["courttype"];
			if ($courttype =="" || $courttype == null) {
				$courttype = 'NA';
			}
			$usercity = $getfaqrows["usercity"];
			if ($usercity == "" || $usercity == null) {
				$usercity = 'NA';
			}
			$profilepicpath = $getfaqrows["profilepicpath"];
			if ($profilepicpath == "" || $profilepicpath == null) {
				$profilepicpath = 'https://agentbhai.in/ServeSeva/UserPanel/images/user.png';
			}else{
				$profilepicpath = 'http://35.194.40.144/agentbhai/law/mobileapi/'.$getfaqrows["profilepicpath"];
			}


			$faqarray[] = ["staffid"=>$getfaqrows["logid"],"name"=>$getfaqrows["personname"],"type"=>$getfaqrows["courcename"],"course"=>$getfaqrows["semname"],"courttype"=>$courttype,"location"=>$usercity,"imageurl"=>$profilepicpath];
		}
		$json_output = array("status" => "1","msg"=> "Record Found","data"=> $faqarray);
	}else{
		$json_output = array("status" => "0","msg" => "No Record Found!!");
	}
	
	
	
	header('Content-type: application/json');
	echo json_encode($json_output);
?>