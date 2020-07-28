<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);

$pattenval = [];

	$getlawdetails = mysql_query("SELECT * FROM `cetlawdetails`");
	$getlawdetailscount = mysql_num_rows($getlawdetails);
	if ($getlawdetailscount > 0) {

		while($getlawdetailsrows = mysql_fetch_array($getlawdetails)){

			$cetdetailid = $getlawdetailsrows["cetdetailid"];
			$cetdetailtype = $getlawdetailsrows["cetdetailtype"];
			if ($cetdetailtype == "0") {

				$event = [];
				$patternarray = [];
				$legalaptitude = [];
				$legalaptitudebook = [];
				$gktopic = [];
				$gkbook = [];
				$logicalreasoning = [];
				$logicalreasoningbook = [];
				$englishsection = [];
				$englishsectionbook = [];
				$mathsection = [];
				$mathbook = [];
				$santionedseats = [];

			}else if ($cetdetailtype == "1") {

				$getevent = mysql_query("select * from cetlawdetailsevent where ceteventrefid='$cetdetailid'");
				while($geteventrows = mysql_fetch_array($getevent)){

					$event[] = ["ceteventname"=>$geteventrows["ceteventname"],"ceteventfiveyeardate"=>$geteventrows["ceteventfiveyeardate"],"ceteventthreeyeardate" => $geteventrows["ceteventthreeyeardate"]];

				}
				$patternarray = [];
				$legalaptitude = [];
				$legalaptitudebook = [];
				$gktopic = [];
				$gkbook = [];
				$logicalreasoning = [];
				$logicalreasoningbook = [];
				$englishsection = [];
				$englishsectionbook = [];
				$mathsection = [];
				$mathbook = [];
				$santionedseats = [];

			}else if ($cetdetailtype == "2") {
				$event = [];
				$legalaptitude = [];
				$legalaptitudebook = [];
				$gktopic = [];
				$gkbook = [];
				$logicalreasoning = [];
				$logicalreasoningbook = [];
				$englishsection = [];
				$englishsectionbook = [];
				$mathsection = [];
				$mathbook = [];
				$santionedseats = [];

				$getpattern = mysql_query("select * from tblcetpatterndetails where patternrefid='$cetdetailid';");
				while($getpatternrows = mysql_fetch_array($getpattern)){


					$pattenval[] = ["subject" => $getpatternrows["cetsubject"],"noofqestion"=> $getpatternrows["cettotalquestions"],"marks" => $getpatternrows["nototalmarks"]];
				}


				$getpatterntotal = mysql_query("select sum(cettotalquestions) as cettotalquestions,sum(nototalmarks) as nototalmarks from tblcetpatterndetails where patternrefid='$cetdetailid'");
				$getpatterntotalrows = mysql_fetch_assoc($getpatterntotal);

				$patternarray = array("totalofquestion" => $getpatterntotalrows["cettotalquestions"] , "totalofmarks"=> $getpatterntotalrows["nototalmarks"],"patterndata" => $pattenval);
			}else if ($cetdetailtype == "3") {
				
				$event = [];
				$patternarray = [];
				$legalaptitudebook = [];
				$gktopic = [];
				$gkbook = [];
				$logicalreasoning = [];
				$logicalreasoningbook = [];
				$englishsection = [];
				$englishsectionbook = [];
				$mathsection = [];
				$mathbook = [];
				$santionedseats = [];
				
				$getaptitude = mysql_query("select * from cetlegalaptitudesection where aptituderefid='$cetdetailid'");
				$getaptitudecount = mysql_num_rows($getaptitude);
				if ($getaptitudecount > 0) {
					while($getaptituderows = mysql_fetch_array($getaptitude)){
						$legalaptitude[] = ["aptitudename" =>$getaptituderows["aptitudecontent"]];	
					}
				}else{
					$legalaptitude = [];
				}

			}else if ($cetdetailtype == "4") {
				$event = [];
				$patternarray = [];
				$legalaptitude = [];
				$gktopic = [];
				$gkbook = [];
				$logicalreasoning = [];
				$logicalreasoningbook = [];
				$englishsection = [];
				$englishsectionbook = [];
				$mathsection = [];
				$mathbook = [];
				$santionedseats = [];

				$getlegalaptitudebook = mysql_query("select * from cetlegalaptitudebooks where aptitudebooksrefid='$cetdetailid'");
				$getlegalaptitudebookcount = mysql_num_rows($getlegalaptitudebook);
				if ($getlegalaptitudebookcount > 0) {
					while($getlegalaptitudebookrows = mysql_fetch_array($getlegalaptitudebook)){

						$legalaptitudebook[] = ["bookname" => $getlegalaptitudebookrows["aptitudebookname"],"authorname" => $getlegalaptitudebookrows["aptitudeauthorname"]];

					}
				}else{
					$legalaptitudebook = [];
				}
			}
			else if ($cetdetailtype == "5") {
				$event = [];
				$patternarray = [];
				$legalaptitude = [];
				$legalaptitudebook = [];
				$gkbook = [];
				$logicalreasoning = [];
				$logicalreasoningbook = [];
				$englishsection = [];
				$englishsectionbook = [];
				$mathsection = [];
				$mathbook = [];
				$santionedseats = [];

				$getgktopic = mysql_query("select * from cetgktopicdetails where gktopicrefid='$cetdetailid'");
				$getgktopiccount = mysql_num_rows($getgktopic);
				if ($getgktopiccount > 0) {
					while($getgktopicrows = mysql_fetch_array($getgktopic)){
						$gktopic[] = ["topicname" => $getgktopicrows["topicname"]];
					}
				}else{
					$gktopic = [];
				}
			}else if ($cetdetailtype == "6") {

				$event = [];
				$patternarray = [];
				$legalaptitude = [];
				$legalaptitudebook = [];
				$gktopic = [];
				$logicalreasoning = [];
				$logicalreasoningbook = [];
				$englishsection = [];
				$englishsectionbook = [];
				$mathsection = [];
				$mathbook = [];
				$santionedseats = [];

				$getgkbook = mysql_query("select * from cetgkbookdetails where gkbookrefid='$cetdetailid'");
				$getgkbookcount = mysql_num_rows($getgkbook);
				if ($getgkbookcount > 0) {
					while($getgkbookrows = mysql_fetch_array($getgkbook)){

						$gkbook[] = ["gkbookname"=>$getgkbookrows["gkbookname"],"gkbookauthorname"=> $getgkbookrows["gkbookauthorname"]];
					}
				}else{
					$gkbook = [];
				}
			}else if ($cetdetailtype == "7") {
				$event = [];
				$patternarray = [];
				$legalaptitude = [];
				$legalaptitudebook = [];
				$gktopic = [];
				$gkbook = [];
				$logicalreasoningbook = [];
				$englishsection = [];
				$englishsectionbook = [];
				$mathsection = [];
				$mathbook = [];
				$santionedseats = [];


				$getlogicalreasoning = mysql_query("select * from cetlogicalreasoning where logicalreasoningrefid='$cetdetailid'");
				$getlogicalreasoningcount = mysql_num_rows($getlogicalreasoning);
				if ($getlogicalreasoningcount > 0) {
					while($getlogicalreasoningrows = mysql_fetch_array($getlogicalreasoning)){
						$logicalreasoning[] = ["logicalreasoningtopicname"=> $getlogicalreasoningrows["logicalreasoningtopic"]];
					}
				}else{
					$logicalreasoning = [];	
				}
			}else if ($cetdetailtype == "8") {
				$event = [];
				$patternarray = [];
				$legalaptitude = [];
				$legalaptitudebook = [];
				$gktopic = [];
				$gkbook = [];
				$logicalreasoning = [];
				$englishsection = [];
				$englishsectionbook = [];
				$mathsection = [];
				$mathbook = [];
				$santionedseats = [];

				$getlogicalreasoningbook = mysql_query("select * from cetlogicalreasoningbooks where logicalreasoningbookrefid='$cetdetailid'");
				$getlogicalreasoningbookcount = mysql_num_rows($getlogicalreasoningbook);
				if ($getlogicalreasoningbookcount > 0) {
					while($getlogicalreasoningbookrows = mysql_fetch_array($getlogicalreasoningbook)){
						$logicalreasoningbook[] = ["logicalreasoningbookname" => $getlogicalreasoningbookrows["logicalreasoningbookname"], "logicalreasoningbookauthorname" => $getlogicalreasoningbookrows["logicalreasoningbookauthorname"]];
					}
				}else{
					$logicalreasoningbook = [];
				}
			}else if ($cetdetailtype == "9") {
				
				$event = [];
				$patternarray = [];
				$legalaptitude = [];
				$legalaptitudebook = [];
				$gktopic = [];
				$gkbook = [];
				$logicalreasoning = [];
				$logicalreasoningbook = [];
				$englishsectiontopic = [];
				$englishsectionbook = [];
				$mathsection = [];
				$mathbook = [];
				$santionedseats = [];

				$getenglishsection = mysql_query("select * from cetenglishsection");
				while($getenglishsectionrows = mysql_fetch_array($getenglishsection)){
					$englishsectionid = $getenglishsectionrows["englishsectionid"];

					$getenglishsectiontopic = mysql_query("select * from cetenglishsectiontopic where englishsectiontopicrefid='$englishsectionid'");
					while($getenglishsectiontopicrows = mysql_fetch_array($getenglishsectiontopic)){
						$englishsectiontopic[] = ["topicname" => $getenglishsectiontopicrows["englishsectiontopicname"]];
					}

					$englishsection[] = ["mainheading"=> $getenglishsectionrows["englishsectionheading"],"englishsectiontopic"=>$englishsectiontopic];	
					$englishsectiontopic = [];
				}
			}else if ($cetdetailtype == "10") {
				$event = [];
				$patternarray = [];
				$legalaptitude = [];
				$legalaptitudebook = [];
				$gktopic = [];
				$gkbook = [];
				$logicalreasoning = [];
				$logicalreasoningbook = [];
				$englishsectiontopic = [];
				$englishsection = [];
				$mathsection = [];
				$mathbook = [];
				$santionedseats = [];


				$getenglishsectionbook = mysql_query("select * from cetenglishsectionbook where englishsectionbookrefid='$cetdetailid'");
				$getenglishsectionbookcount = mysql_num_rows($getenglishsectionbook);

				if ($getenglishsectionbookcount > 0) {
					while($getenglishsectionbookrows = mysql_fetch_array($getenglishsectionbook)){

						$englishsectionbook[] = ["englishsectionbookname"=>$getenglishsectionbookrows["englishsectionbookname"],"englishsectionbookauthorname" => $getenglishsectionbookrows["englishsectionbookauthorname"]];

					}
				}else{
					$englishsectionbook = [];
				}
			}else if ($cetdetailtype == "11") {
				
				$event = [];
				$patternarray = [];
				$legalaptitude = [];
				$legalaptitudebook = [];
				$gktopic = [];
				$gkbook = [];
				$logicalreasoning = [];
				$logicalreasoningbook = [];
				$englishsectiontopic = [];
				$englishsection = [];
				$englishsectionbook = [];
				$mathsectiontopic = [];
				$mathbook = [];
				$santionedseats = [];

				$getmathsection = mysql_query("select * from cetmathsectiontopic where mathsectiontopicrefid='$cetdetailid'");
				$getmathsectioncount = mysql_num_rows($getmathsection);
				if ($getmathsectioncount > 0) {
					while($getmathsectionrows = mysql_fetch_array($getmathsection)){
						$mathsectiontopicid = $getmathsectionrows["mathsectiontopicid"];

						$gettopicdetails = mysql_query("select * from cetmathsectiontopicdetails where mathsectiontopicdetailsrefid='$mathsectiontopicid'");
						while($gettopicdetailsrows = mysql_fetch_array($gettopicdetails)){
							$mathsectiontopic[] = ["mathtopicname"=> $gettopicdetailsrows["mathtopicname"]];
						}


						$mathsection[] = ["chaptername" => $getmathsectionrows["mathsectiontopic"],"mathsectiontopic" => $mathsectiontopic];
						$mathsectiontopic = [];
					}
				}else{
					$mathsection = [];
				}

			}
			else if ($cetdetailtype == "12") {
				$event = [];
				$patternarray = [];
				$legalaptitude = [];
				$legalaptitudebook = [];
				$gktopic = [];
				$gkbook = [];
				$logicalreasoning = [];
				$logicalreasoningbook = [];
				$englishsectiontopic = [];
				$englishsection = [];
				$englishsectionbook = [];
				$mathsectiontopic = [];
				$mathsection = [];
				$santionedseats = [];
				$getmathbook = mysql_query("select * from cetmathbook where cetmathbookrefid='$cetdetailid'");
				$getmathbookcount = mysql_num_rows($getmathbook);
				if ($getmathbookcount > 0) {
					while($getmathbookrows = mysql_fetch_array($getmathbook)){
						$mathbook[] = ["mathbookname" => $getmathbookrows["cetmathbookname"],"mathbookauthorname"=>$getmathbookrows["cetmathbookauthorname"]];
					}
				}else{
					$mathbook = [];
				}
			}else if ($cetdetailtype == "13") {

				$event = [];
				$patternarray = [];
				$legalaptitude = [];
				$legalaptitudebook = [];
				$gktopic = [];
				$gkbook = [];
				$logicalreasoning = [];
				$logicalreasoningbook = [];
				$englishsectiontopic = [];
				$englishsection = [];
				$englishsectionbook = [];
				$mathsectiontopic = [];
				$mathsection = [];
				$mathbook = [];

				$getsantionedseat = mysql_query("select * from cetsantionedseats where santionedseatsrefid='$cetdetailid'");
				$getsantionedseatcount = mysql_num_rows($getsantionedseat);
				if ($getsantionedseatcount > 0) {
					while($getsantionedseatrows = mysql_fetch_array($getsantionedseat)){
						$santionedseats[] = ["institutename"=>$getsantionedseatrows["institutename"],"maharashtracandidatepercentage"=>$getsantionedseatrows["maharashtrapercentage"],"indiapercentage"=>$getsantionedseatrows["allindiapercentage"],"nriquota"=>$getsantionedseatrows["nriquota"],"minorityquota"=>$getsantionedseatrows["minorityquota"]];
					}
				}else{
					$santionedseats = [];
				}

				

			}


			$cetdescription = $getlawdetailsrows["cetdescription"];
			if ($cetdescription == "" || $cetdescription == null) {
				$cetdescription = '';
			}



			$lawarray[] = ["cetdetailid"=>$getlawdetailsrows["cetdetailid"],"cetdetailtype" => $getlawdetailsrows["cetdetailtype"],"cetheadingtitle" => $getlawdetailsrows["cetheadingtitle"],"cetdescription" => $cetdescription,"event"=> $event,"pattern" => $patternarray,"legalaptitude" => $legalaptitude,"legalaptitudebook" => $legalaptitudebook,"gktopic"=>$gktopic,"gkbook"=> $gkbook,"logicalreasoning"=> $logicalreasoning,"logicalreasoningbook"=> $logicalreasoningbook,"englishsection"=> $englishsection,"englishsectionbook"=> $englishsectionbook,"mathsection"=> $mathsection,"mathbook" => $mathbook,"santionedseats" => $santionedseats];

			$event = [];
			$pattenval = [];
			$legalaptitude = [];
			$legalaptitudebook = [];
			$gktopic = [];
			$gkbook = [];
			$logicalreasoning = [];
			$logicalreasoningbook = [];
			$englishsection = [];
			$englishsectionbook = [];
			$mathsection = [];
			$mathbook = [];
			$santionedseats = [];
		}
		$json_output = array("status" => "1","msg" => "Record Found!","data"=>$lawarray);
		
	}else{
		$json_output = array("status" => "0","msg" => "No Record Found!");
	}
	

	
	header('Content-type: application/json');
	echo json_encode($json_output);
?>