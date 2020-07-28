<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);
	$currentdate = date("Y-m-d H:i:s");	


	$getbanner = mysql_query("select * from tblpostvideos order by videoid desc limit 3");
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

			$bannerarray[] = ["bannerid"=>$getbannerrows["videoid"],"title"=>$getbannerrows["VideoTitle"],"posteddays"=>$timetodisplay,"url"=>"http://35.194.40.144/agentbhai/law/mobileapi/".$getbannerrows["VideoThumbnail"]];
		}
	}else{
		$bannerarray = [];
	}
	


	$getlivearray = mysql_query("select * from tblpostvideos where includeinlive='Yes' order by videoid desc");
	$getlivearraycount = mysql_num_rows($getlivearray);
	if ($getlivearraycount > 0) {
		while($getlivearrayrows = mysql_fetch_array($getlivearray)){

			$videoposteddate = $getlivearrayrows["videoposteddate"];
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
			

			$faqarray[] = ["postid"=>$getlivearrayrows["videoid"],"languagetype"=>$getlivearrayrows["VideoLanguage"],"posttitle"=>$getlivearrayrows["VideoTitle"],"postdescription"=>$getlivearrayrows["VideoHeading"],"postedfrom"=>$timetodisplay,"postedby"=>$getlivearrayrows["VideoProfessorName"],"posturl"=>"http://35.194.40.144/agentbhai/law/mobileapi/".$getlivearrayrows["VideoThumbnail"]];
		}
	}else{
		$faqarray = [];
	}
	
	$gettrendingarray = mysql_query("select * from tblpostvideos where includeintrending='Yes' order by videoid desc");
	$gettrendingarraycount = mysql_num_rows($gettrendingarray);
	if ($gettrendingarraycount > 0) {
		while($gettrendingarrayrows = mysql_fetch_array($gettrendingarray)){


			$videoposteddate = $gettrendingarrayrows["videoposteddate"];
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

			$Tfaqarray[] = ["postid"=>$gettrendingarrayrows["videoid"],"languagetype"=>$gettrendingarrayrows["VideoLanguage"],"posttitle"=>$gettrendingarrayrows["VideoTitle"],"postdescription"=>$gettrendingarrayrows["VideoHeading"],"postedfrom"=>$timetodisplay,"postedby"=>$gettrendingarrayrows["VideoProfessorName"],"posturl"=>"http://35.194.40.144/agentbhai/law/mobileapi/".$gettrendingarrayrows["VideoThumbnail"]];

		}
	}else{
		$Tfaqarray = [];
	}


	$json_output = array("status" => "1","msg"=> "Record Found","sectiontwoid"=>"1","sectiontwotitle"=>"Top 30 Questions of General Science","posteddays"=>"3 Days Ago","sectiontwourl"=>"https://thumbs.dreamstime.com/z/happy-girl-home-speaking-make-up-front-camera-video-blogger-recording-message-social-media-internet-girl-147757018.jpg","bannerarray"=>$bannerarray,"livearray"=> $faqarray,"trendingarray"=> $Tfaqarray);

	/*$getfaq = mysql_query("select * from tbllatestpost");
	$getfaqcount = mysql_num_rows($getfaq);
	if ($getfaqcount > 0) {
		while($getfaqrows = mysql_fetch_array($getfaq)){
			$faqarray[] = ["bannerid"=>$getfaqrows["bannerid"],"bannertitle"=>$getfaqrows["bannertitle"],"bannerurl"=> "http://35.194.40.144/law/mobileapi/".$getfaqrows["bannerurl"]];
		}
		$json_output = array("status" => "1","msg"=> "Record Found","data"=> $faqarray);
	}else{
		$json_output = array("status" => "0","msg" => "No Record Found!!");
	}*/

	
	header('Content-type: application/json');
	echo json_encode($json_output);
?>