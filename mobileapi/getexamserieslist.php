<?php
include("confi.php");
$json = file_get_contents('php://input');
$hugeArray = json_decode($json,true);
date_default_timezone_set("Asia/Kolkata");
$examid =  $hugeArray{"examid"};

if ($examid == "All") {
	$getserieslist = mysql_query("select * from tbl_testserieslist");
	$getserieslistcount = mysql_num_rows($getserieslist);
	if ($getserieslistcount > 0 ) {
		while($getserieslistrows = mysql_fetch_array($getserieslist)){
			
			$seriesseriesuniquekey = $getserieslistrows["seriesseriesuniquekey"];
			$getseriestag = mysql_query("select * from tbl_testseriestag where seriesefid='$seriesseriesuniquekey'");
			while($getseriestagrows = mysql_fetch_array($getseriestag)){
				$seriestag[] = ["tagname"=>$getseriestagrows["tagname"]];
			}

			$data_array[] = ["seriesid"=>$getserieslistrows["seriesid"],"testtitle"=>$getserieslistrows["testtitle"],"testdescription"=>$getserieslistrows["testdescription"],"testtime"=>$getserieslistrows["testtime"],"testmarks"=>$getserieslistrows["testmarks"],"testlanguage"=>$getserieslistrows["testlanguage"],"postedat"=>"19 Hours Ago","icon"=>"http://35.194.40.144/agentbhai/law/mobileapi/uploads/appicon.png","bannerimage"=>"https://www.ltgplc.com/wp-content/uploads/2018/08/TEST-banner.jpg","seriestag"=>$seriestag];
			$seriestag = [];
		}
		$json_output = array("status" => "1","msg" =>"Record Found!!","data"=>$data_array);
	}else{
		$json_output = array("status" => "0","msg" =>"No Record Found!!");
	}
}else{

	$getserieslist = mysql_query("select * from tbl_testserieslist where refexamid='$examid'");
	$getserieslistcount = mysql_num_rows($getserieslist);
	if ($getserieslistcount > 0 ) {
		while($getserieslistrows = mysql_fetch_array($getserieslist)){

			$seriesseriesuniquekey = $getserieslistrows["seriesseriesuniquekey"];
			$getseriestag = mysql_query("select * from tbl_testseriestag where seriesefid='$seriesseriesuniquekey'");
			while($getseriestagrows = mysql_fetch_array($getseriestag)){
				$seriestag[] = ["tagname"=>$getseriestagrows["tagname"]];
			}

			$data_array[] = ["seriesid"=>$getserieslistrows["seriesid"],"testtitle"=>$getserieslistrows["testtitle"],"testdescription"=>$getserieslistrows["testdescription"],"testtime"=>$getserieslistrows["testtime"],"testmarks"=>$getserieslistrows["testmarks"],"testlanguage"=>$getserieslistrows["testlanguage"],"icon"=>"http://35.194.40.144/agentbhai/law/mobileapi/uploads/appicon.png","bannerimage"=>"https://www.ltgplc.com/wp-content/uploads/2018/08/TEST-banner.jpg","seriestag"=>$seriestag];
			$seriestag = [];
		}
		$json_output = array("status" => "1","msg" =>"Record Found!!","data"=>$data_array);
	}else{
		$json_output = array("status" => "0","msg" =>"No Record Found!!");
	}

}

header('Content-type: application/json');
echo json_encode($json_output);
?>