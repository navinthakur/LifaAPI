<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);
	$loginid = $hugeArray{"loginid"};
	$videotype = $hugeArray{"videotype"};
	$currentdate = date("Y-m-d H:i:s");
	$and = '';
	if ($videotype == "Trending") {
		$and .= ' where (includeintrending="Yes") ';
	}else if ($videotype == "Live") {
		$and .= ' where (includeinlive="Yes") ';
	}

	$getbanner = mysql_query("select * from tblpostvideos ".$and." order by videoid desc");
	$getbannercount = mysql_num_rows($getbanner);
	if ($getbannercount > 0) {
		while($getbannerrows = mysql_fetch_array($getbanner)){
			$videoposteddate = $getbannerrows["videoposteddate"];
			$date1 = strtotime($videoposteddate);  
			$date2 = strtotime($currentdate); 
			// Formulate the Difference between two dates 
			$diff = abs($date2 - $date1);  

			// To get the year divide the resultant date into 
			// total seconds in a year (365*60*60*24) 
			$years = floor($diff / (365*60*60*24));  
			// To get the month, subtract it with years and 
			// divide the resultant date into 
			// total seconds in a month (30*60*60*24) 
			$months = floor(($diff - $years * 365*60*60*24) 
			                               / (30*60*60*24));  
			  
			  
			// To get the day, subtract it with years and  
			// months and divide the resultant date into 
			// total seconds in a days (60*60*24) 
			$days = floor(($diff - $years * 365*60*60*24 -  
			             $months*30*60*60*24)/ (60*60*24)); 
			  
			  
			// To get the hour, subtract it with years,  
			// months & seconds and divide the resultant 
			// date into total seconds in a hours (60*60) 
			$hours = floor(($diff - $years * 365*60*60*24  
			       - $months*30*60*60*24 - $days*60*60*24) 
			                                   / (60*60));  
			  
			  
			// To get the minutes, subtract it with years, 
			// months, seconds and hours and divide the  
			// resultant date into total seconds i.e. 60 
			$minutes = floor(($diff - $years * 365*60*60*24  
			         - $months*30*60*60*24 - $days*60*60*24  
			                          - $hours*60*60)/ 60);  
			  
			  
			// To get the minutes, subtract it with years, 
			// months, seconds, hours and minutes  
			$seconds = floor(($diff - $years * 365*60*60*24  
			         - $months*30*60*60*24 - $days*60*60*24 
			                - $hours*60*60 - $minutes*60));  
			  
			// Print the result 
			if ($years > 0) {
				$timetodisplay = $years . " Years ago";
			}
			else if ($months > 0) {
				$timetodisplay = $months . " Months ago";
			}
			else if ($days > 0) {
				$timetodisplay = $days . " Days ago";
			}
			else if ($hours > 0) {
				$timetodisplay = $hours . " hours ago";
			}
			else if ($minutes > 0) {
				$timetodisplay = $minutes . " Minutes ago";
			}

			else if ($seconds > 0) {
				$timetodisplay = $seconds . " Seconds ago";
			}

			$faqarray[] = ["postid"=>$getbannerrows["videoid"],"languagetype"=>$getbannerrows["VideoLanguage"],"videotype"=>$getbannerrows["VideoUploadType"],"posttitle"=>$getbannerrows["VideoTitle"],"postdescription"=>$getbannerrows["VideoHeading"],"postedfrom"=>$timetodisplay,"postedby"=>$getbannerrows["VideoProfessorName"],"posturl"=>"http://35.194.40.144/agentbhai/law/mobileapi/".$getbannerrows["VideoThumbnail"]];
		}
		$json_output = array("status" => "1","msg"=> "Record Found","data"=> $faqarray);
	}else{
		$json_output = array("status" => "0","msg"=> "No Video Found");
	}
	

	
	header('Content-type: application/json');
	echo json_encode($json_output);
?>