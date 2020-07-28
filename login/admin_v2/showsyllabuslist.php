<?php include("header.php");?>
<?php
  if (isset($_GET["delsyllabusindexid"])) {
    $delsyllabusindexid = $_GET["delsyllabusindexid"];
    $courseid = $_GET["courseid"];
    $semesterid =  $_GET["semesterid"];
    $txtDisplay = $_GET["txtDisplay"];
    $subjectid = $_GET["subjectid"];
    $delq = mysql_query("delete from tblsyllabusindex where syllabusindexid='$delsyllabusindexid'");
    if ($delq) {
        echo '<script>window.location = "showsyllabuslist.php?courseid='.$courseid.'&semesterid='.$semesterid.'&txtDisplay='.$txtDisplay.'&subjectid='.$subjectid.'&status=1&msg=Details Deleted Successfully!!"</script>';
     }else{
      echo '<script>window.location = "showsubjectlist.php?courseid='.$courseid.'&semesterid='.$semesterid.'&txtDisplay='.$txtDisplay.'&subjectid='.$subjectid.'&status=0&msg=Sorry Something went Wrong!!"</script>';
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


?>
<?php
    if (isset($_POST["btnsubmitstream"])) {
      $courseid = $_POST["courseid"];
      $semesterid =  $_POST["semesterid"];
      $txtDisplay = $_POST["txtDisplay"];
      $subjectid = $_POST["subjectid"];
      $actchapter = $_POST["actchapter"];
      $chapterstartfrom = $_POST["chapterstartfrom"];
      $chapterendfrom = $_POST["chapterendfrom"];
      $PrimaryTitle = $_POST["PrimaryTitle"];

       $PropertyQuery =  mysql_query("INSERT INTO `tblsyllabusindex`(`syllabustitle`,`syllabusactchapter`,`syllabuschapterno`, `syllabusrefcourseid`, `syllabusrefsemesterid`, `syllabusrefsubjectid`) VALUES ('$PrimaryTitle','$actchapter','( $chapterstartfrom to $chapterendfrom )','$courseid','$semesterid','$subjectid')");
       if ($PropertyQuery) {
          echo '<script>window.location = "showsyllabuslist.php?courseid='.$courseid.'&semesterid='.$semesterid.'&txtDisplay='.$txtDisplay.'&subjectid='.$subjectid.'&status=1&msg=Details Saved Successfully!!"</script>';
       }else{
        echo '<script>window.location = "showsubjectlist.php?courseid='.$courseid.'&semesterid='.$semesterid.'&txtDisplay='.$txtDisplay.'&subjectid='.$subjectid.'&status=0&msg=Sorry Something went Wrong!!"</script>';
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
      <li class="active"><?php echo $subjectname?></li>
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
                $viewsyllabusindexid = $_POST["viewsyllabusindexid"];
                $updateactchapter = $_POST["updateactchapter"];
                $updatechapterstartfrom = $_POST["updatechapterstartfrom"];
                $updatePrimaryTitle = $_POST["updatePrimaryTitle"];

                $updatequery = mysql_query("update tblsyllabusindex set syllabusactchapter='$updateactchapter',syllabustitle='$updatePrimaryTitle',syllabuschapterno='$updatechapterstartfrom'");
                if ($updatequery) {
                    echo '<script>window.location = "showsyllabuslist.php?courseid='.$updatecourseid.'&semesterid='.$updatesemesterid.'&txtDisplay='.$updatetxtDisplay.'&subjectid='.$updatesubjectid.'&status=1&msg=Details Updated Successfully!!"</script>';
                 }else{
                  echo '<script>window.location = "showsubjectlist.php?courseid='.$updatecourseid.'&semesterid='.$updatesemesterid.'&txtDisplay='.$updatetxtDisplay.'&subjectid='.$updatesubjectid.'&status=0&msg=Sorry Something went Wrong!!"</script>';
                 } 
              }


                if (isset($_GET["viewsyllabusindexid"])) {
                  $viewsyllabusindexid = $_GET["viewsyllabusindexid"];
                  $courseid = $_GET["courseid"];
                  $semesterid = $_GET["semesterid"];
                  $txtDisplay = $_GET["txtDisplay"];
                  $subjectid = $_GET["subjectid"];

                  $getdetails = mysql_query("select * from tblsyllabusindex where syllabusindexid='$viewsyllabusindexid'");
                  $getdetailstrows = mysql_fetch_assoc($getdetails);
                  $syllabusactchapter = $getdetailstrows["syllabusactchapter"];
                  $syllabustitle = $getdetailstrows["syllabustitle"];
                  $syllabuschapterno = $getdetailstrows["syllabuschapterno"];


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
                          <input type="hidden" name="viewsyllabusindexid" value="<?php echo $_GET["viewsyllabusindexid"]?>">
                          <input type="text" style="width: 100%" name="updateactchapter" id="updateactchapter_0" class="form-control updateactchapter" placeholder="for eg: Chapter - I" value="<?php echo $syllabusactchapter?>">
                          </div>
                      </div>
                      <div class="span2">
                          <div class="control-group">
                            <label>Serial No </label>
                             <input type="text" style="width: 100%" name="updatechapterstartfrom" id="updatechapterstartfrom_0" class="form-control updatechapterstartfrom" placeholder="Enter Serial Number"  value="<?php echo $syllabuschapterno?>">
                          </div>
                        </div>
                         <div class="span4">
                            <div class="control-group">
                              <label>Index Title </label>
                                <input type="text" style="width: 100%" name="updatePrimaryTitle"  id="updatePrimaryTitle_0" class="updatePrimaryTitle form-control" placeholder="Title here.." value="<?php echo $syllabustitle?>" />
                            </div>
                          </div>
                    </div>
                  </div>
                  <div class="row-fluid">
                    <button type="submit" id="btnupdatestream" name="btnupdatestream" class="btn btn-info">Update Details</button>
                  </div>
                  <br>
               <?php   
                }
              ?>

              <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="btn btn-primary btn-md" id="" name="" style="margin-top: -5px;">Add New Syllabus</a>
              <a href="showsubjectlist.php?courseid=<?php echo $_GET["courseid"]?>&semesterid=<?php echo $_GET["semesterid"]?>&txtDisplay=<?php echo $_GET["txtDisplay"]?>" class="btn btn-success">Go Back</a>
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
                  $courseid = $_GET["courseid"];
                  $semesterid= $_GET["semesterid"];
                  $subjectid = $_GET["subjectid"];

                  $getfaq = mysql_query("select * from tblsyllabusindex where (syllabusrefcourseid='$courseid') and (syllabusrefsemesterid='$semesterid') and (syllabusrefsubjectid='$subjectid')");
                  $getfaqcount = mysql_num_rows($getfaq);
                  if ($getfaqcount > 0) {
                  while($getfaqrows = mysql_fetch_array($getfaq)){
                ?>
                <div class="row-fluid">
                <div class="span3">
                    <a href="showsyllabusinfo.php?courseid=<?php echo $_GET["courseid"]?>&semesterid=<?php echo $_GET["semesterid"]?>&txtDisplay=<?php echo $_GET["txtDisplay"]?>&subjectid=<?php echo $subjectid?>&syllabusindexid=<?php echo $getfaqrows["syllabusindexid"]?>">
                      <div class="stat-block">
                        <ul>
                          <li class="stat-count" style="width: 100%;">
                            <span><?php echo $getfaqrows["syllabusactchapter"]?> </span>
                          <span><?php echo $getfaqrows["syllabustitle"]?> </span>
                          <span><?php echo $getfaqrows["syllabuschapterno"]?> </span>

                          <a href="showsyllabuslist.php?courseid=<?php echo $_GET["courseid"]?>&semesterid=<?php echo $_GET["semesterid"]?>&txtDisplay=<?php echo $_GET["txtDisplay"]?>&subjectid=<?php echo $subjectid?>&delsyllabusindexid=<?php echo $getfaqrows["syllabusindexid"]?>" class="pull-right"> <span class="black-icons trashcan "></span></a>


                            <a href="showsyllabuslist.php?courseid=<?php echo $_GET["courseid"]?>&semesterid=<?php echo $_GET["semesterid"]?>&txtDisplay=<?php echo $_GET["txtDisplay"]?>&subjectid=<?php echo $subjectid?>&viewsyllabusindexid=<?php echo $getfaqrows["syllabusindexid"]?>" class="pull-right"> <span class="black-icons pencil"></span></a>
                        </li>                      
                        </ul>
                      </div>
                    </a>
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