<?php
// include database and object files
require_once('confi.php');
date_default_timezone_set("Asia/Kolkata");
$json = file_get_contents('php://input');
$hugeArray = json_decode($json,true);

$loginid = $hugeArray{"loginid"};
$typeofdocument = $hugeArray{"typeofdocument"};
$userimage = $hugeArray{"documentfile"};

$RandomAccountNumber  = mt_rand(11111, 99999);
define('UPLOAD_DIR', 'uploads/');
$indeximg = str_replace('data:image/png;base64,', '', $userimage);
$indeximg = str_replace(' ', '+', $indeximg);
$Indexdata = base64_decode($indeximg);
$Indexfile = UPLOAD_DIR . $loginid."". $RandomAccountNumber.'.png';
$IndexFolderfilePath = 'uploads/' . $loginid."".$RandomAccountNumber.'.png';
file_put_contents($Indexfile, $Indexdata);

$UpdateProfile = "INSERT INTO `colgdocupload`(`typeofdocument`, `documenturl`, `reflogid`) VALUES ('$typeofdocument','$IndexFolderfilePath','$loginid')";

$UpdateProfileCheck = mysql_query($UpdateProfile);

if($UpdateProfileCheck)
{
	$json_output = array("status" => "1", "msg" => "Document Uploaded Successfully");
}
else
{
	$json_output = array("status" => "0", "msg" => "Sorry Something Went Wrong!!!");
}
	
header('Content-type: application/json');
echo json_encode($json_output);
?>