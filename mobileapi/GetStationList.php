<?php
include("confi.php");
$json = file_get_contents('php://input');
$hugeArray = json_decode($json,true);
$stnzoneid = $hugeArray{"stnzoneid"};


$CategoryQuery = mysql_query("select * from policezonecontactdetails where policestnzonewiserefid='$stnzoneid'");
$totalrecords = mysql_num_rows($CategoryQuery);
if($totalrecords > 0)
{
	while($CategoryRow = mysql_fetch_array($CategoryQuery))
	{
		$zonepoliceinspectoradmin = $CategoryRow["zonepoliceinspectoradmin"];
		$zonechaukiname = $CategoryRow["zonechaukiname"];
		$zonenumberofbeat = $CategoryRow["zonenumberofbeat"];
		$zonecourt = $CategoryRow["zonecourt"];
		$zonehowtoreach = $CategoryRow["zonehowtoreach"];
		$jsonnnn[] = ["stationcontactid"=> $CategoryRow["stationcontactid"],"zonesrpiname"=> $CategoryRow["zonesrpiname"],"zonesrpicontact"=> $CategoryRow["zonesrpicontact"],"zonesrpiemail"=> $CategoryRow["zonesrpiemail"],"zoneacpname"=> $CategoryRow["zoneacpname"],"zoneacpcontact"=> $CategoryRow["zoneacpcontact"],"zoneacpemail"=> $CategoryRow["zoneacpemail"],"zonedcpname"=> $CategoryRow["zonedcpname"],"zonedcpcontact"=> $CategoryRow["zonedcpcontact"],"zonedcpemail"=> $CategoryRow["zonedcpemail"],"zonepolicestation"=> $CategoryRow["zonepolicestation"],"zonedivision"=> $CategoryRow["zonedivision"],"zonename"=> $CategoryRow["zonename"],"zonepopulation"=> $CategoryRow["zonepopulation"],"zonearea"=> $CategoryRow["zonearea"],"zonepoliceinspectorcrime"=> $CategoryRow["zonepoliceinspectorcrime"],"zonepoliceinspectoradmin"=> $zonepoliceinspectoradmin,"zonechaukiname"=>$zonechaukiname,"zonenumberofbeat"=>$zonenumberofbeat,"zonecourt"=>$zonecourt,"zonehowtoreach"=>$zonehowtoreach];
	}
	$beatstatus = '';
	$GetBeatDetails = mysql_query("select * from policestnbeat where beatrefid='$stnzoneid'");
	$GetBeatDetailsCount = mysql_num_rows($GetBeatDetails);
	if($GetBeatDetailsCount > 0){
		$count = 1;
		while($GetBeatDetailsRows = mysql_fetch_array($GetBeatDetails))
		{
			$beatstatus = '1';
			$jsonnnn2[] =["beatnam"=> "BEAT-".$count,"beatdetails"=> $GetBeatDetailsRows["beatdetails"]];
			$count++;
		}
	}
	else
	{
		$beatstatus = '0';
		$jsonnnn2 = array("status" => "0","msg"=> "Details Not Found");
	}

	$strengthstatus = "";
	$StrengthQuery = mysql_query("select * from policestnstrength where strengthrefid='$stnzoneid' and  substrength='Strength'");
	$StrengthQueryCount = mysql_num_rows($StrengthQuery);
	if($StrengthQueryCount > 0)
	{
		$strengthstatus = '1';
		while($StrengthQueryRows = mysql_fetch_array($StrengthQuery))
		{
			$jsonnnn3[] = ["strengthid"=>$StrengthQueryRows["strengthid"],"typeofstrength"=> $StrengthQueryRows["typeofstrength"],"substrength"=> $StrengthQueryRows["substrength"],"strengthcount"=> $StrengthQueryRows["strengthcount"]];
		}
	}
	else{
		$strengthstatus = '0';
		$jsonnnn3 = array('status' =>"0" ,"msg"=>"No Record Found");
	}
// Vehicles Count
	$vehiclestrengthstatus = "";
	$VehicleStrengthQuery = mysql_query("select * from policestnstrength where strengthrefid='$stnzoneid' and  substrength='Vehicles'");
	$VehicleStrengthQueryCount = mysql_num_rows($VehicleStrengthQuery);
	if($VehicleStrengthQueryCount > 0)
	{
		$vehiclestrengthstatus = '1';
		while($VehicleStrengthQueryRows = mysql_fetch_array($VehicleStrengthQuery))
		{
			$jsonnnn4[] = ["strengthid"=>$VehicleStrengthQueryRows["strengthid"],"typeofstrength"=> $VehicleStrengthQueryRows["typeofstrength"],"substrength"=> $VehicleStrengthQueryRows["substrength"],"strengthcount"=> $VehicleStrengthQueryRows["strengthcount"]];
		}
	}
	else{
		$strengthstatus = '0';
		$jsonnnn4 = array('status' =>"0" ,"msg"=>"No Record Found");
	}



	$json=["status" => "1","msg" => "Record Found","beatstatus" => $beatstatus,"strengthstatus"=>$strengthstatus,"data" => $jsonnnn,"BeatDetails"=> $jsonnnn2,"StrengthDetails"=>$jsonnnn3,"VehicleDetails"=>$jsonnnn4];
}
else 
{
	$json = array("status" => "0","msg" => "No Records Found!!");		
}
header('Content-type: application/json');
echo json_encode($json);
?>