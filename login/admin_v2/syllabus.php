<?php include("header.php");?>
<?php
  if (isset($_GET["del"])) {
    $courseid = $_GET["del"];
    $delq = mysql_query("delete from courselist where courseid='$courseid'");
    if ($delq) {
      echo '<script>window.location = "syllabus.php?status=1&msg=Details Deleted Successfully!!"</script>';
    }else{
      echo '<script>window.location = "syllabus.php?status=0&msg=Sorry Something went Wrong!!"</script>';
    }
  }
    if (isset($_POST["btnsubmitstream"])) {
      $Shortname = $_POST["Shortname"];
      $StreamName = $_POST["StreamName"];
      $CourseYear = $_POST["CourseYear"];

      $streamquery = mysql_query("INSERT INTO `courselist`(`coursename`, `coursefullform`, `courseyear`, `coursestatus`) VALUES ('$Shortname','$StreamName','$CourseYear','1')");
      if ($streamquery) {
         echo '<script>window.location = "syllabus.php?status=1&msg=Details Saved Successfully!!"</script>';
      }else{
        echo '<script>window.location = "syllabus.php?status=0&msg=Sorry Something went Wrong!!"</script>';
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
      <li class="active">Syllabus</li>
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
                if (isset($_POST["btnUpdateStream"])) {
                  $courseid = $_POST["courseid"];
                  $UpdateShortname = $_POST["UpdateShortname"];
                  $UpdateStreamName = $_POST["UpdateStreamName"];
                  $UpdateCourseYear =$_POST["UpdateCourseYear"];

                  $updatestreamquery = mysql_query("UPDATE `courselist` SET `coursename`='$UpdateShortname',`coursefullform`='$UpdateStreamName',`courseyear`='$UpdateCourseYear' WHERE `courseid`='$courseid'");
                  if ($updatestreamquery) {
                     echo '<script>window.location = "syllabus.php?status=1&msg=Details Updated Successfully!!"</script>';
                  }else{
                    echo '<script>window.location = "syllabus.php?status=0&msg=Sorry Something went Wrong!!"</script>';
                  }


                }
                if (isset($_GET["view"])) {
                    $courseid =$_GET["view"];
                    $getdetails = mysql_query("select * from courselist where courseid='$courseid'");
                    $getdetailsrows = mysql_fetch_assoc($getdetails);
                    $coursename = $getdetailsrows["coursename"];
                    $coursefullform = $getdetailsrows["coursefullform"];
                    $courseyear = $getdetailsrows["courseyear"];

                 ?>
                 <div class="row-fluid">
                    <div class="span12">
                      <div class="span2">
                        <div class="control-group">
                          <label>Short Name</label>
                          <input type="hidden" name="courseid" value="<?php echo $_GET["view"]?>">
                          <input type="text" style="width: 100%" class="form-control" name="UpdateShortname" id="UpdateShortname_0" placeholder="Eg: BLS" value="<?php echo $coursename?>">
                          </div>
                      </div>

                      <div class="span6">
                        <div class="control-group">
                          <label>Stream Full Name</label>
                          <input type="text" style="width: 100%" class="form-control" name="UpdateStreamName" id="UpdateStreamName_0" placeholder="Eg: BACHELOR OF LEGAL SCIENCE" value="<?php echo $coursefullform?>">
                          </div>
                      </div>

                      <div class="span3">
                        <div class="control-group">
                          <label>Course Year</label>
                          <input type="text" style="width: 100%" class="form-control" name="UpdateCourseYear" id="UpdateCourseYear_0" placeholder="Eg: 5 Years" value="<?php echo $courseyear?>">
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="row-fluid">
                    <div class="span5"></div>
                    <button type="submit" id="btnUpdateStream" name="btnUpdateStream" class="btn btn-info">Submit Details</button>
                  </div>
                  <br>
                 <?php 
                    }
                  ?>


              <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="btn btn-primary btn-md" id="" name="" style="margin-top: -5px;">Add New Stream</a>
              <a href="college.php" class="btn btn-success btn-md">Go Back</a>

               <div id="collapseOne" class="panel-collapse collapseOne collapse">
                <br>
                 <div class="row-fluid">
                    <div class="span12">
                      <div class="span2">
                        <div class="control-group">
                          <label>Short Name</label>
                          <input type="text" style="width: 100%" class="form-control" name="Shortname" id="Shortname_0" placeholder="Eg: BLS">
                          </div>
                      </div>

                      <div class="span6">
                        <div class="control-group">
                          <label>Stream Full Name</label>
                          <input type="text" style="width: 100%" class="form-control" name="StreamName" id="StreamName_0" placeholder="Eg: BACHELOR OF LEGAL SCIENCE">
                          </div>
                      </div>

                      <div class="span3">
                        <div class="control-group">
                          <label>Course Year</label>
                          <input type="text" style="width: 100%" class="form-control" name="CourseYear" id="CourseYear_0" placeholder="Eg: 5 Years">
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="row-fluid">
                    <div class="span5"></div>
                    <button type="submit" id="btnsubmitstream" name="btnsubmitstream" class="btn btn-info">Submit Details</button>
                  </div>
               </div>
              <br>
              <div class="row-fluid">
                <?php
                  $getfaq = mysql_query("select * from courselist");
                  while($getfaqrows = mysql_fetch_array($getfaq)){
                ?>
                <div class="row-fluid">
                <div class="span5">
                    <a href="showsemesterlist.php?courseid=<?php echo $getfaqrows["courseid"]?>">
                      <div class="stat-block">
                        <ul>
                          <li class="stat-count" style="width: 100%">
                            <span><?php echo $getfaqrows["coursefullform"]?> <b style="font-weight: 900">( <?php echo $getfaqrows["coursename"]?> )</b></span>
                            
                            <span>
                              <b>Course: </b><?php echo $getfaqrows["courseyear"]?>
                              <a href="syllabus.php?del=<?php echo $getfaqrows["courseid"]?>"> <span class="black-icons trashcan pull-right"></span></a>
                              <a href="syllabus.php?view=<?php echo $getfaqrows["courseid"]?>"> <span class="black-icons pencil pull-right"></span></a>
                                
                            </span>
                          </li>                      
                        </ul>
                      </div>
                    </a>
                </div>
              </div>
                <?php
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