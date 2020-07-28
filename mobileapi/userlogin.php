<?php
	include_once('confi.php');
	
		header('Content-Type: application/json;charset=utf-8;');
		$data = json_decode(file_get_contents('php://input'), true);// Define $username and $password 
		$username = $data["mobilenumber"];	
		$mpin = $data["mpin"];
		// To protect MySQL injection for Security purpose 
		$username = stripslashes($username);
		$password = stripslashes($mpin);
		$username = mysql_real_escape_string($username);
		$password = mysql_real_escape_string($mpin);
		
		$query = "select * from logintbl where userpassword='".$mpin."' and mobilenumber='".$username."'";
		$rows = mysql_num_rows(mysql_query($query));
		$rowval = mysql_fetch_array(mysql_query($query));
		if($rows > 0)
		{
			$json = array("status" => "1", "msg" => "User Added Successfully","logid" => $rowval["logid"],"fullname"=>$rowval["personname"],"mobilenumber"=>$rowval["mobilenumber"],"emailaddress"=>$rowval["emailaddress"],"userimg"=>"https://agentbhai.in/ServeSeva/UserPanel/images/user.png","isprofiletoshow"=>$rowval["isprofiletoshow"]);
		}
		else 
		{
			$json = array("status" => "0", "msg" => "Invalid Login Credentials!");
		}

@mysql_close($conn);	
/* Output header */
 header('Content-type: application/json');
 echo json_encode($json);

?>