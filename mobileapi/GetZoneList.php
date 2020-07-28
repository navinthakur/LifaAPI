<?php

include("confi.php");
	
	$ZoneCount = mysql_query("select count(*) as zonecount from policestationzone");
	$GetZoneCount = mysql_fetch_assoc($ZoneCount);


		$CategoryQuery = mysql_query("select * from policestationzone");
		$totalrecords = mysql_num_rows($CategoryQuery);
		if($totalrecords > 0)
		{
			while($CategoryRow = mysql_fetch_array($CategoryQuery))
			{
				$zoneid =$CategoryRow["zoneid"];
				$GetZoneStationCount = mysql_query("select count(*) as stncount from policestnzonewise where zonerefid='$zoneid'");
				$GetZoneStationCountRows = mysql_fetch_assoc($GetZoneStationCount);
				$jsonnnn[] = ["zoneid"=> $CategoryRow["zoneid"],"zonename" => $CategoryRow["zonename"],"stncount"=> $GetZoneStationCountRows["stncount"]];
			}
			$json =  ["status" => "1","msg" => "Record Found","count"=>$GetZoneCount["zonecount"],"data" => $jsonnnn];
		}
		else 
		{
			$json = array("status" => "0","msg" => "No Records Found!!");		
		}
	
/* Output header */
 header('Content-type: application/json');
 echo json_encode($json);
?>