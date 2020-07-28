<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);
	$loginid = $hugeArray{"loginid"};
	$testpaperid = $hugeArray{"testpaperid"};
	$OwnerDetailsArray = $hugeArray["data"];
	$getquestioncount = mysql_query("select count(*) as quecount from tblseriesquestion where serrefid='$testpaperid'");
	$getquestioncountrows = mysql_fetch_assoc($getquestioncount);
	$quecount = $getquestioncountrows["quecount"];
	$correctans = 0;
	foreach ($OwnerDetailsArray as $key) {
		
		$refquestionid = $key{"refquestionid"};
		$selectedid = $key{"selectedid"};



		// add main submission
		$checksubmission = mysql_query("SELECT * FROM `tbltestseriesanalysis` where refquestionid='$refquestionid'");
		$checksubmissioncount = mysql_num_rows($checksubmission);
		if ($checksubmissioncount != '0') {
			
		}

		// get correct ans
		if ($selectedid != "0" && $selectedid != "skipped") {
			
			$checkanswer = mysql_query("select count(*) as anscheck from tblseriesquestion where (serquestionid='$refquestionid') and (sercorrectanswer='$selectedid')");
			 $checkanswerrows = mysql_fetch_assoc($checkanswer);
			 // 0 if not correct and 1 is correct
			 // add into table
			 
			 $anscheck  =  $checkanswerrows["anscheck"];
			 $addanalysis = mysql_query("INSERT INTO `tbltestseriesanalysis`(`refloginid`, `refpatternid`, `refquestionid`, `reftotalquestions`, `refansweredquestion`, `refnotanswered`, `refskippedquestion`, `refsubmitteddate`) VALUES ('$loginid','$testpaperid','$refquestionid','$quecount','$anscheck','','','')");
			 

		}else if($selectedid == "0"){

			$addanalysis = mysql_query("INSERT INTO `tbltestseriesanalysis`(`refloginid`, `refpatternid`, `refquestionid`, `reftotalquestions`, `refansweredquestion`, `refnotanswered`, `refskippedquestion`, `refsubmitteddate`) VALUES ('$loginid','$testpaperid','$refquestionid','$quecount','','true','','')");
		}
		else if($selectedid == "skipped"){

			$addanalysis = mysql_query("INSERT INTO `tbltestseriesanalysis`(`refloginid`, `refpatternid`, `refquestionid`, `reftotalquestions`, `refansweredquestion`, `refnotanswered`, `refskippedquestion`, `refsubmitteddate`) VALUES ('$loginid','$testpaperid','$refquestionid','$quecount','','','true','')");
		}
	}

	// answered count
	$getanalysis = mysql_query("select count(*) as answeredquestioncount from tbltestseriesanalysis where (refloginid='$loginid') and (refpatternid='$testpaperid') and (refansweredquestion='1')");
	$getanalysisrows = mysql_fetch_array($getanalysis);
	$totalansweredcount = $getanalysisrows["answeredquestioncount"];

	// Not answered count
	$getanalysis = mysql_query("select count(*) as notansweredquestioncount from tbltestseriesanalysis where (refloginid='$loginid') and (refpatternid='$testpaperid') and (refnotanswered='true')");
	$getanalysisrows = mysql_fetch_array($getanalysis);
	$nottotalansweredcount = $getanalysisrows["notansweredquestioncount"];

	// answered count
	$getanalysis = mysql_query("select count(*) as skippedansweredquestioncount from tbltestseriesanalysis where (refloginid='$loginid') and (refpatternid='$testpaperid') and (refskippedquestion='true')");
	$getanalysisrows = mysql_fetch_array($getanalysis);
	$skippedanscount = $getanalysisrows["skippedansweredquestioncount"];



	$json_output = array("status"=>"1","msg"=>"Record Found","answeredcount"=> $totalansweredcount,"notansweredcount"=> $nottotalansweredcount,"skippedanscount"=> $skippedanscount);

	header('Content-type: application/json');
	echo json_encode($json_output);


	
	
?>