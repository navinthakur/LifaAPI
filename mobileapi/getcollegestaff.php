<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);
	$loginid = $hugeArray{"loginid"};

	$array[] = ["staffid"=>"1","name"=>"Navin Chand Thakur","type"=>"BA - LLB","course"=>"CRIMINOLOGY","courttype"=>"HIGH COURT","location"=>"Mumbai","imageurl"=>"https://www.zica.org/images/icon-student.jpg"];
	$array[] = ["staffid"=>"2","name"=>"Navin Chand Thakur","type"=>"BA - LLB","course"=>"CRIMINOLOGY","courttype"=>"HIGH COURT","location"=>"Mumbai","imageurl"=>"https://www.zica.org/images/icon-student.jpg"];

	$json_output = array("status" => "1","msg"=> "Record Found","data"=> $array);
	
	
	
	header('Content-type: application/json');
	echo json_encode($json_output);
?>