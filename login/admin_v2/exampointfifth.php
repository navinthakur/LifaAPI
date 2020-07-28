<?php include("header.php");?>
<?php
if (isset($_GET["questionid"])) {
  $questionid = $_GET["questionid"];
  $qpid = $_GET["qpid"];
  $courseid = $_GET["courseid"];
  $semesterid = $_GET["semesterid"];
  $txtDisplay =$_GET["txtDisplay"];
  $subjectid = $_GET["subjectid"];

  $delq = mysql_query("delete from questionlist where questionid='$questionid'");

  if ($delq) {
    echo '<script>window.location = "exampointfifth.php?courseid='.$courseid.'&semesterid='.$semesterid.'&txtDisplay='.$txtDisplay.'&subjectid='.$subjectid.'&qpid='.$qpid.'&status=1&msg=Details Deleted Successfully!!"</script>';
  }else{
    echo '<script>window.location = "exampointfifth.php?courseid='.$courseid.'&semesterid='.$semesterid.'&txtDisplay='.$txtDisplay.'&subjectid='.$subjectid.'&qpid='.$qpid.'&status=0&msg=Sorry Something went Wrong!!"</script>';
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

$qpid = $_GET["qpid"];
$getpattern = mysql_query("select * from tblquestionpatten where qpid='$qpid'");
$getpatternrows = mysql_fetch_assoc($getpattern);



?>
<?php
    if (isset($_POST["btnsubmitstream"])) {
      $courseid = $_POST["courseid"];
      $semesterid =  $_POST["semesterid"];
      $txtDisplay = $_POST["txtDisplay"];
      $subjectid = $_POST["subjectid"];
      $qpid = $_POST["qpid"];
      $questionfull = $_POST["questionfull"];
      $youtubelink = $_POST["youtubelink"];
      $fullanswer = $_POST["fullanswer"];
      $addeddate =date("Y-m-d");

      

       $PropertyQuery =  mysql_query("INSERT INTO `questionlist`(`questiontype`, `questionfull`, `optionone`, `optiontwo`, `optionthree`, `optionfour`, `correctanswer`, `fullanswer`,`youtubelink`, `questionyear`, `refcourseid`, `refsemesterid`, `refsubjectid`, `refpatternid`, `addeddate`) VALUES ('faq','$questionfull','','','','','','$fullanswer','$youtubelink','','$courseid','$semesterid','$subjectid',$qpid,'$addeddate')");

       if ($PropertyQuery) {
          echo '<script>window.location = "exampointfifth.php?courseid='.$courseid.'&semesterid='.$semesterid.'&txtDisplay='.$txtDisplay.'&subjectid='.$subjectid.'&qpid='.$qpid.'&status=1&msg=Details Saved Successfully!!"</script>';
       }else{
        echo '<script>window.location = "exampointforth.php?courseid='.$courseid.'&semesterid='.$semesterid.'&txtDisplay='.$txtDisplay.'&subjectid='.$subjectid.'&qpid='.$qpid.'&status=0&msg=Sorry Something went Wrong!!"</script>';
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
              <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="btn btn-primary btn-md" id="" name="" style="margin-top: -5px;">Add Question</a>
              <a href="exampointforth.php?courseid=<?php echo $_GET["courseid"]?>&semesterid=<?php echo $_GET["semesterid"]?>&txtDisplay=<?php echo $_GET["txtDisplay"]?>&subjectid=<?php echo $_GET["subjectid"]?>" class="btn btn-success">Go Back</a>
                <div id="collapseOne" class="panel-collapse collapseOne collapse">
                <br>
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
                        <input type="text" name="questionfull"  class="input-xlarge text-tip" id="input01" title="Enter Question here..">
                      </div>
                    </div>

                    <div class="control-group">
                      <label class="control-label" for="input01">Youtube Video URL</label>
                      <div class="controls">
                        <input type="text" name="youtubelink" class="input-xlarge text-tip" id="input01" title="Youtube video Url..">
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Answer</label>
                      <div class="controls">
                        <textarea id="post-editor" name="fullanswer" rows="10" cols="5"></textarea>
                      </div>
                    </div>
                    
                    <div class="form-actions">
                      <button type="submit" name="btnsubmitstream" class="btn btn-success">Submit Question</button>
                    </div>
                  </fieldset>
                </form>
               </div>
              <br>
              <style type="text/css">
                .additionalclass li{
                  float: none !important;
                  margin-left: 30px;
                }
              </style>
              <div class="row-fluid">
                <?php
                  $courseid = $_GET["courseid"];
                  $semesterid= $_GET["semesterid"];
                  $subjectid = $_GET["subjectid"];
                  $qpid = $_GET["qpid"];
                  $count = 1;
                  $getfaq = mysql_query("select * from questionlist where (refpatternid='$qpid')");
                  $getfaqcount = mysql_num_rows($getfaq);
                  if ($getfaqcount > 0) {
                  while($getfaqrows = mysql_fetch_array($getfaq)){
                ?>
                <div class="row-fluid">
                  <div class="span6">
                      <a href="exampointsixth.php?questionid=<?php echo $getfaqrows["questionid"]?>&courseid=<?php echo $_GET["courseid"]?>&semesterid=<?php echo $_GET["semesterid"]?>&txtDisplay=<?php echo $_GET["txtDisplay"]?>&subjectid=<?php echo $subjectid?>&qpid=<?php echo $_GET["qpid"]?>">
                        <div class="stat-block">
                          <ul>
                            <li class="stat-count" style="width: 100%;">
                            <span>Q.<?php echo $count++?> <?php echo $getfaqrows["questionfull"]?> </span>
                          </li>                      
                          </ul>
                          <ul>
                            <li class="stat-count" style="width: 100%;">
                            
                              <span>Answer Status: </span>
                              <span class="additionalclass">
                                <?php
                                  $fullanswer = $getfaqrows["fullanswer"];
                                  if ($fullanswer == "" || $fullanswer == null) {
                                    $fullanswer = 'No Answer added';
                                  }else{
                                    $fullanswer = 'Answer Available';
                                  }
                                  echo $fullanswer;
                                ?>
                                  
                                </span>
                                <a href="exampointfifth.php?courseid=<?php echo $_GET["courseid"]?>&semesterid=<?php echo $_GET["semesterid"]?>&txtDisplay=<?php echo $_GET["txtDisplay"]?>&subjectid=<?php echo $subjectid?>&qpid=<?php echo $_GET["qpid"]?>&questionid=<?php echo $getfaqrows["questionid"]?>" class="pull-right"> <span class="black-icons trashcan "></span></a>

                                
                                <a href="exampointsixth.php?questionid=<?php echo $getfaqrows["questionid"]?>&courseid=<?php echo $_GET["courseid"]?>&semesterid=<?php echo $_GET["semesterid"]?>&txtDisplay=<?php echo $_GET["txtDisplay"]?>&subjectid=<?php echo $subjectid?>&qpid=<?php echo $_GET["qpid"]?>" class="pull-right"> <span class="black-icons pencil "></span></a>

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