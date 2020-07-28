<?php
	require("../libs/config.php");
	
	date_default_timezone_set("Asia/Kolkata");
	$LastStatusUpdateTimeStamp = date("Y-m-d");
	if (isset($_POST["BldgFlatNo"]) && isset($_POST["BldgFlatNo"]) != "") {
		$BldgFlatNo = $_POST["BldgFlatNo"];
		$PalavaProjectName = $_POST["PalavaProjectName"];
		$PalavaProjectBldgName = $_POST["PalavaProjectBldgName"];
		$BldgWingNo = $_POST["BldgWingNo"];
		$BldgFloorNo = $_POST["BldgFloorNo"];

		$CheckStatus = mysql_query("select * from PalavaPropertyDetails where PropertyPalavaProjectName='$PalavaProjectName' and PropertyPalavaProjectBldgName='$PalavaProjectBldgName' and PropertyBldgWingNo='$BldgWingNo' and PropertyBldgFloorNo='$BldgFloorNo' and PropertyBldgFlatNo='$BldgFlatNo'");
		$CheckStatusCount = mysql_num_rows($CheckStatus);
		if ($CheckStatusCount > 0) {
			$CheckStatusRows = mysql_fetch_assoc($CheckStatus);
			$PropertyUniqueId = $CheckStatusRows["PropertyUniqueid"];
			$GetOwner = mysql_query("select * from PalavaOwnerDetails where PropRefUniqueid='$PropertyUniqueId'");
			while($GetOwnerRows = mysql_fetch_array($GetOwner)){
				$ownerrelationship = $GetOwnerRows["ownerrelationship"];
				if ($ownerrelationship == "" || $ownerrelationship == null || $ownerrelationship == "null") {
					$ownerrelationship = '';
				}
				$OwnerJson[] = ["OwnerId"=>$GetOwnerRows["OwnerId"],"PrimaryOwnerName"=> $GetOwnerRows["PrimaryOwnerName"],"PrimaryOwnerContact"=> $GetOwnerRows["PrimaryOwnerContact"],"PrimaryOwnerEmail"=> $GetOwnerRows["PrimaryOwnerEmail"],"ownerrelationship"=>$ownerrelationship];
			}
			$getTenant = mysql_query("select * from PalavaTenantDetails where PropTUniqueid='$PropertyUniqueId'");
			while($getTenantRows = mysql_fetch_array($getTenant)){
				$PrimaryTenantRelationship = $getTenantRows["PrimaryTenantRelationship"];
				if ($PrimaryTenantRelationship == "" || $PrimaryTenantRelationship == null || $PrimaryTenantRelationship == "null") {
					$PrimaryTenantRelationship = '';
				}
				$TenantJson[] = ["TenantId"=>$getTenantRows["TenantId"],"PrimaryTenantName" => $getTenantRows["PrimaryTenantName"],"PrimaryTenantContact"=>$getTenantRows["PrimaryTenantContact"],"PrimaryTenantEmail"=>$getTenantRows["PrimaryTenantEmail"],"PrimaryTenantRelationship"=>$PrimaryTenantRelationship];
			}
			$json =  ["status" => "1","msg" => "Record Found","PropertyUniqueId"=>$PropertyUniqueId,"OwnerDetails" => $OwnerJson,"TenantDetails" => $TenantJson];

		}else{
			$json = array("status" => "0","msg" => "No Records Found!!");
		}
		
	}
	header('Content-type: application/json');
 	echo json_encode($json);
?>
