<?php include("header.php");?>
<?php
  if (isset($_GET["del"])) {
    $courseid = $_GET["courseid"];
    $semesterid = $_GET["del"];
    $delq = mysql_query("delete from tblsemesterlist where semesterid='$semesterid'");
    if ($delq) {
      echo '<script>window.location = "exampointsecond.php?courseid='.$courseid.'&status=1&msg=Details Deleted Successfully!!"</script>';
    }else{
      echo '<script>window.location = "exampointsecond.php?courseid='.$courseid.'&status=0&msg=Sorry Something went Wrong!!"</script>';
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
    $Shortname= $_POST["Shortname"];
    for($i = 0; $i < $Shortname; $i++){
      $addsemester = mysql_query("INSERT INTO `tblsemesterlist`(`semestername`, `semesterimage`, `courserefid`, `semesterstatus`) VALUES ('Semester','images/subcategory.jpg','$courseid','1')");
    }
    if ($addsemester) {
      echo '<script>window.location = "exampointsecond.php?courseid='.$courseid.'&status=1&msg=Details Saved Successfully!!"</script>';
    }else{
      echo '<script>window.location = "exampointsecond.php?courseid='.$courseid.'&status=0&msg=Sorry Something went Wrong!!"</script>';
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
      <li><a href="#">Home</a><span class="divider">&raquo;</span></li>
      <li class="active"><?php echo $coursename?></li>
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
              <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="btn btn-primary btn-md" id="" name="" style="margin-top: -5px;">Add New Semester</a>
              <a href="exampointfirst.php" class="btn btn-success btn-md">Go Back</a>

              <div id="collapseOne" class="panel-collapse collapseOne collapse">
                <br>
                 <div class="row-fluid">
                    <div class="span12">
                      <div class="span2">
                        <div class="control-group">
                          <label>No of Semester to be added</label>
                          <input type="hidden" name="courseid" value="<?php echo $_GET["courseid"]?>">
                          <input type="text" style="width: 100%" class="form-control" name="Shortname" id="Shortname_0" placeholder="Eg: 4">
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
                  $count = 1;
                  $getfaq = mysql_query("select * from tblsemesterlist where courserefid='$courseid'");
                  $getfaqcount = mysql_num_rows($getfaq);
                  if ($getfaqcount > 0) {
                    
                  while($getfaqrows = mysql_fetch_array($getfaq)){
                ?>
                <div class="row-fluid">
                <div class="span3">
                    <a href="exampointthird.php?courseid=<?php echo $_GET["courseid"]?>&semesterid=<?php echo $getfaqrows["semesterid"]?>&txtDisplay=<?php echo $getfaqrows["semestername"]?> <?php echo $count?>">
                      <div class="stat-block">
                        <ul>
                          <li class="stat-count" style="width: 100%">
                            <span><?php echo $getfaqrows["semestername"]?> <?php echo $count?>  <a href="exampointsecond.php?del=<?php echo $getfaqrows["semesterid"]?>&courseid=<?php echo $_GET["courseid"]?>" class="pull-right"> <span class="black-icons trashcan "></span></a> </span>

                          </li>                      
                        </ul>
                      </div>
                    </a>
                </div>
              </div>
                <?php
                $count++;
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