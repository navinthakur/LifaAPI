<?php
	require("../libs/config.php");
	include("session.php");
	date_default_timezone_set("Asia/Kolkata");
	$LastStatusUpdateTimeStamp = date("Y-m-d");
	
	$GetLoginName = mysql_query("select * from logintbl where logid='$user_check'");
	$GetLoginNameRows = mysql_fetch_assoc($GetLoginName);
	$FullName = $GetLoginNameRows["personname"];

    if(!empty($_POST["crpcsubtypeappuniqueid"])){
        $crpcsubtypeappuniqueid  = $_POST["crpcsubtypeappuniqueid"];

        $query = "select * from crpcsectionactintro where (crpcsectionrefid='$crpcsubtypeappuniqueid') order by CAST(crpcsectionactno AS UNSIGNED) asc"; 
        $result = mysql_query($query); 
        $resultCOunt = mysql_num_rows($result);
        if($resultCOunt > 0){ 
            echo '<option value="">Select Section No</option>'; 
            while($resultRows =mysql_fetch_array($result)){
                 echo '<option value="'.$resultRows['crpcsectionsubid'].'">'.$resultRows['crpcsectionactno'].'</option>'; 
            }
        }else{
            echo '<option value="">No Data Available</option>'; 
        } 

    }

    if(!empty($_POST["subtypeappuniqueid"])){
        $subtypeappuniqueid  = $_POST["subtypeappuniqueid"];

        $query = "select * from sectionactintro where (sectionrefid='$subtypeappuniqueid') order by CAST(sectionactno AS UNSIGNED) asc"; 
        $result = mysql_query($query); 
        $resultCOunt = mysql_num_rows($result);
        if($resultCOunt > 0){ 
            echo '<option value="">Select Section No</option>'; 
            while($resultRows =mysql_fetch_array($result)){
                 echo '<option value="'.$resultRows['sectionsubid'].'">'.$resultRows['sectionactno'].'</option>'; 
            }
        }else{
            echo '<option value="">No Data Available</option>'; 
        } 

    }

	if(!empty($_POST["refsemesterid"])){
		$refsemesterid = $_POST["refsemesterid"];
		$getrefcourseid =$_POST["getrefcourseid"];

		$query = "select * from tblsubjectlist where (subjectcourserefid='$getrefcourseid') and (subjectsemesterrefid='$refsemesterid')"; 
    	$result = mysql_query($query); 
    	$resultCOunt = mysql_num_rows($result);
    	if($resultCOunt > 0){ 
    		echo '<option value="">Select Subject</option>'; 
    		while($resultRows =mysql_fetch_array($result)){
    			 echo '<option value="'.$resultRows['subjectid'].'">'.$resultRows['subjectname'].'</option>'; 
    		}
    	}else{
    		echo '<option value="">No Data Available</option>'; 
    	}
     
	}

	if(!empty($_POST["refcourseid"])){

		$query = "select * from tblsemesterlist where courserefid=".$_POST['refcourseid'].""; 
    	$result = mysql_query($query); 
    	$resultCOunt = mysql_num_rows($result);
    	if($resultCOunt > 0){ 
            $count = 1;
    		echo '<option value="">Select Semester</option>'; 
    		while($resultRows =mysql_fetch_array($result)){
    			 echo '<option value="'.$resultRows['semesterid'].'">'.$resultRows['semestername'].' '.$count.'</option>'; 
                 $count++;
    		}
    	}else{
    		echo '<option value="">No Data Available</option>'; 
    	}
     
	}

	if(!empty($_POST["refsubjectid"])){

		$query = "select * from tblquestionpatten where questionpatternsubjectrefid=".$_POST['refsubjectid'].""; 
    	$result = mysql_query($query); 
    	$resultCOunt = mysql_num_rows($result);
    	if($resultCOunt > 0){ 
    		echo '<option value="">Select Question Pattern</option>'; 
    		while($resultRows =mysql_fetch_array($result)){
    			 echo '<option value="'.$resultRows['qpid'].'">'.$resultRows['patterntitle'].' ('.$resultRows["questionpatternmarks"].' )</option>'; 
    		}
    	}else{
    		echo '<option value="">No Data Available</option>'; 
    	}
     
	}

?>
