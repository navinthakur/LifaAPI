<?php
	date_default_timezone_set("Asia/Kolkata");
	include_once('confi.php');
	$json = file_get_contents('php://input');
	$hugeArray = json_decode($json,true);
	
	$courseid = $hugeArray{"courseid"};
	$semesterid = $hugeArray{"semesterid"};
	$subjectid = $hugeArray{"subjectid"};
	//$alphabettype = $hugeArray{"alphabettype"};


	$getfaq = mysql_query("select * from tblsyllabusindex where (syllabusrefcourseid='$courseid') and (syllabusrefsemesterid='$semesterid') and (syllabusrefsubjectid='$subjectid')");
	$getfaqcount = mysql_num_rows($getfaq);
	if ($getfaqcount > 0) {
		while($getfaqrows = mysql_fetch_array($getfaq)){
			$faqarray[] = ["syllabusindexid"=>$getfaqrows["syllabusindexid"],"actchapter"=> $getfaqrows["syllabusactchapter"],"syllabustitle"=>$getfaqrows["syllabustitle"],"sectionchapterno"=>$getfaqrows["syllabuschapterno"]];
		}
		$json_output = array("status" => "1","msg"=> "Record Found","data"=> $faqarray);
	}else{
		$json_output = array("status" => "0","msg" => "No Record Found!!");
	}
	
	header('Content-type: application/json');
	echo json_encode($json_output);
?>