<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);

    $getclatabout = mysql_query("select * from tblcollegedoc");
    $getclataboutcount = mysql_num_rows($getclatabout);
    if ($getclataboutcount > 0) {
    	while($getclataboutrows = mysql_fetch_array($getclatabout)){
    		$faqarray[] = ["conteny"=>$getclataboutrows["documentcontent"]];
    	}
    	$json_output = array("status"=>"1","msg"=>"Record Found","data"=>$faqarray);		
    }else{
    	$json_output = array("status"=>"0","msg"=>"No Record Found");
    }

    
	header('Content-type: application/json');
	echo json_encode($json_output);




	
	
?>