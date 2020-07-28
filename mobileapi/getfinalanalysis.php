<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);

    $loginid = $hugeArray{"loginid"};
    $testpaperid = $hugeArray{"testpaperid"};
    
    $faqarray[] = ["logid"=>"1","name"=>"Navin Thakur","correctans"=>"6","attempted"=>"131/135","rank"=>"2","keepactive"=>"false"];
    $faqarray[] = ["logid"=>"2","name"=>"Karan Saluja","correctans"=>"6","attempted"=>"131/135","rank"=>"2","keepactive"=>"false"];
	$faqarray[] = ["logid"=>"3","name"=>"Asif Shaikh","correctans"=>"6","attempted"=>"131/135","rank"=>"2","keepactive"=>"true"];

    $subjectarray[] = ["subjectid"=>"1","subjectname"=>"Arithmetic","percentage"=>"% Marks 0","totalanswered"=>"1/2 answered"];
    $subjectarray[] = ["subjectid"=>"2","subjectname"=>"Arithmetic","percentage"=>"% Marks 0","totalanswered"=>"1/2 answered"];
    $subjectarray[] = ["subjectid"=>"3","subjectname"=>"Arithmetic","percentage"=>"% Marks 0","totalanswered"=>"1/2 answered"];                                     
	$json_output = array("status"=>"1","msg"=>"Record Found","totalquestion"=>"4","answeredcount"=> "2","notansweredcount"=> "1","skippedanscount"=> "1","rankto"=>"2","rankfrom"=>"3","topperformerdata" => $faqarray,"subjectarray"=>$subjectarray);

    
	header('Content-type: application/json');
	echo json_encode($json_output);




	
	
?>