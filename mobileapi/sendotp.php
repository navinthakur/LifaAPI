<?php
include_once('confi.php');
header('Content-Type: application/json;charset=utf-8;');
$data = json_decode(file_get_contents('php://input'), true);
date_default_timezone_set("Asia/Kolkata");
$phone = $data["mobilenumber"];
$otpnumber = mt_rand(1000, 9999);
$message = "Your One Time Password is ".$otpnumber."";
$response = "Y"; 
$date = date("d-m-Y");
$time = date("h:i:s");
$CheckNo = mysql_query("select * from logintbl where mobilenumber='$phone'");
$CheckNoCount = mysql_num_rows($CheckNo);
if ($CheckNoCount > 0) {
	$otpquery = "INSERT INTO `otp`(`mobilenumber`, `otpnumber`, `otpsentdate`, `otpsendtime`,`is_expired`,`create_at`) VALUES ('$phone','$otpnumber','$date','$time','0','" . date("Y-m-d H:i:s"). "')"; 
	mysql_query($otpquery);

	$username = "agentbhai";
	$pass = '$a6W3A@g';
	$dest_mobileno = $phone;
	$senderid = "AGNTBH";
	$route = "Y";
	$postData = array(
		'username' => $username,
		'pass'=> $pass,
		'dest_mobileno' => $dest_mobileno,
		'message' => $message,
		'senderid' => $senderid,
		'response' => $route
	);
	$url="http://www.smsjust.com/blank/sms/user/urlsms.php?";
	$ch = curl_init();
	curl_setopt_array($ch, array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_POST => true,
		CURLOPT_POSTFIELDS => $postData
	));
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	 //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

	$output = curl_exec($ch);
	if(curl_errno($ch))
	{
		echo 'error:' . curl_error($ch);
	}
	curl_close($ch);

	$json = array("status" => "1", "msg" => "One Time Password Sent Successfully","output"=> $output);

}else{
	$json = array("status" => "0", "msg" => "No User found");
}
 /* Output header */
 header('Content-type: application/json');
 echo json_encode($json);
 error_log("Request" . $data["mobilenumber"]);

?>