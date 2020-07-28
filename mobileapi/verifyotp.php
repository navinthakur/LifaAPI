<?php
// include database and object files
require_once('confi.php');

	header('Content-Type: application/json;charset=utf-8;');
	$data = json_decode(file_get_contents('php://input'), true);// Define $username and $password 

	$mobilenumber = $data["mobilenumber"];
	$otp = $data["otp"];

	$checkmob = "select * from otp where mobilenumber='".$mobilenumber."' and otpnumber='".$otp."' AND is_expired!=1 AND NOW() <= DATE_ADD(create_at, INTERVAL 24 HOUR)";
	$que = mysql_query($checkmob);
	$count  = mysql_num_rows($que);
	if(!empty($count)) {
		$result = mysql_query("UPDATE otp SET `is_expired` = '1' WHERE otpnumber = '" .$otp. "' and mobilenumber='".$mobilenumber."'");
		
		$json = array("status" => "1", "msg" => "Otp Matched");
			
	}
	else 
	{
		$json = array("status" => "2", "msg" => "OTP not Matched here ". $mobilenumber);
		
	}	

	
 @mysql_close($conn);
 
 /* Output header */
 header('Content-type: application/json');
 echo json_encode($json);
?>