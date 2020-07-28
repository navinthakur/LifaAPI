<?php
include_once('confi.php');
$json = file_get_contents('php://input');
$hugeArray = json_decode($json,true);
$pincode = $hugeArray{"pincode"};

$GetLoc = mysql_query("select * from location where pincode='$pincode'");
$TotalRecords = mysql_num_rows($GetLoc);
if($TotalRecords > 0)
{
	$GetLocRows = mysql_fetch_assoc($GetLoc);
	$city = $GetLocRows["city"];
	$GetCityName = mysql_query("select * from city where city_id='$city'");
	$CityName = mysql_fetch_assoc($GetCityName);
	$StateId = $CityName["state"];

	$GetStateName = mysql_query("select * from statedetails where stateid='$StateId'");
	$StateName = mysql_fetch_assoc($GetStateName);
	
	$json_output = array("status" => "1","msg" => "Records Found!!","locationname" => $GetLocRows["city"],"location" => $GetLocRows["loc_name"],"city" => $CityName["city_name"],"state" => $CityName["state"],"country" => "India");		
}
else
{
	$json_output = array("status" => "0","msg" => "No Records Found!!");		
}

header('Content-type: application/json');
echo json_encode($json_output);

?>