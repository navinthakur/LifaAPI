<?php include("header.php");?>
<?php

if (isset($_GET["delqpid"])) {

  $delqpid = $_GET["delqpid"];
  $courseid = $_GET["courseid"];
  $semesterid = $_GET["semesterid"];
  $txtDisplay =$_GET["txtDisplay"];
  $subjectid = $_GET["subjectid"];

  $delq = mysql_query("delete from tblquestionpatten where qpid='$delqpid'");

  if ($delq) {
    echo '<script>window.location = "exampointforth.php?courseid='.$courseid.'&semesterid='.$semesterid.'&txtDisplay='.$txtDisplay.'&subjectid='.$subjectid.'&status=1&msg=Details Deleted Successfully!!"</script>';
  }else{
    echo '<script>window.location = "exampointforth.php?courseid='.$courseid.'&semesterid='.$semesterid.'&txtDisplay='.$txtDisplay.'&subjectid='.$subjectid.'&status=0&msg=Sorry Something went Wrong!!"</script>';
  }
  # code...
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
      $patterntitle = $_POST["patterntitle"];
      $questionpatternmarks = $_POST["questionpatternmarks"];
      

       $PropertyQuery =  mysql_query("INSERT INTO `tblquestionpatten`(`patterntitle`, `questionpatternmarks`, `questionpatternsubjectrefid`, `questionpatternstatus`) VALUES ('$patterntitle','$questionpatternmarks','$subjectid','1')");
       if ($PropertyQuery) {
          echo '<script>window.location = "exampointforth.php?courseid='.$courseid.'&semesterid='.$semesterid.'&txtDisplay='.$txtDisplay.'&subjectid='.$subjectid.'&status=1&msg=Details Saved Successfully!!"</script>';
       }else{
        echo '<script>window.location = "exampointforth.php?courseid='.$courseid.'&semesterid='.$semesterid.'&txtDisplay='.$txtDisplay.'&subjectid='.$subjectid.'&status=0&msg=Sorry Something went Wrong!!"</script>';
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
                $viewqpid = $_POST["viewqpid"];
                $updatecourseid = $_POST["updatecourseid"];
                $updatesemesterid = $_POST["updatesemesterid"];
                $updatetxtDisplay = $_POST["updatetxtDisplay"];
                $updatesubjectid = $_POST["updatesubjectid"];
                $updatepatterntitle = $_POST["updatepatterntitle"];
                $updatequestionpatternmarks = $_POST["updatequestionpatternmarks"];


                $updatedetails = mysql_query("update tblquestionpatten set patterntitle='$updatepatterntitle',questionpatternmarks='$updatequestionpatternmarks' where qpid='$viewqpid'");

                if ($updatedetails) {
                   echo '<script>window.location = "exampointforth.php?courseid='.$updatecourseid.'&semesterid='.$updatesemesterid.'&txtDisplay='.$updatetxtDisplay.'&subjectid='.$updatesubjectid.'&status=1&msg=Details Updated Successfully!!"</script>';
                }else{
                  echo '<script>window.location = "exampointforth.php?courseid='.$updatecourseid.'&semesterid='.$updatesemesterid.'&txtDisplay='.$updatetxtDisplay.'&subjectid='.$updatesubjectid.'&status=0&msg=Sorry Something went Wrong!!"</script>';
                }

              }

                if (isset($_GET["viewqpid"])) {
                  $viewqpid= $_GET["viewqpid"];
                  $courseid = $_GET["courseid"];
                  $semesterid = $_GET["semesterid"];
                  $txtDisplay = $_GET["txtDisplay"];
                  $subjectid  =  $_GET["subjectid"];

                  $getdetails = mysql_query("select * from tblquestionpatten where qpid='$viewqpid'");
                  $getdetailsrows = mysql_fetch_array($getdetails);
                  $patterntitle = $getdetailsrows["patterntitle"];
                  $questionpatternmarks = $getdetailsrows["questionpatternmarks"];

                ?>
                <div class="row-fluid">
                    <div class="span12">
                      <div class="span6">
                        <div class="control-group">
                          <label>Queston Pattern</label>
                          <input type="hidden" name="viewqpid" value="<?php echo $_GET["viewqpid"]?>">
                          <input type="hidden" name="updatecourseid" value="<?php echo $_GET["courseid"]?>">
                          <input type="hidden" name="updatesemesterid" value="<?php echo $_GET["semesterid"]?>">
                          <input type="hidden" name="updatetxtDisplay" value="<?php echo $_GET["txtDisplay"]?>">
                          <input type="hidden" name="updatesubjectid" value="<?php echo $_GET["subjectid"]?>">
                          <input type="text" style="width: 100%" name="updatepatterntitle" id="updatepatterntitle_0" class="form-control updatepatterntitle" placeholder="Eg: Write Short Notes" value="<?php echo $patterntitle?>" >
                          </div>
                      </div>
                      <div class="span2">
                          <div class="control-group">
                            <label>Marks </label>
                             <input type="text" style="width: 100%" name="updatequestionpatternmarks" id="updatequestionpatternmarks_0" class="form-control updatequestionpatternmarks" placeholder="Eg: 20" value="<?php echo $questionpatternmarks?>">
                          </div>
                        </div>
                    </div>
                  </div>
                  <div class="row-fluid">
                    <button type="submit" id="btnupdatestream" name="btnupdatestream" class="btn btn-info">Submit Details</button>
                  </div>
                  <br><br>
               <?php   
                }
              ?>

              <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="btn btn-primary btn-md" id="" name="" style="margin-top: -5px;">Add Question Pattern</a>
              <a href="exampointthird.php?courseid=<?php echo $_GET["courseid"]?>&semesterid=<?php echo $_GET["semesterid"]?>&txtDisplay=<?php echo $_GET["txtDisplay"]?>" class="btn btn-success">Go Back</a>
                <div id="collapseOne" class="panel-collapse collapseOne collapse">
                <br>
                 <div class="row-fluid">
                    <div class="span12">
                      <div class="span6">
                        <div class="control-group">
                          <label>Queston Pattern</label>
                          <input type="hidden" name="courseid" value="<?php echo $_GET["courseid"]?>">
                          <input type="hidden" name="semesterid" value="<?php echo $_GET["semesterid"]?>">
                          <input type="hidden" name="txtDisplay" value="<?php echo $_GET["txtDisplay"]?>">
                          <input type="hidden" name="subjectid" value="<?php echo $_GET["subjectid"]?>">
                          <input type="text" style="width: 100%" name="patterntitle" id="patterntitle_0" class="form-control patterntitle" placeholder="Eg: Write Short Notes">
                          </div>
                      </div>
                      <div class="span2">
                          <div class="control-group">
                            <label>Marks </label>
                             <input type="text" style="width: 100%" name="questionpatternmarks" id="questionpatternmarks_0" class="form-control questionpatternmarks" placeholder="Eg: 20">
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
                  $count = 1;
                  $getfaq = mysql_query("select * from tblquestionpatten where (questionpatternsubjectrefid='$subjectid')");
                  $getfaqcount = mysql_num_rows($getfaq);
                  if ($getfaqcount > 0) {
                  while($getfaqrows = mysql_fetch_array($getfaq)){
                    $qpid = $getfaqrows["qpid"];
                    $getquecount = mysql_query("select count(*) as quescount from questionlist where refpatternid='$qpid'");
                    $getquecountrows = mysql_fetch_array($getquecount);
                ?>
                <div class="row-fluid">
                <div class="span3">
                    <a href="exampointfifth.php?courseid=<?php echo $_GET["courseid"]?>&semesterid=<?php echo $_GET["semesterid"]?>&txtDisplay=<?php echo $_GET["txtDisplay"]?>&subjectid=<?php echo $subjectid?>&qpid=<?php echo $getfaqrows["qpid"]?>">
                      <div class="stat-block">
                        <ul>
                          <li class="stat-count" style="width: 100%;">
                          <span>Q.<?php echo $count++?> <?php echo $getfaqrows["patterntitle"]?> </span>
                          <span style="margin-left: 20px"><?php echo $getfaqrows["questionpatternmarks"]?> Marks</span>
                          <span style="margin-left: 20px">No of Question : <?php echo $getquecountrows["quescount"]?> </span>
                          <a href="exampointforth.php?courseid=<?php echo $_GET["courseid"]?>&semesterid=<?php echo $_GET["semesterid"]?>&txtDisplay=<?php echo $_GET["txtDisplay"]?>&subjectid=<?php echo $subjectid?>&delqpid=<?php echo $getfaqrows["qpid"]?>" class="pull-right"> <span class="black-icons trashcan "></span></a>


                            <a href="exampointforth.php?courseid=<?php echo $_GET["courseid"]?>&semesterid=<?php echo $_GET["semesterid"]?>&txtDisplay=<?php echo $_GET["txtDisplay"]?>&subjectid=<?php echo $subjectid?>&viewqpid=<?php echo $getfaqrows["qpid"]?>" class="pull-right"> <span class="black-icons pencil"></span></a>

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