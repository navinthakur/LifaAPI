<?php

include("confi.php");
$json = file_get_contents('php://input');
$hugeArray = json_decode($json,true);
$zoneid = $hugeArray{"zoneid"};


$CategoryQuery = mysql_query("select * from policestnzonewise where zonerefid='$zoneid'");
$totalrecords = mysql_num_rows($CategoryQuery);
if($totalrecords > 0)
{
	while($CategoryRow = mysql_fetch_array($CategoryQuery))
	{
		$jsonnnn[] = ["stnzoneid"=> $CategoryRow["stnzoneid"],"zonestationname" => $CategoryRow["zonestationname"]];
	}
	$json =  ["status" => "1","msg" => "Record Found","data" => $jsonnnn];
}
else 
{
	$json = array("status" => "0","msg" => "No Records Found!!");		
}
	
/* Output header */
 header('Content-type: application/json');
 echo json_encode($json);
?>