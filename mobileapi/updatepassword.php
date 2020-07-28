<?php
// include database and object files
require_once('confi.php');
date_default_timezone_set("Asia/Kolkata");
$json = file_get_contents('php://input');
$hugeArray = json_decode($json,true);
$loginid = $hugeArray{"loginid"};
$password = $hugeArray{"password"};

$UpdateProfile = "UPDATE `logintbl` SET userpassword='$password' WHERE `logid`='$loginid'";
$UpdateProfileCheck = mysql_query($UpdateProfile);

if($UpdateProfileCheck)
{
	$json_output = array("status" => "1", "msg" => "Password Updated Successfully");
}
else
{
	$json_output = array("status" => "0", "msg" => "Sorry Something Went Wrong!!!!");
}



error_log("Response :" . $json);
error_log("Query : " . $UpdateProfile);


	
header('Content-type: application/json');
echo json_encode($json_output);
?>