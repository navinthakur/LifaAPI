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
      <li class="active">Question & Answer</li>

      <div class="pull-right">
        <button type="button" class="BtnAddMoreOwner btn btn-primary btn-md" id="BtnAddMoreOwner" name="BtnAddMoreOwner" style="margin-top: -5px;">Add/Update Answer</button>
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


                  <div class="span2">
                    <div class="form-group">
                      <label>Subject Name</label>
                      <select style=" width:100%" class="refsubjectid" name="refsubjectid" id="refsubjectid">
                         <option value="">Select Semester First</option>
                            <?php
                            if (isset($_GET["refsubjectid"])) {
                              $refcourseid = $_GET["refcourseid"];
                              $refsemesterid = $_GET["refsemesterid"];
                              $refsubjectid = $_GET["refsubjectid"];
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

                  <div class="span2">
                    <div class="form-group">
                      <label>Question Pattern</label>
                      <select style=" width:100%" class="refpatternid" name="refpatternid" id="refpatternid">
                        <option value="">Select Question Pattern</option>
                          <?php
                            if (isset($_GET["refpatternid"])) {
                              $refpatternid = $_GET["refpatternid"];
                              $refsubjectid= $_GET["refsubjectid"];
                              $getsemester = mysql_query("select * from tblquestionpatten where questionpatternsubjectrefid='$refsubjectid'");
                              while($getsemesterrows =mysql_fetch_array($getsemester)){
                            
                           ?>
                             <?php if($getsemesterrows["qpid"] == $refpatternid){ ?>
                                <option selected="" value="<?php echo $getsemesterrows["qpid"]?>"><?php echo $getsemesterrows["patterntitle"]?> ( <?php echo $getsemesterrows["questionpatternmarks"]?> )</option>
                              <?php } else { ?>
                                <option value="<?php echo $getsemesterrows["qpid"]?>"><?php echo $getsemesterrows["patterntitle"]?> ( <?php echo $getsemesterrows["questionpatternmarks"]?> )</option>
                              <?php  }?>
                              <?php
                              }
                            }
                           ?>
                         
                      </select>
                    </div>
                  </div>

                  <div class="span2" style="margin-top: 20px">
                    <div class="form-group">
                      
                      <button type="submit" class="btn btn-info">Show Question</button>
                    </div>
                  </div>

                </div>
              </form>
              <br>
              <?php
              if (isset($_GET["refcourseid"])) {
               ?> 
              <form class="" method="POST" action="">  
                <div class="row-fluid">
                  <div class="span12">
                    <div class="nonboxy-widget">
                      <div class="widget-head">
                        <h5> Answer</h5>
                      </div>
                      <div class="widget-content">
                        <div class="widget-box">
                          <div class="row-fluid">
                            <div class="span12">
                              <table class="data-tbl-striped table table-striped table-bordered">
                              <thead>
                                <tr>
                                  <td>SrNo</td>
                                  <td>Question</td>
                                  <td>Action</td>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $count = 1;

                                  $getfaq = mysql_query("select * from questionlist where (refcourseid='$refcourseid') and (refsemesterid='$refsemesterid') and (refsubjectid='$refsubjectid') and (refpatternid='$refpatternid')");
                                  while($getfaqrows = mysql_fetch_array($getfaq)){                                  
                                ?>
                                <tr>
                                  <td><?php echo $count++?></td>
                                  <td>
                                    <?php echo $getfaqrows["questionfull"]?>
                                  </td>
                                  <td>
                                    <a href="addanswerdetails.php?current=addanswer&questionid=<?php echo $getfaqrows["questionid"]?>" class="btn btn-info btn-sm" target="_blank">Add Answer</a>
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

      <div class="span5"></div>
      <button type="Submit" name="BtnSubmitDetails" id="BtnSubmitDetails" class="BtnSubmitDetails btn btn-success">Submit Details</button>
      
    </div>
  </div>
</div>
<?php include("footer.php");?>