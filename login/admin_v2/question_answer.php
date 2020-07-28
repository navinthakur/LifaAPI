<?php include("header.php");?>
<?php
    $msg = '';
    date_default_timezone_set("Asia/Kolkata");



    if (isset($_POST["BtnSubmitDetails"])) {
      
      
      $refcourseid = $_POST["refcourseid"];
      $refsemesterid = $_POST["refsemesterid"];
      $refsubjectid = $_POST["refsubjectid"];
      $refpatternid = $_POST["refpatternid"];
      $questionyear = $_POST["questionyear"];

    
      // Owner Count
      $itemcount = count($_POST["item_no"]);
      $PrimaryQuestion = $_POST["PrimaryQuestion"];
      $PrimaryAnswer = $_POST["PrimaryAnswer"];
      
      
        $addeddate = date("Y-m-d");
          for($i = 0; $i < $itemcount; $i++){
             $PropertyQuery =  mysql_query("INSERT INTO `questionlist`(`questiontype`, `questionfull`, `optionone`, `optiontwo`, `optionthree`, `optionfour`, `correctanswer`, `fullanswer`,`questionyear`, `refcourseid`, `refsemesterid`, `refsubjectid`, `refpatternid`,`addeddate`) VALUES ('faq','$PrimaryQuestion[$i]','','','','','','$PrimaryAnswer[$i]','$questionyear','$refcourseid','$refsemesterid','$refsubjectid','$refpatternid','$addeddate')");
          }
        
      
      if ($PropertyQuery) {
       // $msg =  '<label class="label label-success">Details Saved Successfully!!</label><br><br>';
        echo '<script>window.location = "question_answer.php?current=dashboard&refcourseid='.$refcourseid.'&refsemesterid='.$refsemesterid.'&refsubjectid='.$refsubjectid.'&refpatternid='.$refpatternid.'&questionyear='.$questionyear.'&status=1&msg=Details Saved Successfully!!"</script>';

      }else{
        //$msg = '<label class="label label-danger">Sorry Something Went Wrong!!</label><br><br>';

        echo '<script>window.location = "question_answer.php?current=dashboard&refcourseid='.$refcourseid.'&refsemesterid='.$refsemesterid.'&refsubjectid='.$refsubjectid.'&refpatternid='.$refpatternid.'&questionyear='.$questionyear.'&status=0&msg=Sorry Something went Wrong!!"</script>';
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
      <li class="active">Question & Answer</li>

      <div class="pull-right">
        <a href="addanswer.php" class="btn btn-primary btn-md" id="" name="" style="margin-top: -5px;">Add/Update Answer</a>
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

                  <div class="span2">
                    <div class="form-group">
                      <label>Select Year</label>
                      <select style=" width:100%" class="questionyear" name="questionyear" id="questionyear">
                        <?php
                          if (isset($_GET["questionyear"])) {
                            $questionyear = $_GET["questionyear"];
                            if ($questionyear == "") {
                              $noyear = 'selected';
                              $yearone = '';
                              $yeartwo = '';
                              $yearthree = '';
                              $yearfour = '';
                              $yearfive = '';
                              $yearsix = '';
                              $yearseven = '';
                              $yeareight = '';
                              $yearnine = '';
                              $yearten = '';
                              $twoten = '';
                            }else if ($questionyear == "2010") {
                              $noyear = '';
                              $yearone = '';
                              $yeartwo = '';
                              $yearthree = '';
                              $yearfour = '';
                              $yearfive = '';
                              $yearsix = '';
                              $yearseven = '';
                              $yeareight = '';
                              $yearnine = '';
                              $yearten = '';
                              $twoten = 'selected';
                            }else if ($questionyear == "2011") {
                              $noyear = '';
                              $yearone = 'selected';
                              $yeartwo = '';
                              $yearthree = '';
                              $yearfour = '';
                              $yearfive = '';
                              $yearsix = '';
                              $yearseven = '';
                              $yeareight = '';
                              $yearnine = '';
                              $yearten = '';
                              $twoten = '';
                            }else if ($questionyear == "2012") {
                              $noyear = '';
                              $yearone = '';
                              $yeartwo = 'selected';
                              $yearthree = '';
                              $yearfour = '';
                              $yearfive = '';
                              $yearsix = '';
                              $yearseven = '';
                              $yeareight = '';
                              $yearnine = '';
                              $yearten = '';
                              $twoten = '';
                            }else if ($questionyear == "2013") {
                              $noyear = '';
                              $yearone = '';
                              $yeartwo = '';
                              $yearthree = 'selected';
                              $yearfour = '';
                              $yearfive = '';
                              $yearsix = '';
                              $yearseven = '';
                              $yeareight = '';
                              $yearnine = '';
                              $yearten = '';
                              $twoten = '';
                            }else if ($questionyear == "2014") {
                              $noyear = '';
                              $yearone = '';
                              $yeartwo = '';
                              $yearthree = '';
                              $yearfour = 'selected';
                              $yearfive = '';
                              $yearsix = '';
                              $yearseven = '';
                              $yeareight = '';
                              $yearnine = '';
                              $yearten = '';
                              $twoten = '';
                            }else if ($questionyear == "2015") {
                              $noyear = '';
                              $yearone = '';
                              $yeartwo = '';
                              $yearthree = '';
                              $yearfour = '';
                              $yearfive = 'selected';
                              $yearsix = '';
                              $yearseven = '';
                              $yeareight = '';
                              $yearnine = '';
                              $yearten = '';
                              $twoten = '';
                            }else if ($questionyear == "2016") {
                              $noyear = '';
                              $yearone = '';
                              $yeartwo = '';
                              $yearthree = '';
                              $yearfour = '';
                              $yearfive = '';
                              $yearsix = 'selected';
                              $yearseven = '';
                              $yeareight = '';
                              $yearnine = '';
                              $yearten = '';
                              $twoten = '';
                            }else if ($questionyear == "2017") {
                              $noyear = '';
                              $yearone = '';
                              $yeartwo = '';
                              $yearthree = '';
                              $yearfour = '';
                              $yearfive = '';
                              $yearsix = '';
                              $yearseven = 'selected';
                              $yeareight = '';
                              $yearnine = '';
                              $yearten = '';
                              $twoten = '';
                            }else if ($questionyear == "2018") {
                              $noyear = '';
                              $yearone = '';
                              $yeartwo = '';
                              $yearthree = '';
                              $yearfour = '';
                              $yearfive = '';
                              $yearsix = '';
                              $yearseven = '';
                              $yeareight = 'selected';
                              $yearnine = '';
                              $yearten = '';
                              $twoten = '';
                            }else if ($questionyear == "2019") {
                              $noyear = '';
                              $yearone = '';
                              $yeartwo = '';
                              $yearthree = '';
                              $yearfour = '';
                              $yearfive = '';
                              $yearsix = '';
                              $yearseven = '';
                              $yeareight = '';
                              $yearnine = 'selected';
                              $yearten = '';
                              $twoten = '';
                            }else if ($questionyear == "2020") {
                              $noyear = '';
                              $yearone = '';
                              $yeartwo = '';
                              $yearthree = '';
                              $yearfour = '';
                              $yearfive = '';
                              $yearsix = '';
                              $yearseven = '';
                              $yeareight = '';
                              $yearnine = '';
                              $yearten = 'selected';
                              $twoten = '';
                            }
                          }else{
                              $noyear = 'selected';
                              $yearone = '';
                              $yeartwo = '';
                              $yearthree = '';
                              $yearfour = '';
                              $yearfive = '';
                              $yearsix = '';
                              $yearseven = '';
                              $yeareight = '';
                              $yearnine = '';
                              $yearten = '';
                              $twoten = '';
                          }
                        ?>
                        <option value="" <?php echo $noyear?>>Select Year</option>
                        <option value="2010" <?php echo $twoten?>>2010</option>
                        <option value="2011" <?php echo $yearone?>>2011</option>
                        <option value="2012" <?php echo $yeartwo?>>2012</option>
                        <option value="2013" <?php echo $yearthree?>>2013</option>
                        <option value="2014" <?php echo $yearfour?>>2014</option>
                        <option value="2015" <?php echo $yearfive?>>2015</option>
                        <option value="2016" <?php echo $yearsix?>>2016</option>
                        <option value="2017" <?php echo $yearseven?>>2017</option>
                        <option value="2018" <?php echo $yeareight?>>2018</option>
                        <option value="2019" <?php echo $yearnine?>>2019</option>
                        <option value="2020" <?php echo $yearten?>>2020</option>
                         
                      </select>
                    </div>
                  </div>

                </div>

                <div class="">
                  <div class="">
                    <div class="nonboxy-widget">
                      <div class="widget-head">
                        <h5> Question & Answer</h5>
                      </div>
                      <div class="widget-content">
                        <div class="widget-box">
                          <div class="row-fluid">
                            <div class="span12">
                              <div class="span3">
                                <div class="control-group">
                                  <label>Question</label>
                                   <input type="hidden" class="form-control ino" id="ino_0" name="item_no[]" style="width:50px" value="1">

                                     <input type="text" style="width: 100%" name="PrimaryQuestion[]" required="" id="PrimaryQuestion_0" class="PrimaryQuestion" placeholder="Enter Question here.."/>             
                                </div>
                              </div>
                              <div class="span7">
                                <div class="control-group">
                                  <label>Answer</label>
                                   <input type="text" style="width: 100%" name="PrimaryAnswer[]" id="PrimaryAnswer_0" required="" class="PrimaryAnswer span7" placeholder="Enter Answer here.."/>
                                 </div>
                              </div>

                              <div class="span2" style="margin-top: 19px">
                                <div class="control-group">
                                  <button type="button" class="BtnAddMoreOwner btn btn-danger btn-md" id="BtnAddMoreOwner" name="BtnAddMoreOwner">Add More Question</button>
                                </div>
                              </div>

                            </div>
                          </div>

                           <div id="Ownerdiv">
                           </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

            </div>
          </div>
        </div>
      </div>

      <div class="span5"></div>
      <button type="Submit" name="BtnSubmitDetails" id="BtnSubmitDetails" class="BtnSubmitDetails btn btn-success">Submit Details</button>
      
    </div>
  </form>
  </div>
</div>
<?php include("footer.php");?>