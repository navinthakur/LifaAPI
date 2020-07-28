<?php include("header.php");?>
<?php

if (isset($_GET["delsubindexid"])) {
  $delsubindexid = $_GET["delsubindexid"];
  $courseid = $_GET["courseid"];
  $semesterid =  $_GET["semesterid"];
  $txtDisplay = $_GET["txtDisplay"];
  $subjectid = $_GET["subjectid"];
  $syllabusindexid = $_GET["syllabusindexid"];
  $delq = mysql_query("delete from tblsyllabussubindex where syllabussubindexid='$delsubindexid'");
  if ($delq) {
    echo '<script>window.location = "showsyllabusinfo.php?courseid='.$courseid.'&semesterid='.$semesterid.'&txtDisplay='.$txtDisplay.'&subjectid='.$subjectid.'&syllabusindexid='.$syllabusindexid.'&status=1&msg=Details Deleted Successfully!!"</script>';
  }else{
        echo '<script>window.location = "showsyllabusinfo.php?courseid='.$courseid.'&semesterid='.$semesterid.'&txtDisplay='.$txtDisplay.'&subjectid='.$subjectid.'&syllabusindexid='.$syllabusindexid.'&status=0&msg=Sorry Something went Wrong!!"</script>';
       }
}

if (isset($_GET["courseid"])) {
  $courseid = $_GET["courseid"];
  $getname = mysql_query("select * from courselist where courseid='$courseid'");
  $getnamerows = mysql_fetch_assoc($getname);
  $coursename = $getnamerows["coursefullform"];
}
$subjectid = $_GET["subjectid"];
$getsubjectname = mysql_query("select * from tblsubjectlist where subjectid='$subjectid'");
$getsubjectnamerows = mysql_fetch_assoc($getsubjectname);
$subjectname = $getsubjectnamerows["subjectname"];

$syllabusindexid = $_GET["syllabusindexid"];
$getsyllabustext = mysql_query("select * from tblsyllabusindex where syllabusindexid='$syllabusindexid'");
$getsyllabustextrows = mysql_fetch_assoc($getsyllabustext);
$syllabustitle = $getsyllabustextrows["syllabustitle"];
?>
<?php
    if (isset($_POST["btnsubmitstream"])) {
      $courseid = $_POST["courseid"];
      $semesterid =  $_POST["semesterid"];
      $txtDisplay = $_POST["txtDisplay"];
      $subjectid = $_POST["subjectid"];
      $syllabusindexid = $_POST["syllabusindexid"];
      $actchapter = $_POST["actchapter"];
      $chapterstartfrom = $_POST["chapterstartfrom"];
      $chapterendfrom = $_POST["chapterendfrom"];
      $PrimaryTitle = $_POST["PrimaryTitle"];

       $PropertyQuery =  mysql_query("INSERT INTO `tblsyllabussubindex`(`subheading`, `subactchapter`, `subchapterno`, `subrefcourseid`, `subrefsemesterid`, `subsyllabusrefsubjectid`, `refsyllabusindexid`) VALUES ('$PrimaryTitle','$actchapter','( $chapterstartfrom to $chapterendfrom )','$courseid','$semesterid','$subjectid','$syllabusindexid')");
       if ($PropertyQuery) {
          echo '<script>window.location = "showsyllabusinfo.php?courseid='.$courseid.'&semesterid='.$semesterid.'&txtDisplay='.$txtDisplay.'&subjectid='.$subjectid.'&syllabusindexid='.$syllabusindexid.'&status=1&msg=Details Saved Successfully!!"</script>';
       }else{
        echo '<script>window.location = "showsyllabusinfo.php?courseid='.$courseid.'&semesterid='.$semesterid.'&txtDisplay='.$txtDisplay.'&subjectid='.$subjectid.'&syllabusindexid='.$syllabusindexid.'&status=0&msg=Sorry Something went Wrong!!"</script>';
       }


    }
?>
    <style type="text/css">
      .breadcrumb
      {
        padding: 11px 14px;
      }
    </style>
<div id="main-content">
  <div class="container-fluid">
     <ul class="breadcrumb">
      <li><a href="#">Home</a>
        <span class="divider">&raquo;</span>
      </li>
      <li class=""><a href="#"><?php echo $coursename?></a>
        <span class="divider">&raquo;</span>
      </li>
      <li ><a href="#"><?php echo $_GET["txtDisplay"]?></a>
        <span class="divider">&raquo;</span>
      </li>
      <li class=""><a href="#"><?php echo $subjectname?></a>
        <span class="divider">&raquo;</span>
      </li>
      <li class="active"><?php echo $syllabustitle?></li>
    </ul>

 <form class="form-horizontal well" method="post" action="">

    <div class="row-fluid">
      <div class="span12">

        <div class="nonboxy-widget">
            <?php 
              if (isset($_GET["status"])) {
                $status = $_GET["status"];
                $msg= $_GET["msg"];
                if ($status == "1") {
                 echo '<div class="alert alert-success fade in">
                <button data-dismiss="alert" class="close" type="button">×</button>
                <strong>Well done!</strong> '.$msg.'.
              </div><br><br>';
                }else if ($status == "0") {
                  echo '<div class="alert alert-error fade in">
                <button data-dismiss="alert" class="close" type="button">×</button>
                <strong>Oh snap!</strong> Sorry Something Went Wrong!!.
              </div><br><br>';
                }

              }
              echo '';
              ?>
          <div class="widget-content">
            <div class="widget-box">
              <?php
              if (isset($_POST["btnupdatestream"])) {
                $updatecourseid = $_POST["updatecourseid"];
                $updatesemesterid = $_POST["updatesemesterid"];
                $updatetxtDisplay = $_POST["updatetxtDisplay"];
                $updatesubjectid = $_POST["updatesubjectid"];
                $updatesyllabusindexid = $_POST["updatesyllabusindexid"];
                $viewsubindexid = $_POST["viewsubindexid"];
                $updateactchapter = $_POST["updateactchapter"];
                $updatechapterstartfrom = $_POST["updatechapterstartfrom"];
                $updatePrimaryTitle = $_POST["updatePrimaryTitle"];

                $updatequery = mysql_query("UPDATE `tblsyllabussubindex` SET `subheading`='$updatePrimaryTitle',`subactchapter`='$updateactchapter',`subchapterno`='$updatechapterstartfrom' WHERE `syllabussubindexid`='$viewsubindexid'");
                if ($updatequery) {
                   echo '<script>window.location = "showsyllabusinfo.php?courseid='.$updatecourseid.'&semesterid='.$updatesemesterid.'&txtDisplay='.$updatetxtDisplay.'&subjectid='.$updatesubjectid.'&syllabusindexid='.$updatesyllabusindexid.'&status=1&msg=Details Updated Successfully!!"</script>';
                }else{
                  echo '<script>window.location = "showsyllabusinfo.php?courseid='.$updatecourseid.'&semesterid='.$updatesemesterid.'&txtDisplay='.$updatetxtDisplay.'&subjectid='.$updatesubjectid.'&syllabusindexid='.$updatesyllabusindexid.'&status=0&msg=Sorry Something went Wrong!!"</script>';
                }
              }

                if (isset($_GET["viewsubindexid"])) {
                    $viewsubindexid =$_GET["viewsubindexid"];
                    $getdetails = mysql_query("select * from tblsyllabussubindex where syllabussubindexid='$viewsubindexid'");
                    $getdetailsrows = mysql_fetch_assoc($getdetails);
                     $subheading =  $getdetailsrows["subheading"];
                     $subactchapter =  $getdetailsrows["subactchapter"];
                     $subchapterno =  $getdetailsrows["subchapterno"];
                  ?>

                  <div class="row-fluid">
                    <div class="span12">
                      <div class="span2">
                        <div class="control-group">
                          <label>Subject Name</label>
                          <input type="hidden" name="updatecourseid" value="<?php echo $_GET["courseid"]?>">
                          <input type="hidden" name="updatesemesterid" value="<?php echo $_GET["semesterid"]?>">
                          <input type="hidden" name="updatetxtDisplay" value="<?php echo $_GET["txtDisplay"]?>">
                          <input type="hidden" name="updatesubjectid" value="<?php echo $_GET["subjectid"]?>">
                          <input type="hidden" name="updatesyllabusindexid" value="<?php echo $_GET["syllabusindexid"]?>">
                          <input type="hidden" name="viewsubindexid" value="<?php echo $_GET["viewsubindexid"]?>">
                          <input type="text" style="width: 100%" name="updateactchapter" id="updateactchapter_0" class="form-control updateactchapter" placeholder="for eg: Chapter - I" value="<?php echo $subactchapter?>">
                          </div>
                      </div>
                      <div class="span2">
                          <div class="control-group">
                            <label>Serial No </label>
                             <input type="text" style="width: 100%" name="updatechapterstartfrom" id="updatechapterstartfrom_0" class="form-control updatechapterstartfrom" placeholder="Enter Serial Number" value="<?php echo $subchapterno?>">
                          </div>
                        </div>
                         <div class="span4">
                            <div class="control-group">
                              <label>Index Title </label>
                                <input type="text" style="width: 100%" name="updatePrimaryTitle"  id="updatePrimaryTitle_0" class="updatePrimaryTitle form-control" placeholder="Title here.." value="<?php echo $subheading?>" />
                            </div>
                          </div>
                    </div>
                  </div>
                  <div class="row-fluid">
                    <button type="submit" id="btnupdatestream" name="btnupdatestream" class="btn btn-info">Submit Details</button>
                  </div><br>
              <?php
                }
              ?>

              <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="btn btn-primary btn-md" id="" name="" style="margin-top: -5px;">Add New Syllabus</a>
              <a href="showsyllabuslist.php?courseid=<?php echo $_GET["courseid"]?>&semesterid=<?php echo $_GET["semesterid"]?>&txtDisplay=<?php echo $_GET["txtDisplay"]?>&subjectid=<?php echo $_GET["subjectid"]?>" class="btn btn-success">Go Back</a>

               <div id="collapseOne" class="panel-collapse collapseOne collapse">
                <br>
                 <div class="row-fluid">
                    <div class="span12">
                      <div class="span2">
                        <div class="control-group">
                          <label>Subject Name</label>
                          <input type="hidden" name="courseid" value="<?php echo $_GET["courseid"]?>">
                          <input type="hidden" name="semesterid" value="<?php echo $_GET["semesterid"]?>">
                          <input type="hidden" name="txtDisplay" value="<?php echo $_GET["txtDisplay"]?>">
                          <input type="hidden" name="subjectid" value="<?php echo $_GET["subjectid"]?>">
                          <input type="hidden" name="syllabusindexid" value="<?php echo $_GET["syllabusindexid"]?>">
                          <input type="text" style="width: 100%" name="actchapter" id="actchapter_0" class="form-control actchapter" placeholder="for eg: Chapter - I">
                          </div>
                      </div>
                      <div class="span2">
                          <div class="control-group">
                            <label>From </label>
                             <input type="text" style="width: 100%" name="chapterstartfrom" id="chapterstartfrom_0" class="form-control chapterstartfrom" placeholder="Enter Serial Number">
                          </div>
                        </div>

                        <div class="span2">
                          <div class="control-group">
                            <label>To </label>
                             <input type="text" style="width: 100%" name="chapterendfrom" id="chapterendfrom_0" class="form-control chapterendfrom" placeholder="Enter Serial Number">
                          </div>
                        </div>
                         <div class="span4">
                            <div class="control-group">
                              <label>Index Title </label>
                                <input type="text" style="width: 100%" name="PrimaryTitle"  id="PrimaryTitle_0" class="PrimaryTitle form-control" placeholder="Title here.."/>
                            </div>
                          </div>
                    </div>
                  </div>
                  <div class="row-fluid">
                    <button type="submit" id="btnsubmitstream" name="btnsubmitstream" class="btn btn-info">Submit Details</button>
                  </div>
               </div>

              <br>
              <div class="row-fluid">
                <?php
                  $syllabusindexid = $_GET["syllabusindexid"];

                  $getfaq = mysql_query("select * from  tblsyllabussubindex where refsyllabusindexid='$syllabusindexid'");
                  $getfaqcount = mysql_num_rows($getfaq);
                  if ($getfaqcount > 0) {
                  while($getfaqrows = mysql_fetch_array($getfaq)){
                ?>
                <div class="row-fluid">
                  <div class="span3">
                    <div class="stat-block">
                      <ul>
                        <li class="stat-count" style="width: 100%;">
                          <span><?php echo $getfaqrows["subactchapter"]?> </span>
                        <span><?php echo $getfaqrows["subheading"]?> </span>
                        <span><?php echo $getfaqrows["subchapterno"]?> </span>

                          <a href="showsyllabusinfo.php?courseid=<?php echo $_GET["courseid"]?>&semesterid=<?php echo $_GET["semesterid"]?>&txtDisplay=<?php echo $_GET["txtDisplay"]?>&subjectid=<?php echo $subjectid?>&syllabusindexid=<?php echo $_GET["syllabusindexid"]?>&delsubindexid=<?php echo $getfaqrows["syllabussubindexid"]?>" class="pull-right"> <span class="black-icons trashcan "></span></a>


                            <a href="showsyllabusinfo.php?courseid=<?php echo $_GET["courseid"]?>&semesterid=<?php echo $_GET["semesterid"]?>&txtDisplay=<?php echo $_GET["txtDisplay"]?>&subjectid=<?php echo $subjectid?>&syllabusindexid=<?php echo $_GET["syllabusindexid"]?>&viewsubindexid=<?php echo $getfaqrows["syllabussubindexid"]?>" class="pull-right"> <span class="black-icons pencil"></span></a>
                      </li>                      
                      </ul>
                    </div>                  
                  </div>
              </div>
                <?php
                  }
                }else{
                      echo '<div class="alert alert-error fade in">
                <button data-dismiss="alert" class="close" type="button">×</button>
                <strong>Oh snap!</strong> No Record Found!!
              </div>';
                  }
                ?>


              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </form>
  </div>
</div>
<?php include("footer.php");?>