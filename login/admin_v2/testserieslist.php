<?php include("header.php");?>
  <?php

  if (isset($_GET["del"])) {
    $seriesid = $_GET["del"];
    $delquery = mysql_query("delete from tbltestseries where seriesid='$seriesid'");
    if ($delquery) {
       echo '<script>window.location = "testserieslist.php?status=1&msg=Details Deleted Successfully!!"</script>';
    }else{
       echo '<script>window.location = "testserieslist.php?status=0&msg=Sorry Something went Wrong!!"</script>';
    }
  }

    if (isset($_POST["btnsubmitstream"])) {
      date_default_timezone_set("Asia/Kolkata");
      $seriesuniqueid = mt_rand(000000,999999);
      $SeriesSection = $_POST["SeriesSection"];
      $SeriesHeading = $_POST["SeriesHeading"];
      $ExamTime = $_POST["ExamTime"];
      $ExamTimeFormat = $_POST["ExamTimeFormat"];
      $TotalQuestions = $_POST["TotalQuestions"];
      $AStarMarks = $_POST["AStarMarks"];
      $ExamInstruction = $_POST["ExamInstruction"];
      $seriesaddedate = date("d-m-Y H:i:s");
      $seriesdatesearch = date("Y-m-d");

      $testseries = mysql_query("INSERT INTO `tbltestseries`(`seriesuniqueid`, `seriessection`, `seriessectionheading`, `seriesexamtime`, `seriesexamtimeformat`, `seriestotalquestions`, `seriesastarmarks`, `seriesinstructions`, `seriestatus`, `seriesaddedate`, `seriesdatesearch`) VALUES ('$seriesuniqueid','$SeriesSection','$SeriesHeading','$ExamTime','$ExamTimeFormat','$TotalQuestions','$AStarMarks','$ExamInstruction','1','$seriesaddedate','$seriesdatesearch')");

      if ($testseries) {
        echo '<script>window.location = "testserieslist.php?status=1&msg=Details Saved Successfully!!"</script>';
      }else{
        echo '<script>window.location = "testserieslist.php?status=0&msg=Sorry Something went Wrong!!"</script>';
      }
    }
  ?>
    <style type="text/css">
      tr.odd td.sorting_1
      {
        background: #ffffff;
      }
      .breadcrumb
      {
        padding: 11px 14px;
      }
    </style>
<div id="main-content">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li><a href="#">Home</a><span class="divider">&raquo;</span></li>
      <li class="active">Test Series</li>
    </ul>

 <form class="form-horizontal well" style="background: #ffffff" method="post" action="">

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
              <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="btn btn-primary btn-md" id="" name="" style="margin-top: -5px;">Add New Series</a>
              <a href="clattutorialsmain.php" class="btn btn-success btn-md">Go Back</a>

               <div id="collapseOne" class="panel-collapse collapseOne collapse">
                <br>
                 <div class="row-fluid">
                    <div class="span12">
                      <div class="span3">
                        <div class="control-group">
                          <label>Section</label>
                          <input type="text" style="width: 100%" class="form-control SeriesSection" name="SeriesSection" id="SeriesSection_0" placeholder="Eg: Mathematics">
                          </div>
                      </div>
                      <div class="span3">
                        <div class="control-group">
                          <label>Heading</label>
                          <input type="text" style="width: 100%" class="form-control SeriesHeading" name="SeriesHeading" id="SeriesHeading_0" placeholder="Eg: Algorithims">
                          </div>
                      </div>
                      <div class="span3">
                        <div class="control-group">
                          <label>Exam Time</label>
                          <input type="text" style="width: 100%" class="form-control ExamTime" name="ExamTime" id="ExamTime_0" placeholder="Eg: 10">
                          </div>
                      </div>
                      <div class="span3">
                        <div class="control-group">
                          <label>Exam Time Format</label>
                          <select class="ExamTimeFormat" id="ExamTimeFormat" name="ExamTimeFormat">
                            <option value="">Select Time Format</option>
                            <option value="Seconds">Seconds</option>
                            <option value="Minutes">Minutes</option>
                            <option value="Hours">Hours</option>
                          </select>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="row-fluid">
                    <div class="span12">
                      <div class="span3">
                        <div class="control-group">
                          <label>Total Question</label>
                          <input type="text" name="TotalQuestions" id="TotalQuestions" value="" placeholder="Eg: 10" />
                        </div>
                      </div>
                      <div class="span3">
                        <div class="control-group">
                          <label>A * Marks</label>
                          <input type="text" name="AStarMarks" id="AStarMarks" value="" placeholder="Eg: 10" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row-fluid">
                    <div class="span12">
                      <div class="control-group">
                        <label>Instructions</label>
                        <textarea id="post-editor" name="ExamInstruction" id="ExamInstruction" rows="10" cols="5"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row-fluid">
                    <div class="span5"></div>
                    <button type="submit" id="btnsubmitstream" name="btnsubmitstream" class="btn btn-info">Submit Details</button>
                  </div>
               </div>
              <br>
              <table class="table table-bordered text-center data-tbl-inbox">
                <thead>
                  <tr>
                    <th class="center">SrNo</th>
                    <th class="center">Section</th>
                    <th class="center">Heading</th>
                    <th class="center">Duration</th>
                    <th class="center">Total Questions</th>
                    <th class="center">A * Marks</th>
                    <th class="center">Added Date</th>
                    <th class="center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $count = 1;
                    $gettestseries = mysql_query("SELECT * FROM `tbltestseries` order by seriesid desc");
                    while($gettestseriesrows = mysql_fetch_array($gettestseries)){

                      $seriesid = $gettestseriesrows["seriesid"];
                      $getquestioncount = mysql_query("select count(*) as quecount from tblseriesquestion where serrefid='$seriesid'");
                      $getquestioncountrows = mysql_fetch_assoc($getquestioncount);
                  ?>
                  <tr>
                    <td class="center"><?php echo $count++?></td>
                    <td class="center"><a href="testseriesdetails.php?view=<?php echo $gettestseriesrows["seriesid"]?>" target="_blank"><?php echO $gettestseriesrows["seriessection"]?></a></td>
                    <td class="center"><?php echO $gettestseriesrows["seriessectionheading"]?></td>
                    <td class="center"><?php echO $gettestseriesrows["seriesexamtime"]?> <?php echO $gettestseriesrows["seriesexamtimeformat"]?></td>
                    <td class="center"><?php echO $getquestioncountrows["quecount"]?></td>
                    <td class="center"><?php echO $gettestseriesrows["seriesastarmarks"]?></td>
                    <td class="center"><?php echO $gettestseriesrows["seriesaddedate"]?></td>
                    <td class="">
                      <div class="btn-group pull-right">
                        <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-cog"></i><span class="caret"></span></button>
                        <ul class="dropdown-menu">
                          <li><a href="testseriesdetails.php?view=<?php echo $gettestseriesrows["seriesid"]?>" target="_blank"><i class="icon-file"></i> View/Edit Details</a></li>
                          <li><a href="addseriesquestion.php?view=<?php echo $gettestseriesrows["seriesid"]?>" target="_blank"><i class="icon-file"></i> Add Question </a></li>
                          <li><a href="testserieslist.php?del=<?php echo $gettestseriesrows["seriesid"]?>"><i class="icon-trash"></i> Remove Series</a></li>
                        </ul>
                      </div>
                    </td>
                  </tr>
                  <?php
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </form>
  </div>
</div>
<?php include("footer.php");?>