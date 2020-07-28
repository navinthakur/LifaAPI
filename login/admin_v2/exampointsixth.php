<?php include("header.php");?>
<?php
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

$qpid = $_GET["qpid"];
$getpattern = mysql_query("select * from tblquestionpatten where qpid='$qpid'");
$getpatternrows = mysql_fetch_assoc($getpattern);

$questionid = $_GET["questionid"];
$getquestion = mysql_query("select * from questionlist where questionid='$questionid'");
$getquestionrows = mysql_fetch_assoc($getquestion);




?>
<?php
    if (isset($_POST["btnsubmitstream"])) {
      $courseid = $_POST["courseid"];
      $semesterid =  $_POST["semesterid"];
      $txtDisplay = $_POST["txtDisplay"];
      $subjectid = $_POST["subjectid"];
      $qpid = $_POST["qpid"];
      $questionid = $_POST["questionid"];
      $questionfull = $_POST["questionfull"];
      $youtubelink = $_POST["youtubelink"];
      $fullanswer = $_POST["fullanswer"];
      $addeddate =date("Y-m-d");

      

       $PropertyQuery =  mysql_query("UPDATE `questionlist` SET `questionfull`='$questionfull',`fullanswer`='$fullanswer',`youtubelink`='$youtubelink' WHERE `questionid`='$questionid'");

       if ($PropertyQuery) {
          echo '<script>window.location = "exampointsixth.php?courseid='.$courseid.'&semesterid='.$semesterid.'&txtDisplay='.$txtDisplay.'&subjectid='.$subjectid.'&qpid='.$qpid.'&questionid='.$questionid.'&status=1&msg=Details Saved Successfully!!"</script>';
       }else{
        echo '<script>window.location = "exampointsixth.php?courseid='.$courseid.'&semesterid='.$semesterid.'&txtDisplay='.$txtDisplay.'&subjectid='.$subjectid.'&qpid='.$qpid.'&questionid='.$questionid.'&status=0&msg=Sorry Something went Wrong!!"</script>';
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
      <li><a href="#"><?php echo $subjectname?></a>
        <span class="divider">&raquo;</span>
      </li>
      <li class="active"><?php echo $getpatternrows["patterntitle"]?></li>
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
              <a href="exampointforth.php?courseid=<?php echo $_GET["courseid"]?>&semesterid=<?php echo $_GET["semesterid"]?>&txtDisplay=<?php echo $_GET["txtDisplay"]?>&subjectid=<?php echo $_GET["subjectid"]?>" class="btn btn-success">Go Back</a>
                
              <br>
              
              <div class="row-fluid">
                <form class="form-horizontal ucase" method="post" action="">
                  <fieldset>
                    <div class="control-group">
                      <label class="control-label" for="input01">Question</label>
                      <div class="controls">
                        <input type="hidden" name="courseid" value="<?php echo $_GET["courseid"]?>">
                        <input type="hidden" name="semesterid" value="<?php echo $_GET["semesterid"]?>">
                        <input type="hidden" name="txtDisplay" value="<?php echo $_GET["txtDisplay"]?>">
                        <input type="hidden" name="subjectid" value="<?php echo $_GET["subjectid"]?>">
                        <input type="hidden" name="qpid" value="<?php echo $_GET["qpid"]?>">
                        <input type="hidden" name="questionid" value="<?php echo $_GET["questionid"]?>">
                        <input type="text" name="questionfull"  class="input-xlarge text-tip" id="input01" title="" placeholder="Enter Question here.." value="<?php echo $getquestionrows["questionfull"]?>">
                      </div>
                    </div>

                    <div class="control-group">
                      <label class="control-label" for="input01">Youtube Video URL</label>
                      <div class="controls">
                        <input type="text" name="youtubelink" class="input-xlarge text-tip" id="input01" title="" placeholder="Youtube video Url.." value="<?php echo $getquestionrows["youtubelink"]?>">
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Answer</label>
                      <div class="controls">
                        <textarea id="post-editor" name="fullanswer" rows="10" cols="5" placeholder="Answer here..">
                          <?php echo $getquestionrows["fullanswer"]?>
                        </textarea>
                      </div>
                    </div>
                    
                    <div class="form-actions">
                      <button type="submit" name="btnsubmitstream" class="btn btn-success">Submit Question</button>
                    </div>
                  </fieldset>
                </form>
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