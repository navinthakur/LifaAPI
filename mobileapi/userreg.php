<?php
require_once('db_connect.php');
header('Content-Type: application/json;charset=utf-8;');
$json = file_get_contents('php://input');
 $hugeArray = json_decode($json,true);
$name = $hugeArray{'name'};
$folderpath1 = str_replace(" ", "-",$name);
$phone = $hugeArray{'phone'};
$email = $hugeArray{'email'};
$pin = $hugeArray{'mpin'};
$occupationcat = $hugeArray{"occupationcat"};

$wifiaddress = "Not Available";
$serial_no = $hugeArray{"androidId"};
$model_no = $hugeArray{"model"};
$mobile_name = $hugeArray{"brand"};
$version = $hugeArray{"version.release"};
$mobiletypw = $hugeArray{"mobiletype"};

$date = date("d-m-Y");
$time = date("h:i:s");
$status = "0";
$usertype = 'Student';

try
{
	$CheckUser = mysqli_query($con,"select * from logintbl where mobilenumber='$phone' and usertype='$occupationcat'");
	$CheckUserCount = mysqli_num_rows($CheckUser);
	if($CheckUserCount > 0){
		
		$sql = "SELECT * FROM logintbl WHERE mobilenumber='$phone' and  usertype='$occupationcat'";
		 $check = mysqli_fetch_array(mysqli_query($con,$sql));
		 $row = $check["logid"];

		 $isprofiletoshow  = $check["isprofiletoshow"];
		if ($isprofiletoshow == "" || $isprofiletoshow == null) {
			$isprofiletoshow = 'true';
		}

		$json_output = array("status" => "1", "msg" => "User Added Successfully","logid" => $row,"fullname"=>$check["personname"],"mobilenumber"=>$check["mobilenumber"],"emailaddress"=>$check["emailaddress"],"userimg"=>"https://agentbhai.in/ServeSeva/UserPanel/images/user.png","isprofiletoshow"=>$isprofiletoshow);
			
	}else{

		/*function makeDir($path)
	    {
	      return is_dir($path) || mkdir($path);
	    }
		makeDir('../../Find-Agents/'.$folderpath1);
		copy('AgentProfileView.php','../../Find-Agents/'.$folderpath1.'/index.php'); */ 

		$sql = "INSERT INTO `logintbl` (`personname`, `emailaddress`, `mobilenumber`,`userpassword`,`isprofiletoshow`,`usertype`,`wifiaddress`,`androidId`,`model`,`brand`,`versionrelease`,`mobiletype`) VALUES ('$name','$email','$phone','$pin','true','$occupationcat','$wifiaddress','$serial_no','$model_no','$mobile_name','$version','$mobiletypw')";
		
			if(mysqli_query($con,$sql)){
				 $sql = "SELECT * FROM logintbl WHERE mobilenumber='$phone' and usertype='$occupationcat'";
				 $check = mysqli_fetch_array(mysqli_query($con,$sql));
				 $row = $check["logid"];
				 mysql_query("INSERT INTO `usrstatus`(`userrefid`, `userstatus`) VALUES ('$userlastmsg','Offline')");
				$json_output = array("status" => "1", "msg" => "User Added Successfully","logid" => $row,"fullname"=>$check["personname"],"mobilenumber"=>$check["mobilenumber"],"emailaddress"=>$check["emailaddress"],"userimg"=>"https://agentbhai.in/ServeSeva/UserPanel/images/user.png","isprofiletoshow"=>"true");
				
			 }
		 else
		 {
			$json_output = array("status" => "0", "msg" => "Error adding user!");
		 }	
	}
}
catch(Exception $e)
{
	return $e;
}

mysqli_close($con);
header('Content-type: application/json');
echo json_encode($json_output);
?>