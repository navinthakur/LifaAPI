<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);
	$type = $hugeArray{"type"};

	// Browse Services 
	$getservices = mysql_query("select * from tbl_manage_service");
	$getservicescount = mysql_num_rows($getservices);
	if ($getservicescount > 0) {
		while($getservicesrows = mysql_fetch_array($getservices)){
			$Servicearray[] = ["serviceid"=>$getservicesrows["tbl_manageservices"],"servicename"=>$getservicesrows["servicename"],"serviceicon"=> "http://35.208.120.139/agentbhai/law/mobileapi/".$getservicesrows["service_icon"]];
		}
	}else{
		$Servicearray = array();
	}


	$getslider = mysql_query("SELECT * FROM `collegeslider`");
    $getslidercount = mysql_num_rows($getslider);
    if ($getslidercount > 0) {
	    while($getsliderrows = mysql_fetch_array($getslider)){
	    	$sliderarray[] = ["sliderid"=>$getsliderrows["collegesliderid"],"sliderimg"=>"http://35.208.120.139/agentbhai/law/mobileapi/".$getsliderrows["collegesliderurl"]];
	    }
    }else{
		$sliderarray = array();
    }

	$getfaq = mysql_query("select * from mobileappcategorieslist order by cast(categoryorder as unsigned) ASC");
	$getfaqcount = mysql_num_rows($getfaq);
	if ($getfaqcount > 0) {
		while($getfaqrows = mysql_fetch_array($getfaq)){
			$faqarray[] = ["categoryid"=>$getfaqrows["categoryid"],"categoryname"=>$getfaqrows["categoryname"],"categoryimage"=> "http://35.208.120.139/agentbhai/law/mobileapi/".$getfaqrows["categoryimage"],"categorytype" => $getfaqrows["categorytype"]];
		}
	}else{
		$faqarray = array();
	}
	$json_output = array("status" => "1","msg"=> "Record Found","data"=> $faqarray,"Servicearray"=>$Servicearray,"SliderArray"=>$sliderarray);
	
	header('Content-type: application/json');
	echo json_encode($json_output);
?>