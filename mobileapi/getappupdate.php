<?php
include("confi.php");

$data = file_get_contents('php://input');// Define $username and $password 

/*$GetVersion = mysql_query("select * from applicationversion");
$GetVersionRows = mysql_fetch_assoc($GetVersion);
$appversion =$GetVersionRows["appversion"];
*/
$json_output = array("status" => "1","msg" => "Records Found!!","version"=>"1.0.0");		

 header('Content-type: application/json');
	echo json_encode($json_output);
?>