<?php
// include database and object files
require_once('confi.php');
date_default_timezone_set("Asia/Kolkata");
$json = file_get_contents('php://input');
$hugeArray = json_decode($json,true);

$loginid = $hugeArray{"loginid"};

$getProfile = mysql_query("select * from logintbl where logid='$loginid'");
$getProfileCount = mysql_num_rows($getProfile);
if ($getProfileCount > 0) {
	
	$getProfileRows = mysql_fetch_assoc($getProfile);
	$personname = $getProfileRows["personname"];
	if ($personname == "" || $personname == null) {
		$personname = '';
	}

	$mobilenumber = $getProfileRows["mobilenumber"];
	if ($mobilenumber == "" || $mobilenumber == null) {
		$mobilenumber = '';
	}

	$alternatecontactno = $getProfileRows["alternatecontactno"];
	if ($alternatecontactno == "" || $alternatecontactno == null) {
		$alternatecontactno = '';
	}
	$emailaddress = $getProfileRows["emailaddress"];
	if ($emailaddress == "" || $emailaddress == null) {
		$emailaddress = '';
	}

	$userdob = $getProfileRows["userdob"];
	if ($userdob == "" || $userdob == null) {
		$userdob = '';
	}

	$useraddress = $getProfileRows["useraddress"];
	if ($useraddress == "" || $useraddress == null) {
		$useraddress = '';
	}

	$userpincode = $getProfileRows["userpincode"];
	if ($userpincode == "" || $userpincode == null) {
		$userpincode = '';
	}

	$userlocation = $getProfileRows["userlocation"];
	if ($userlocation == "" || $userlocation == null) {
		$userlocation = '';
	}

	$usercity =$getProfileRows["usercity"];
	if ($usercity == "" || $usercity == null) {
		$usercity = '';
	}

	$userstate = $getProfileRows["userstate"];
	if ($userstate == "" || $userstate == null) {
		$userstate = '';
	}
	$isprofiletoshow  = $getProfileRows["isprofiletoshow"];
	if ($isprofiletoshow == "" || $isprofiletoshow == null) {
		$isprofiletoshow = 'true';
	}

	$profilepicpath = $getProfileRows["profilepicpath"];
	if ($profilepicpath == "" || $profilepicpath == null) {
		$profilepicpath = 'https://agentbhai.in/ServeSeva/UserPanel/images/user.png';
	}else{
		$profilepicpath = 'http://35.194.40.144/agentbhai/law/mobileapi/'.$getProfileRows["profilepicpath"];
	}

	$institutename =$getProfileRows["institutename"];
	if ($institutename == "" || $institutename == null || $institutename == "null") {
		$institutename = '';
	}
	$licenceno = $getProfileRows["licenceno"];
	if ($licenceno == "" || $licenceno == null) {
		$licenceno = '';
	}
	$occupationcat = $getProfileRows["occupationcat"];
	if ($occupationcat == "" || $occupationcat == null) {
		$occupationcat = '';
	}

	$courcename = $getProfileRows["courcename"];
	if ($courcename == "" || $courcename == null) {
		$courcename = '';
	}

	$semname = $getProfileRows["semname"];
	if ($semname == "" || $semname == null) {
		$semname = '';
	}
	$malefemale = $getProfileRows["malefemale"];
	if ($malefemale == "" || $malefemale == null) {
		$malefemale = '';
	}

	$collgestate = $getProfileRows["collgestate"];
	if ($collgestate == "" || $collgestate == null) {
		$collgestate = '';
	}

	$collegeunivecityname = $getProfileRows["collegeunivecityname"];
	if ($collegeunivecityname == "" || $collegeunivecityname == null) {
		$collegeunivecityname = '';
	}

	$courttype = $getProfileRows["courttype"];
	if ($courttype == "" || $courttype == null) {
		$courttype = '';
	}
	$courtlocation = $getProfileRows["courtlocation"];
	if ($courtlocation == "" || $courtlocation == null)  {
		$courtlocation = '';
	}
	$courceyear = $getProfileRows["courceyear"];
	if ($courceyear == "" || $courceyear == null) {
		$courceyear = '';
	}

	// Step left details

	if ($profilepicpath == "" || $profilepicpath == null) {
		$stepleft = '5 Step Left';
	}
	else if ($personname == "" || $personname == null) {
		$stepleft = '4 Step left';
	}
	else if ($mobilenumber =="" || $mobilenumber == null) {
		$stepleft = "4 Steps Left";
	}
	else if ($emailaddress == "" || $emailaddress == null) {
		$stepleft = '4 Steps Left';
	}
	else if ($malefemale == "" || $malefemale == null) {
		$stepleft = '4 Steps Left';
	}
	else if ($userdob == "" || $userdob == null) {
		$stepleft = '4 Steps Left';
	}
	else if ($occupationcat == ""  || $occupationcat == null){
		$stepleft = '3 Steps Left';
	}
	else if ($collgestate == ""  || $collgestate == null) {
		$stepleft = '3 Steps Left';
	}
	else if ($collegeunivecityname == "" || $collegeunivecityname == null) {
		$stepleft = '3 Steps Left';
	}
	else if ($institutename == "" || $institutename == null) {
		$stepleft = '3 Steps Left';
	}
	else if ( $courcename == "" || $courcename == null){
		$stepleft = '2 Steps Left';
	}
	else if ($courceyear == "" || $courceyear == null) {
		$stepleft = '2 Steps left';
	}
	else if ($semname == "" || $semname == null) {
		$stepleft = '2 Steps left';
	}
	else if ($useraddress == "" || $useraddress == null) {
		$stepleft = '1 Step Left';
	}
	else if ($userpincode == "" || $userpincode == null) {
		$stepleft = '1 Step Left';
	}
	else if ($userlocation == "" || $userlocation == null) {
		$stepleft = '1 Step Left';
	}
	else if ($usercity == "" || $usercity == null) {
		$stepleft = '1 Step Left';
	}
	else if ($userstate == "" || $userstate == null) {
		$stepleft = '1 Step Left';
	}else{
		$stepleft = 'Hurrah!! Profile Updated';
	}

	$json = array("status" => "1", "msg" => "Record Found!!","aboutmsg" => "Hey there! i am using LIFA App","fullname" => $personname,"mobilenumber" => $mobilenumber,"profilepicpath" => $profilepicpath,"institutename"=>$institutename,"courcename" => $courcename,"semname" => $semname,"malefemale" => $malefemale,"collgestate"=>$collgestate,"collegeunivecityname"=>$collegeunivecityname,"courceyear"=> $courceyear);


}else{
	$json = array("status" => "0", "msg" => "No Record Found!!");
}
 	
	
 header('Content-type: application/json');
 echo json_encode($json);
?>