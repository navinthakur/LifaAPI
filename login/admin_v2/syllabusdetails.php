<?php include("header.php");?>
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
              <form class="form-horizontal well" method="GET" action="">
                <div class="row-fluid">
                  <div class="span3">
                    <div class="form-group">
                      <label>Course Name</label>
                      <select style=" width:100%" class="refcourseid" id="refcourseid" name="refcourseid" >
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
                              $refsubjectid = $_GET["syllabusrefsubjectid"];
                              $getsemester = mysql_query("select * from tblsubjectlist where (subjectcourserefid='$refcourseid') and (subjectsemesterrefid='$refsemesterid')");

                              while($getsemesterrows =mysql_fetch_array($getsemester)){
                            
                           ?>
                             <?php if($getsemesterrows["subjectid"] == $refsubjectid){ ?>
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

                   <div class="span3" style="margin-top: 20px">
                    <div class="form-group">
                      <button type="submit" name="btnshowdata" id="btnshowdata" class="btn btn-info">Show Data</button>
                    </div>
                  </div>
                </div>
              </form>
              <br>

                <?php
                if (isset($_GET["btnshowdata"])) {
                ?>
                <form class="well" method="POST" action="">  
                <div class="row-fluid">
                  <div class="span12">
                    <div class="nonboxy-widget">
                      <div class="widget-head">
                        <h5> Syllabus Details</h5>
                      </div>
                      <div class="widget-content">
                        <div class="widget-box">
                          <div class="row-fluid">
                            <div class="span12">
                              <table class="table table-striped table-bordered">
                                <thead>
                                  <tr>
                                    <td>Sr No</td>
                                    <td>Index Title</td>
                                    <td>Action</td>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $refcourseid = $_GET["refcourseid"];
                                    $refsemesterid = $_GET["refsemesterid"];
                                    $syllabusrefsubjectid = $_GET["syllabusrefsubjectid"];
                                    $count = 1;
                                    $getsyllabus = mysql_query("select * from tblsyllabusindex where (syllabusrefcourseid='$refcourseid') and (syllabusrefsemesterid='$refsemesterid') and (syllabusrefsubjectid='$syllabusrefsubjectid')");
                                    while($getsyllabusrows = mysql_fetch_array($getsyllabus)){

                                  ?>
                                  <tr>
                                    <td><?php echO $count?></td>
                                    <td><?php echo $getsyllabusrows["syllabustitle"]?></td>
                                    <td>
                                      <a href="viewsyllabusinfo.php?refcourseid=<?php echo $getsyllabusrows["syllabusrefcourseid"]?>&refsemesterid=<?php echo $getsyllabusrows["syllabusrefsemesterid"]?>&syllabusrefsubjectid=<?php echo $getsyllabusrows["syllabusrefsubjectid"]?>&syllabusindexid=<?php echo $getsyllabusrows["syllabusindexid"]?>&current=viewsyllabus" target="_blank" class="btn btn-info">Add Sub-Category</a>
                                    </td>
                                  </tr>
                                  <?php
                                  $count++;
                                    }
                                  ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
                <?php
              }
                ?>

            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>
<?php include("footer.php");?>