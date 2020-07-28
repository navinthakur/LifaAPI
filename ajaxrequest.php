<?php
	include("libs/config.php");
	include("encrypte.php");
	date_default_timezone_set("Asia/Kolkata");
	if (isset($_POST["contactpersonname"]) && isset($_POST["contactpersonname"]) != "") {

		$contactpersonname = Encrypt($_POST["contactpersonname"]);
		$contactmobileno = Encrypt($_POST["contactmobileno"]);
		$contactemail = Encrypt($_POST["contactemail"]);
		$contactcomments = Encrypt($_POST["contactcomments"]);
		$requestsubmitdate = date("d-m-Y H:i:s");

		$contactsavequery = mysql_query("INSERT INTO `tblcontactform`(`contactpersonname`, `contactmobileno`, `contactemail`, `contactcomments`, `requestsubmitdate`) VALUES ('$contactpersonname','$contactmobileno','$contactemail','$contactcomments','$requestsubmitdate')");
		if ($contactsavequery) {
			echo "1";
		}else{
			echo "0";
		}
	}
?>