<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);
	$isstateselected = $hugeArray{"isstateselected"};
	$statename = $hugeArray{"statename"};
	$universityname = $hugeArray{"universityname"};
	
	if ($isstateselected == "true") {

		$query = 'select * from collegedetails';
		$where = ' Where';
		$and = ' (collegestaterefname="'.$statename.'") ';
		$or = '';
		$sort = "order by abpostid desc";
		$PropUniqueId = '';
		if ($universityname != "" || $universityname != null) {
			$and .= ' and ( collegename like "'.$universityname.'%") ';
		}
		$getfaq = mysql_query($query.''.$where.''.$and);
		//$getfaq = mysql_query("select * from collegedetails where (collegestaterefname='$statename')");
		$getfaqcount = mysql_num_rows($getfaq);
		if ($getfaqcount > 0) {
			while($getfaqrows = mysql_fetch_array($getfaq)){

				$faqarray[] = ["collegeid"=>$getfaqrows["collegeid"],"collegename"=>$getfaqrows["collegename"],"universityname"=>$getfaqrows["universityname"],"collegestate"=> $getfaqrows["collegestaterefname"],"collegelocation"=>"NA","collegecontactno"=>"9999999999","collegeemail"=>"contact@collegedomain.com","collegeaddress"=>$getfaqrows["collegeaddress"],"collegeimage"=>"https://images.static-collegedunia.com/public/college_data/images/appImage/8871_m1.png"];
				
			}
				$json_output = array("status" => "1","msg"=> "Record Found","data"=> $faqarray);
		}else{
			$json_output = array("status" => "0","msg" => "No Record Found!!");
		}

	}else{

		
		$query = 'select * from collegedetails';
		$where = '';
		$and = '';
		$or = '';
		$sort = "order by abpostid desc";
		$limit = 'limit 1';
		$PropUniqueId = '';


		if ($universityname != "" || $universityname != null) {
			$where .= ' where ';
			$and .= ' ( collegename like "'.$universityname.'%") ';
		}
		
		$getfaq = mysql_query($query.''.$where.''.$and);
		//$getfaq = mysql_query("select * from collegedetails where (collegestaterefname='$statename')");
		$getfaqcount = mysql_num_rows($getfaq);
		if ($getfaqcount > 0) {
			while($getfaqrows = mysql_fetch_array($getfaq)){

				$faqarray[] = ["collegeid"=>$getfaqrows["collegeid"],"collegename"=>$getfaqrows["collegename"],"universityname"=>$getfaqrows["universityname"],"collegestate"=> $getfaqrows["collegestaterefname"],"collegelocation"=>"NA","collegecontactno"=>"9999999999","collegeemail"=>"contact@collegedomain.com","collegeaddress"=>$getfaqrows["collegeaddress"],"collegeimage"=>"https://images.static-collegedunia.com/public/college_data/images/appImage/8871_m1.png"];
				
			}
				$json_output = array("status" => "1","msg"=> "Record Found","data"=> $faqarray);
		}else{
			$json_output = array("status" => "0","msg" => "No Record Found!!");
		}

	}
	
	
	header('Content-type: application/json');
	echo json_encode($json_output);
?>