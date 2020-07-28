<?php include("header.php");?>
<?php

if (isset($_GET["delsubjectid"])) {
  $delsubjectid = $_GET["delsubjectid"];
  $courseid = $_GET["courseid"];
  $semesterid = $_GET["semesterid"];
  $txtDisplay =$_GET["txtDisplay"];

  $delq = mysql_query("delete from tblsubjectlist where subjectid='$delsubjectid'");

  if ($delq) {
    echo '<script>window.location = "exampointthird.php?courseid='.$courseid.'&semesterid='.$semesterid.'&txtDisplay='.$txtDisplay.'&subjectid='.$delsubjectid.'&status=1&msg=Details Deleted Successfully!!"</script>';
  }else{
    echo '<script>window.location = "exampointthird.php?courseid='.$courseid.'&semesterid='.$semesterid.'&txtDisplay='.$txtDisplay.'&subjectid='.$delsubjectid.'&status=0&msg=Sorry Something went Wrong!!"</script>';
  }
}
if (isset($_GET["courseid"])) {
  $courseid = $_GET["courseid"];
  $getname = mysql_query("select * from courselist where courseid='$courseid'");
  $getnamerows = mysql_fetch_assoc($getname);
  $coursename = $getnamerows["coursefullform"];
}


?>


<?php 
    if (isset($_POST["btnsubmitstream"])) {
      $courseid = $_POST["courseid"]; 
      $semesterid = $_POST["semesterid"];
      $Shortname = $_POST["Shortname"];
      $txtDisplay = $_POST["txtDisplay"];

      $subjectquery = mysql_query("INSERT INTO `tblsubjectlist`(`subjectname`, `subjecticon`, `subjectcourserefid`, `subjectsemesterrefid`, `subjectstatus`) VALUES ('$Shortname','images/subcategory.jpg','$courseid','$semesterid','1')");
      if ($subjectquery) {
        echo '<script>window.location = "exampointthird.php?courseid='.$courseid.'&semesterid='.$semesterid.'&txtDisplay='.$txtDisplay.'&status=1&msg=Details Saved Successfully!!"</script>';
      }else
      {
        echo '<script>window.location = "exampointthird.php?courseid='.$courseid.'&semesterid='.$semesterid.'&txtDisplay='.$txtDisplay.'&status=0&msg=Sorry Something went Wrong!!"</script>';
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
      <li class="active"><?php echo $_GET["txtDisplay"]?></li>
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

                if (isset($_POST["btnUpdatestream"])) {

                  $viewsubjectid = $_POST["viewsubjectid"];
                  $courseid = $_POST["Updatecourseid"];
                  $semesterid = $_POST["Updatesemesterid"];
                  $txtDisplay =  $_POST["UpdatetxtDisplay"];
                  $UpdateShortname = $_POST["UpdateShortname"];

                  $updatequery = mysql_query("update tblsubjectlist set subjectname='$UpdateShortname' where subjectid='$viewsubjectid'");
                  if ($updatequery) {
                   echo '<script>window.location = "exampointthird.php?courseid='.$courseid.'&semesterid='.$semesterid.'&txtDisplay='.$txtDisplay.'&status=1&msg=Details Deleted Successfully!!"</script>'; 
                  }else{
                    echo '<script>window.location = "exampointthird.php?courseid='.$courseid.'&semesterid='.$semesterid.'&txtDisplay='.$txtDisplay.'&status=0&msg=Sorry Something went Wrong!!"</script>';
                  }
                }

                if (isset($_GET["viewsubjectid"])) {
                  $viewsubjectid = $_GET["viewsubjectid"];
                  $getdetails = mysql_query("select * from tblsubjectlist where subjectid='$viewsubjectid'");
                  $getdetailsrows = mysql_fetch_array($getdetails);
                  $subjectname = $getdetailsrows["subjectname"];
               ?>
                <div class="row-fluid">
                    <div class="span12">
                      <div class="span2">
                        <div class="control-group">
                          <label>Subject Name</label>
                          <input type="hidden" name="viewsubjectid" value="<?php echo $_GET["viewsubjectid"]?>">
                          <input type="hidden" name="Updatecourseid" value="<?php echo $_GET["courseid"]?>">
                          <input type="hidden" name="Updatesemesterid" value="<?php echo $_GET["semesterid"]?>">
                          <input type="hidden" name="UpdatetxtDisplay" value="<?php echo $_GET["txtDisplay"]?>">
                          <input type="text" style="width: 100%" class="form-control" name="UpdateShortname" id="UpdateShortname_0" placeholder="Eg: LABOUR LAW" value="<?php echo $subjectname?>">
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="row-fluid">
                    <button type="submit" id="btnUpdatestream" name="btnUpdatestream" class="btn btn-info">Submit Details</button>
                  </div>
                  <bR>
               <?php 
                }
              ?>

              <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="btn btn-primary btn-md" id="" name="" style="margin-top: -5px;">Add New Subject</a>
              <a href="exampointsecond.php?courseid=<?php echo $_GET["courseid"]?>" class="btn btn-success btn-md">Go Back</a>
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
                          <input type="text" style="width: 100%" class="form-control" name="Shortname" id="Shortname_0" placeholder="Eg: LABOUR LAW">
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
                  $getfaq = mysql_query("select * from tblsubjectlist where (subjectcourserefid='$courseid') and (subjectsemesterrefid='$semesterid')");
                  $getfaqcount = mysql_num_rows($getfaq);
                  if ($getfaqcount > 0) {
                  while($getfaqrows = mysql_fetch_array($getfaq)){
                ?>
                <div class="row-fluid">
                <div class="span3">
                    <a href="exampointforth.php?courseid=<?php echo $_GET["courseid"]?>&semesterid=<?php echo $_GET["semesterid"]?>&txtDisplay=<?php echo $_GET["txtDisplay"]?>&subjectid=<?php echo $getfaqrows["subjectid"]?>">
                      <div class="stat-block">
                        <ul>
                          <li class="stat-count" style="width: 100%;">
                            <span style="font-size: 13px"><?php echo $getfaqrows["subjectname"]?> </span>

                            <a href="exampointthird.php?courseid=<?php echo $_GET["courseid"]?>&semesterid=<?php echo $_GET["semesterid"]?>&txtDisplay=<?php echo $_GET["txtDisplay"]?>&delsubjectid=<?php echo $getfaqrows["subjectid"]?>" class="pull-right"> <span class="black-icons trashcan "></span></a>

                            <a href="exampointthird.php?courseid=<?php echo $_GET["courseid"]?>&semesterid=<?php echo $_GET["semesterid"]?>&txtDisplay=<?php echo $_GET["txtDisplay"]?>&viewsubjectid=<?php echo $getfaqrows["subjectid"]?>"> <span class="black-icons pencil pull-right"></span></a>
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