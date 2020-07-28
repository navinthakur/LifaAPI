<?php
include("confi.php");
include("encrypte.php");

$data = file_get_contents('php://input');// Define $username and $password 
$hugeArray = json_decode($data,true);

$usrloginid = $hugeArray{"loginid"};

$getchatlist = mysql_query("select * from messages where (receiverid='$usrloginid') and (msgserverstatus='Unsent') order by id asc");

$getchatlistcount = mysql_num_rows($getchatlist);
if ($getchatlistcount > 0) {
	while($getchatlistrows = mysql_fetch_array($getchatlist)){
		$senderid = $getchatlistrows["senderid"];
		$getmemberdetails = mysql_query("select logid,personname,profilepicpath from logintbl where logid = '$senderid'");
		$getmemberdetailsrows = mysql_fetch_assoc($getmemberdetails);
		$membername = $getmemberdetailsrows["personname"];
		$memberprofilepic = $getmemberdetailsrows["profilepicpath"];
		if ($memberprofilepic  == "" && $memberprofilepic == null) {
			$memberprofilepic = "https://agentbhai.in/ServeSeva/UserPanel/images/user.png";
		}else{
			$memberprofilepic = "http://35.208.120.139/agentbhai/law/mobileapi/".$getmemberdetailsrows["memberprofilepic"];
		}


		$msgarray[] = ["personname"=>$membername,"userimg"=>$memberprofilepic,"senderid"=> $senderid,"userlastmsg"=>$getchatlistrows["messages"],"msgcount"=>"1"];

	}

	$json_output = array("status"=>"1","msg"=>"Chat Found","data"=>$msgarray);
	//mysql_query("UPDATE messages SET msgserverstatus='Sent' where receiverid='$usrloginid'");
	
}else{
	$json_output = array("status"=>"0","msg"=>"No Chat Found");
}


echo json_encode($json_output);

/*$json_outputFinal = Encrypt(json_encode($json_output));
echo $json_outputFinal;*/
?>