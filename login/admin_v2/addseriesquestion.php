<?php include("header.php");?>
  <?php

  if (isset($_GET["view"])) {
    $seriesid = $_GET["view"];
    $getdetails = mysql_query("select * from tbltestseries where seriesid='$seriesid'");
    $getdetailsrows = mysql_fetch_assoc($getdetails);
    $seriesuniqueid = $getdetailsrows["seriesuniqueid"];

  }

    if (isset($_POST["btnaddquestion"])) {

      date_default_timezone_set("Asia/Kolkata");
      $seriesid = $_POST["seriesid"];
      $serquestion = $_POST["serquestion"];
      $serquestionhindi = $_POST["serquestionhindi"];
      $serfirstoption = $_POST["serfirstoption"];
      $sersecondoption = $_POST["sersecondoption"];
      $serthirdoption = $_POST["serthirdoption"];
      $serforthoption = $_POST["serforthoption"];
      $sercorrectanswer = $_POST["sercorrectanswer"];
      $serquestiontime = $_POST["serquestiontime"];
      $serquestiontimeformat = $_POST["serquestiontimeformat"];
      $serquestionadded = date("d-m-Y H:i:s");

      
      $testseries = mysql_query("INSERT INTO `tblseriesquestion`(`serrefid`, `serquestion`,`serquestionhindi`, `serfirstoption`, `sersecondoption`, `serthirdoption`, `serforthoption`, `sercorrectanswer`,`serquestiontime`,`serquestiontimeformat`, `serquestionadded`) VALUES ('$seriesid','$serquestion','$serquestionhindi','$serfirstoption','$sersecondoption','$serthirdoption','$serforthoption','$sercorrectanswer','$serquestiontime','$serquestiontimeformat','$serquestionadded')");

      if ($testseries) {
        echo '<script>window.location = "addseriesquestion.php?view='.$seriesid.'&status=1&msg=Details Saved Successfully!!"</script>';
      }else{
        echo '<script>window.location = "addseriesquestion.php?view='.$seriesid.'&status=0&msg=Sorry Something went Wrong!!"</script>';
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

 <form class="well" style="background: #ffffff" method="post" action="">

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
              ?>
              
          <div class="widget-content">
            <div class="widget-box">
              <div class="page-header">
                <h1><span class="label label-success" style="font-size: 24.844px">+</span> Add New Question</h1>
              </div>
              <div class="row-fluid">
                <div class="span12">
                  <div class="span3">
                    <div class="control-group">
                      <label>Question Time</label>
                      <input type="text" name="serquestiontime" placeholder="Ex: 10"/>
                    </div>
                  </div>

                  <div class="span3">
                    <div class="control-group">
                      <label>Question Time Format</label>
                      <select class="serquestiontimeformat" id="serquestiontimeformat" name="serquestiontimeformat">
                        <option value="">Select Time Format</option>
                        <option value="Seconds">Seconds</option>
                        <option value="Minutes">Minutes</option>
                        <option value="Hours">Hours</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row-fluid" style="text-align: center;">
                <div class="span9">
                  <div class="control-group">
                    <div class="controls">
                      <div class="input-prepend">
                        <span class="add-on" style="padding: 9px;font-size: 25px">Q.</span>
                        <input type="hidden" name="seriesid" value="<?php echo $_GET["view"]?>">
                        <input type="text" size="16" style="height: 30px;font-size: 15px;width: 100%" id="prependedInput" class="" name="serquestion" id="serquestion" placeholder="Enter Question here.."  >
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row-fluid" style="text-align: center;">
                <div class="span9">
                  <div class="control-group">
                    <div class="controls">
                      <div class="input-prepend">
                        <span class="add-on" style="padding: 9px;font-size: 25px">Q.</span>
                        <input type="text" size="16" style="height: 30px;font-size: 15px;width: 100%" id="prependedInput" class="" name="serquestionhindi" id="serquestionhindi" placeholder="Enter Question in Hindi here.."  >
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <br>
              <div class="row-fluid" style="">
                <div class="row-fluid">
                  <div class="span12">
                    <div class="span6">
                      <div class="control-group">
                        <div class="controls">
                          <div class="input-prepend">
                            <span class="add-on" style="padding: 9px;background-color: #9788ef;color:#ffffff;font-size: 25px">A.</span>
                            <input type="text" size="16" style="height: 30px;font-size: 15px;" id="prependedInput" class="" name="serfirstoption" placeholder="OPTION A" >
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="span6">
                      <div class="control-group">
                        <div class="controls">
                          <div class="input-prepend">
                            <span class="add-on" style="padding: 9px;background-color: #f76854;color:#ffffff;font-size: 25px">B.</span>
                            <input type="text" size="16" style="height: 30px;font-size: 15px;" id="prependedInput" class="" name="sersecondoption" placeholder="OPTION B">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row-fluid">
                  <div class="span12">
                    <div class="span6">
                      <div class="control-group">
                        <div class="controls">
                          <div class="input-prepend">
                            <span class="add-on" style="padding: 9px;background-color: #ffbd4f;color:#ffffff;font-size: 25px">C.</span>
                            <input type="text" size="16" style="height: 30px;font-size: 15px;" id="prependedInput" class="" name="serthirdoption" placeholder="OPTION C" >
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="span6">
                      <div class="control-group">
                        <div class="controls">
                          <div class="input-prepend">
                            <span class="add-on" style="padding: 9px;background-color: #40c5c2;color:#ffffff;font-size: 25px">D.</span>
                            <input type="text" size="16" style="height: 30px;font-size: 15px;" id="prependedInput" class="" name="serforthoption" placeholder="OPTION D">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <br>
              <div class="row-fluid">
                <div class="span5">
                  <label>Correct Answer</label>
                  <select name="sercorrectanswer" id="">
                    <option value="">Select Correct answer</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                  </select>
                </div>
              </div>

              <div class="row-fluid">
                <div class="span5"></div>
                <button type="submit" name="btnaddquestion" class="btn btn-info">Submit & Add Another</button>
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