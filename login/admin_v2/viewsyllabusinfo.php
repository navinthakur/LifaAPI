<?php include("header.php");?>
<?php
    $msg = '';
    date_default_timezone_set("Asia/Kolkata");



    if (isset($_POST["BtnSubmitDetails"])) {
      
      $syllabusindexid = $_POST["syllabusindexid"];
      $refcourseid = $_POST["refcourseid"];
      $refsemesterid = $_POST["refsemesterid"];
      $syllabusrefsubjectid = $_POST["syllabusrefsubjectid"];

    
      // Owner Count
      $itemcount = count($_POST["item_no"]);
      $PrimaryTitle = $_POST["PrimaryTitle"];
      $actchapter= $_POST["actchapter"];
      $chapterstartfrom = $_POST["chapterstartfrom"];
      $chapterendfrom = $_POST["chapterendfrom"];
      
      
        $addeddate = date("Y-m-d");
          for($i = 0; $i < $itemcount; $i++){
             $PropertyQuery =  mysql_query("INSERT INTO `tblsyllabussubindex`(`subheading`,`subactchapter`,`subchapterno`, `subrefcourseid`, `subrefsemesterid`, `subsyllabusrefsubjectid`,`refsyllabusindexid`) VALUES ('$PrimaryTitle[$i]','$actchapter[$i]','( $chapterstartfrom[$i] to $chapterendfrom[$i] )','$refcourseid','$refsemesterid','$syllabusrefsubjectid','$syllabusindexid')");
          }
        
      
      if ($PropertyQuery) {
       // $msg =  '<label class="label label-success">Details Saved Successfully!!</label><br><br>';
        echo '<script>window.location = "viewsyllabusinfo.php?current=viewsyllabus&refcourseid='.$refcourseid.'&refsemesterid='.$refsemesterid.'&syllabusrefsubjectid='.$syllabusrefsubjectid.'&syllabusindexid='.$syllabusindexid.'&status=1&msg=Details Saved Successfully!!"</script>';

      }else{
        //$msg = '<label class="label label-danger">Sorry Something Went Wrong!!</label><br><br>';

        echo '<script>window.location = "viewsyllabusinfo.php?current=viewsyllabus&refcourseid='.$refcourseid.'&refsemesterid='.$refsemesterid.'&syllabusrefsubjectid='.$syllabusrefsubjectid.'&syllabusindexid='.$syllabusindexid.'&status=0&msg=Sorry Something went Wrong!!"</script>';
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
    <div class="pull-right">
        <a href="syllabusdetails" class="btn btn-primary btn-md" id="" name="" style="margin-top: -5px;">View Syllabus</a>
      </div>
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
              
                <div class="row-fluid">
                  <div class="span3">
                    <div class="form-group">
                      <label>Course Name</label>
                      <select class="form-control select2 refcourseid" id="refcourseid" name="refcourseid">
                        <option value="">Select Course Name</option>
                         <?php
                              if (isset($_GET["refcourseid"])) {
                                $refcourseid = $_GET["refcourseid"];

                                $GetProject = mysql_query("select * from courselist");
                                while($GetProjectRows =mysql_fetch_array($GetProject)){
                                  
                                ?>
                                <?php if($GetProjectRows["courseid"] == $refcourseid){ ?>
                                  <option selected="" value="<?php echo $GetProjectRows["courseid"]?>"><?php echo $GetProjectRows["coursename"]?></option>
                                <?php } else { ?>
                                  <option value="<?php echo $GetProjectRows["courseid"]?>"><?php echo $GetProjectRows["coursename"]?></option>
                                <?php        }?>
                                <?php
                                }
                              }else{
                              ?>
                          <?php
                              $getprojectnew = mysql_query("select * from courselist");
                              while($getprojectnewrows = mysql_fetch_array($getprojectnew)){

                            ?>
                            <option value="<?php echo $getprojectnewrows["courseid"]?>"><?php echo $getprojectnewrows["coursename"]?></option>
                            <?php
                          }
                        }
                        ?>

                        
                      </select>
                    </div>
                  </div>
                  <div class="span3">
                    <div class="form-group">
                      <label>Semester</label>
                      <select style=" width:100%" class="refsemesterid" name="refsemesterid" id="refsemesterid">
                        <option value="">Select Course First</option>
                         <?php
                          if (isset($_GET["refsemesterid"])) {
                            $refcourseid = $_GET["refcourseid"];
                            $refsemesterid = $_GET["refsemesterid"];

                            $count = 1;
                            $getsemester = mysql_query("select * from tblsemesterlist where courserefid='$refcourseid'");
                            while($getsemesterrows =mysql_fetch_array($getsemester)){
                          
                         ?>
                           <?php if($getsemesterrows["semesterid"] == $refsemesterid){ ?>
                              <option selected="" value="<?php echo $getsemesterrows["semesterid"]?>"><?php echo $getsemesterrows["semestername"]?> <?php echo $count?></option>
                            <?php } else { ?>
                              <option value="<?php echo $getsemesterrows["semesterid"]?>"><?php echo $getsemesterrows["semestername"]?> <?php echo $count?></option>
                            <?php  }?>
                            <?php
                            $count++;
                            }
                          }
                         ?>
                        
                      </select>
                    </div>
                  </div>


                  <div class="span3">
                    <div class="form-group">
                      <label>Subject Name</label>
                      <select style=" width:100%" class="syllabusrefsubjectid" name="syllabusrefsubjectid" id="syllabusrefsubjectid">
                         <option value="">Select Semester First</option>
                          <?php
                          if (isset($_GET["syllabusrefsubjectid"])) {
                            $refcourseid = $_GET["refcourseid"];
                            $refsemesterid = $_GET["refsemesterid"];
                            $syllabusrefsubjectid = $_GET["syllabusrefsubjectid"];
                            $getsemester = mysql_query("select * from tblsubjectlist where (subjectcourserefid='$refcourseid') and (subjectsemesterrefid='$refsemesterid')");
                            while($getsemesterrows =mysql_fetch_array($getsemester)){
                          
                         ?>
                           <?php if($getsemesterrows["subjectid"] == $syllabusrefsubjectid){ ?>
                              <option selected="" value="<?php echo $getsemesterrows["subjectid"]?>"><?php echo $getsemesterrows["subjectname"]?></option>
                            <?php } else { ?>
                              <option value="<?php echo $getsemesterrows["subjectid"]?>"><?php echo $getsemesterrows["subjectname"]?></option>
                            <?php  }?>
                            <?php
                            }
                          }
                         ?>
                      </select>
                    </div>
                  </div>

                   <div class="span3">
                    <div class="form-group">
                      <label>Index Name</label>
                      <select class="form-control syllabusindexid select2" id="syllabusindexid" required="" name="syllabusindexid">
                         <option value="">Select Index</option>
                          <?php
                          if (isset($_GET["syllabusrefsubjectid"])) {
                            $refcourseid = $_GET["refcourseid"];
                            $refsemesterid = $_GET["refsemesterid"];
                            $syllabusrefsubjectid = $_GET["syllabusrefsubjectid"];
                            $syllabusindexid = $_GET["syllabusindexid"];

                            $getsemester = mysql_query("select * from tblsyllabusindex where (syllabusrefcourseid='$refcourseid') and (syllabusrefsemesterid='$refsemesterid') and (syllabusrefsubjectid='$syllabusrefsubjectid')");
                            while($getsemesterrows =mysql_fetch_array($getsemester)){
                          
                         ?>
                           <?php if($getsemesterrows["syllabusindexid"] == $syllabusindexid){ ?>
                              <option selected="" value="<?php echo $getsemesterrows["syllabusindexid"]?>"><?php echo $getsemesterrows["syllabustitle"]?></option>
                            <?php } else { ?>
                              <option value="<?php echo $getsemesterrows["syllabusindexid"]?>"><?php echo $getsemesterrows["syllabustitle"]?></option>
                            <?php  }?>
                            <?php
                            }
                          }
                         ?>
                        </select>
                    </div>
                  </div>
                </div>
              <br>
              
                <div class="">
                  <div class="">
                    <div class="nonboxy-widget">
                      <div class="widget-head">
                        <h5> Index Details</h5>
                      </div>
                      <div class="widget-content">
                        <div class="widget-box">
                          <div class="row-fluid">
                            <div class="span12">
                              <div class="span2">
                                <div class="control-group">
                                  <label>Chapter</label>
                                  <input type="text" style="width: 100%" name="actchapter[]" id="actchapter_0" class="form-control actchapter" placeholder="for eg: Chapter - I">
                                </div>
                              </div>
                              <div class="span2">
                                <div class="control-group">
                                  <label>From </label>
                                   <input type="text" style="width: 100%" name="chapterstartfrom[]" id="chapterstartfrom_0" class="form-control chapterstartfrom" placeholder="Enter Serial Number">
                                </div>
                              </div>

                              <div class="span2">
                                <div class="control-group">
                                  <label>To </label>
                                   <input type="text" style="width: 100%" name="chapterendfrom[]" id="chapterendfrom_0" class="form-control chapterendfrom" placeholder="Enter Serial Number">
                                </div>
                              </div>

                              <div class="span4">
                                <div class="control-group">
                                  <label>Index Title </label>
                                   <input type="hidden" class="form-control ino" id="ino_0" name="item_no[]" style="width:50px" value="1">
                                              
                                    <input type="text" style="width: 100%" name="PrimaryTitle[]" required="" id="PrimaryTitle_0" class="PrimaryTitle form-control" placeholder="Title here.."/>
                                </div>
                              </div>

                              <div class="span2" style="margin-top: 18px">
                                <div class="control-group">
                                  <label> </label>
                                   <button type="button"style="width: 100%" class="BtnAddMoreIndexSyllabus btn btn-danger btn-md" id="BtnAddMoreIndexSyllabus" name="BtnAddMoreIndexSyllabus">Add More Index</button>
                                </div>
                              </div>
                            </div>
                          </div>

                           <div id="SyllabusDiv">
                             
                           </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                  <div class="span5"></div>
                  <button type="Submit" name="BtnSubmitDetails" id="BtnSubmitDetails" class="BtnSubmitDetails btn btn-success">Submit Details</button>
              
            </div>
          </div>
        </div>
      </div>
    </div>
</form>
  </div>
</div>
<?php include("footer.php");?>