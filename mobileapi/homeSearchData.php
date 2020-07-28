<?php
include("confi.php");
include("encrypte.php");
$data = file_get_contents('php://input');// Define $username and $password 
$hugeArray = json_decode($data,true);
$loginid = $hugeArray{"loginid"};
$searchinput = $hugeArray{"searchinput"};
$query = 'select * from logintbl';
	$where = ' Where';
	$and = ' (usertype!="admin" and logid != "'.$loginid.'") ';

	if($searchinput != "" && $searchinput != null && $searchinput != "null"){
		 $and .= ' and (personname like "%'.$searchinput.'%")';	
	}
$CategoryQuery = mysql_query($query.''.$where.''.$and.''.$orderby);
$totalrecords = mysql_num_rows($CategoryQuery);
if($totalrecords > 0)
{
	while($CategoryRow = mysql_fetch_array($CategoryQuery))
	{
		
		$personname = $CategoryRow["personname"];
		if ($personname == "" || $personname == null) {
			$personname = '';
		}
		$occupationcat = $CategoryRow["occupationcat"];
		if ($occupationcat == "") {
			$occupationcat ='';
		}
		$usercity = $CategoryRow["usercity"] ;
		if ($usercity == "" || $usercity == null) {
			$usercity = '';
		}

		$userstate = $CategoryRow["userstate"] ;
		if ($userstate == "" || $userstate == null) {
			$userstate = '';
		}
		$institutename = $CategoryRow["institutename"];
		if ($institutename == "" || $institutename == null) {
			$institutename = '';
		}
		$memberprofilepic =$CategoryRow["profilepicpath"];
		if ($memberprofilepic  == "" && $memberprofilepic == null) {
			$memberprofilepic = "https://agentbhai.in/ServeSeva/UserPanel/images/user.png";
		}else{
			$memberprofilepic = "http://35.208.120.139/agentbhai/law/mobileapi/".$CategoryRow["profilepicpath"];
		}

		$jsonData[] = ["loginid"=> $CategoryRow["logid"],"name" => ucwords($personname),"memberoccupation"=>$occupationcat,"memberage"=>"","address"=> $usercity ." ". $userstate,"institutename"=>$institutename,"memberprofilepic" => $memberprofilepic];
	}
	$json = array("status" => "1","msg" => "Record Found","data"=>$jsonData);
}
else 
{
	$json = array("status" => "0","msg" => "No Records Found!!");		
}
/*$json_output = Encrypt(json_encode($json));
echo $json_output;*/

echo json_encode($json);
?>