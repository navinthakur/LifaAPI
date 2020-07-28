<?php
// include database and object files
require_once('confi.php');
date_default_timezone_set("Asia/Kolkata");
$json = file_get_contents('php://input');
$hugeArray = json_decode($json,true);


$loginid = $hugeArray{"loginid"};
$agentname = $hugeArray{"agentname"};
$mobilenumber = $hugeArray{"mobilenumber"};
$emailaddress = $hugeArray{"emailaddress"};
$alternateno = $hugeArray{"alternateno"};
$dob = $hugeArray{"dateofbirth"};
$address = $hugeArray{"address"};
$pincode = $hugeArray{"pincode"};
$location = $hugeArray{"location"};
$city = $hugeArray{"city"};
$state = $hugeArray{"state"};
$institutename = $hugeArray{"institutename"};
$licenceno = $hugeArray{"licenceno"};
$courttype = $hugeArray{"courttype"};
$courtlocation = $hugeArray{"courtlocation"};
$occupationcat = $hugeArray{"occupationcat"};
$courcename = $hugeArray{"courcename"};
$semname = $hugeArray{"semname"};
$malefemale = $hugeArray{"malefemale"};
$updatetype = $hugeArray{"updatetype"};
$collgestate = $hugeArray{"collgestate"};
$collegeunivecityname = $hugeArray{"collegeunivecityname"};
$courceyear = $hugeArray{"courceyear"};


if ($updatetype == "Both") {

	$userimage = $hugeArray{"userimage"};
	define('UPLOAD_DIR', 'uploads/');
	$indeximg = str_replace('data:image/png;base64,', '', $userimage);
	$indeximg = str_replace(' ', '+', $indeximg);
	$Indexdata = base64_decode($indeximg);
	$Indexfile = UPLOAD_DIR . $loginid."ProfilePic.png";
	$IndexFolderfilePath = 'uploads/' . $loginid."ProfilePic.png";
	file_put_contents($Indexfile, $Indexdata);

	$UpdateProfile = "UPDATE `logintbl` SET `personname`='$agentname',`emailaddress`='$emailaddress',`mobilenumber`='$mobilenumber',`alternatecontactno`='$alternateno',`userdob`='$dob',`useraddress`='$address',`userpincode`='$pincode',`userlocation`='$location',`usercity`='$city',`userstate`='$state',`profilepicpath`='$IndexFolderfilePath',`institutename`='$institutename',`licenceno`='$licenceno',`courttype`='$courttype',`courtlocation`='$courtlocation',`isprofiletoshow`='false',`usertype`='$occupationcat',`occupationcat`='$occupationcat',`courcename`='$courcename',`semname`='$semname',`malefemale`='$malefemale',`collgestate`='$collgestate',`collegeunivecityname`='$collegeunivecityname',`courceyear`='$courceyear' WHERE `logid`='$loginid'";

	$UpdateProfileCheck = mysql_query($UpdateProfile);
	
	if($UpdateProfileCheck)
	{
		$json_output = array("status" => "1", "msg" => "Profile Updated Successfully");
	}
	else
	{
		$json_output = array("status" => "0", "msg" => "Sorry Something Went Wrong!!!");
	}
	
}else{
	$UpdateProfile = "UPDATE `logintbl` SET `personname`='$agentname',`emailaddress`='$emailaddress',`mobilenumber`='$mobilenumber',`alternatecontactno`='$alternateno',`userdob`='$dob',`useraddress`='$address',`userpincode`='$pincode',`userlocation`='$location',`usercity`='$city',`userstate`='$state',`institutename`='$institutename',`licenceno`='$licenceno',`licenceno`='$licenceno',`courttype`='$courttype',`courtlocation`='$courtlocation',`isprofiletoshow`='false',`usertype`='$occupationcat',`occupationcat`='$occupationcat',`courcename`='$courcename',`semname`='$semname',`malefemale`='$malefemale',`collgestate`='$collgestate',`collegeunivecityname`='$collegeunivecityname',`courceyear`='$courceyear' WHERE `logid`='$loginid'";
	$UpdateProfileCheck = mysql_query($UpdateProfile);
	
	if($UpdateProfileCheck)
	{
		$json_output = array("status" => "1", "msg" => "Profile Updated Successfully");
	}
	else
	{
		$json_output = array("status" => "0", "msg" => "Sorry Something Went Wrong!!!!");
	}

}


error_log("Response :" . $json);
error_log("Query : " . $UpdateProfile);


	
header('Content-type: application/json');
echo json_encode($json_output);
?>