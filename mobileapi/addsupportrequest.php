<?php
include("confi.php");
$json = file_get_contents('php://input');
$hugeArray = json_decode($json,true);
date_default_timezone_set("Asia/Kolkata");

$loginid = $hugeArray{"loginid"};
$supporttype  = $hugeArray{"supporttype"};
$supportsubject =$hugeArray{"supportsubject"};
$supportmessage =$hugeArray{"supportmessage"};
$supportadded = date("d-m-Y H:i:s");

$SuportQuery = mysql_query("INSERT INTO `managesupport`(`supporttype`, `supportsubject`, `supportmessage`, `supportlogid`, `supportadded`) VALUES ('$supporttype','$supportsubject','$supportmessage','$loginid','$supportadded')");
if ($SuportQuery) {
	$json = array("status" => "1","msg" =>"Ticket Created Successfully");
}else{
	$json = array("status" => "0","msg" =>"Sorry something went wrong!!");
}


header('Content-type: application/json');
echo json_encode($json);
?>