<?php include("header.php");?>
  <?php

  if (isset($_GET["view"])) {
    $seriesid = $_GET["view"];
    $getdetails = mysql_query("select * from tbltestseries where seriesid='$seriesid'");
    $getdetailsrows = mysql_fetch_assoc($getdetails);
    $seriessection = $getdetailsrows["seriessection"];
    $seriessectionheading = $getdetailsrows["seriessectionheading"];
    $seriesexamtime = $getdetailsrows["seriesexamtime"];
    $seriesexamtimeformat = $getdetailsrows["seriesexamtimeformat"];
    if ($seriesexamtimeformat == "" || $seriesexamtimeformat == null) {
      $notimeformat = 'selected';
      $secondsformat = '';
      $minuteformat = '';
      $hourformat = '';
    }
    else if ($seriesexamtimeformat == "Seconds") {
      $notimeformat = '';
      $secondsformat = 'selected';
      $minuteformat = '';
      $hourformat = '';
    }
    else if ($seriesexamtimeformat == "Minutes") {
      $notimeformat = '';
      $secondsformat = '';
      $minuteformat = 'selected';
      $hourformat = '';
    }
    else if ($seriesexamtimeformat == "Hours") {
      $notimeformat = '';
      $secondsformat = '';
      $minuteformat = '';
      $hourformat = 'selected';
    }
    $seriestotalquestions = $getdetailsrows["seriestotalquestions"];
    $seriesastarmarks = $getdetailsrows["seriesastarmarks"];
    $seriesinstructions = $getdetailsrows["seriesinstructions"];

  }

    if (isset($_POST["btnsubmitstream"])) {

      $seriesid = $_POST["seriesid"];
      $SeriesSection = $_POST["SeriesSection"];
      $SeriesHeading = $_POST["SeriesHeading"];
      $ExamTime = $_POST["ExamTime"];
      $ExamTimeFormat = $_POST["ExamTimeFormat"];
      $TotalQuestions = $_POST["TotalQuestions"];
      $AStarMarks = $_POST["AStarMarks"];
      $ExamInstruction = $_POST["ExamInstruction"];
      
      $testseries = mysql_query("UPDATE `tbltestseries` SET `seriessection`='$SeriesSection',`seriessectionheading`='$SeriesHeading',`seriesexamtime`='$ExamTime',`seriesexamtimeformat`='$ExamTimeFormat',`seriestotalquestions`='$TotalQuestions',`seriesastarmarks`='$AStarMarks',`seriesinstructions`='$ExamInstruction' WHERE `seriesid`='$seriesid'");

      if ($testseries) {
        echo '<script>window.location = "testseriesdetails.php?view='.$seriesid.'&status=1&msg=Details Saved Successfully!!"</script>';
      }else{
        echo '<script>window.location = "testseriesdetails.php?view='.$seriesid.'&status=0&msg=Sorry Something went Wrong!!"</script>';
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
              <div class="row-fluid">
                    <div class="span12">
                      <div class="span3">
                        <div class="control-group">
                          <label>Section</label>
                          <input type="hidden" name="seriesid" value="<?php echO $_GET["view"]?>">
                          <input type="text" style="width: 100%" class="form-control SeriesSection" name="SeriesSection" id="SeriesSection_0" placeholder="Eg: Mathematics" value="<?php echo $seriessection?>">
                          </div>
                      </div>
                      <div class="span3">
                        <div class="control-group">
                          <label>Heading</label>
                          <input type="text" style="width: 100%" class="form-control SeriesHeading" name="SeriesHeading" id="SeriesHeading_0" placeholder="Eg: Algorithims" value="<?php echo $seriessectionheading?>">
                          </div>
                      </div>
                      <div class="span3">
                        <div class="control-group">
                          <label>Exam Time</label>
                          <input type="text" style="width: 100%" class="form-control ExamTime" name="ExamTime" id="ExamTime_0" placeholder="Eg: 10" value="<?php echo $seriesexamtime?>">
                          </div>
                      </div>
                      <div class="span3">
                        <div class="control-group">
                          <label>Exam Time Format</label>
                          <select class="ExamTimeFormat" id="ExamTimeFormat" name="ExamTimeFormat">
                            <option value="" <?php echo $notimeformat?>>Select Time Format</option>
                            <option value="Seconds" <?php echo $secondsformat ?> >Seconds</option>
                            <option value="Minutes" <?php echo $minuteformat ?> >Minutes</option>
                            <option value="Hours" <?php echo $hourformat ?> >Hours</option>
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
                          <input type="text" name="TotalQuestions" id="TotalQuestions" value="<?php echo $seriestotalquestions?>" placeholder="Eg: 10" />
                        </div>
                      </div>
                      <div class="span3">
                        <div class="control-group">
                          <label>A * Marks</label>
                          <input type="text" name="AStarMarks" id="AStarMarks" value="<?php echo $seriesastarmarks?>" placeholder="Eg: 10" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row-fluid">
                    <div class="span12">
                      <div class="control-group">
                        <label>Instructions</label>
                        <textarea id="post-editor" name="ExamInstruction" id="ExamInstruction" rows="10" cols="5">
                          <?php echo $seriesinstructions?>
                        </textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row-fluid">
                    <div class="span5"></div>
                    <button type="submit" id="btnsubmitstream" name="btnsubmitstream" class="btn btn-info">Submit Details</button>
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