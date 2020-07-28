<?php include("header.php");?>
<?php
$courtlistingid = $_GET["view"];
$getcourt = mysql_query("select * from courtslisting where courtlistingid='$courtlistingid'");
$getcourtrows = mysql_fetch_assoc($getcourt);
$courtrefstate = $getcourtrows["courtrefstate"];
$courtshortname = $getcourtrows["courtshortname"];
$courtfullname = $getcourtrows["courtfullname"];
$courtesablish = $getcourtrows["courtesablish"];
$courtlocation = $getcourtrows["courtlocation"];
$courtcontact = $getcourtrows["courtcontact"];
$courtemail = $getcourtrows["courtemail"];
$aboutcourt = $getcourtrows["aboutcourt"];
$courtlistrefid = $getcourtrows["courtlistrefid"];

    $msg = '';
    date_default_timezone_set("Asia/Kolkata");
    if (isset($_POST["btnsubmitchapterdetails"])) {
        
        $courtlistingid = $_POST["courtlistingid"];
        $courtrefid  = $_POST["courtrefid"];
        $CourtShortName  = $_POST["CourtShortName"];
        $CourtFullName  = $_POST["CourtFullName"];
        $courtestablisheddate  = $_POST["courtestablisheddate"];
        $courtlocation  = $_POST["courtlocation"];
        $courtcontactno  = $_POST["courtcontactno"];
        $courtemailid  = $_POST["courtemailid"];
        $aboutcourt  = $_POST["aboutcourt"];

        $courtquery = mysql_query("UPDATE `courtslisting` SET `courtshortname`='$CourtShortName',`courtfullname`='$CourtFullName',`courtesablish`='$courtestablisheddate',`courtlocation`='$courtlocation',`courtcontact`='$courtcontactno',`courtemail`='$courtemailid',`aboutcourt`='$aboutcourt',`courtlistrefid`='$courtrefid' WHERE `courtlistingid`='$courtlistingid'");

        if ($courtquery) {
          echo '<script>window.location = "courtsdetails.php?view='.$courtlistingid.'&current=courts&status=1&msg=Details Updated Successfully!!"</script>';
        }else{
          echo '<script>window.location = "courtsdetails.php?view='.$courtlistingid.'&current=courts&status=0&msg=Sorry Something went wrong!!"</script>';
        }
     
    }


  ?>
    <div id="main-content">
      <div class="container-fluid">
        <ul class="breadcrumb">
          <li><a href="#">Home</a><span class="divider">&raquo;</span></li>
          <li class="active">Courts</li>
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
                    ?>
                <div class="widget-content">
                  <div class="widget-box">
                    
                      <form class="well" method="post" action="">
                          <div class="row-fluid">
                              <div class="span12">
                                <div class="span3">
                                  <div class="control-group">
                                    <label class="">Select Court</label>
                                    <select class="form-control select2 courtrefid" name="courtrefid" id="courtrefid" style="width: 100%">
                                      <option value="">Select Court</option>
                                      <?php
                                        $getcourt = mysql_query("select * from tblcourtlist");
                                        while($getcourtrows = mysql_fetch_array($getcourt)){

                                      ?>
                                      <?php if($getcourtrows["courtid"] == $courtlistrefid){ ?>
                                      <option value="<?php echo $getcourtrows["courtid"]?>" selected><?php echo $getcourtrows["courtname"]?></option>
                                      <?php } else { ?>
                                        <option value="<?php echo $getcourtrows["courtid"]?>"><?php echo $getcourtrows["courtname"]?></option>
                                        <?php        }?>
                                      <?php
                                        }
                                      ?>
                                    </select>
                                  </div>
                                </div>
                                <!-- <div class="span3">
                                  <div class="control-group">
                                    <label>State</label>
                                    <select class="form-control select2 courtrefstate" name="courtrefstate" id="courtrefstate" style="width: 100%">
                                        <option value="">Select State</option>
                                        <option value="andaman">Andaman and Nicobar</option>
                                        <option value="ap">Andhra Pradesh</option>
                                        <option value="arunachal">Arunachal Pradesh</option>
                                        <option value="assam">Assam</option>
                                        <option value="bihar">Bihar</option>
                                        <option value="chandigarh-district-court">Chandigarh</option>
                                        <option value="chhattisgarh">Chhattisgarh</option>
                                        <option value="dadra">Dadra and Nagar Haveli</option>
                                        <option value="damandiu">Daman and Diu</option>
                                        <option value="delhi">Delhi</option>
                                        <option value="goa">Goa</option>
                                        <option value="gujarat">Gujarat</option>
                                        <option value="haryana">Haryana</option>
                                        <option value="hp">Himachal Pradesh</option>
                                        <option value="jk">Jammu and Kashmir</option>
                                        <option value="jharkhand">Jharkhand</option>
                                        <option value="karnataka">Karnataka</option>
                                        <option value="kerala">Kerala</option>
                                        <option value="lakshadweep">Lakshadweep</option>
                                        <option value="mp">Madhya Pradesh</option>
                                        <option value="maharashtra">Maharashtra</option>
                                        <option value="manipur">Manipur</option>
                                        <option value="meghalaya">Meghalaya</option>
                                        <option value="mizoram">Mizoram</option>
                                        <option value="nagaland">Nagaland</option>
                                        <option value="odisha">Odisha</option>
                                        <option value="puducherry">Puducherry</option>
                                        <option value="punjab">Punjab</option>
                                        <option value="rajasthan">Rajasthan</option>
                                        <option value="sikkim">Sikkim</option>
                                        <option value="tn">Tamil Nadu</option>
                                        <option value="telangana">Telangana</option>
                                        <option value="tripura">Tripura</option>
                                        <option value="up">Uttar Pradesh</option>
                                        <option value="uttarakhand">Uttarakhand</option>
                                        <option value="wb">West Bengal</option>
                                      </select>
                                  </div>
                                </div> -->
                              </div>
                          </div>
                          <div class="row-fluid">
                            <div class="span12">
                              <div class="span2">
                                <div class="control-group">
                                  <label>Court Short Name</label>
                                  <input type="hidden" name="courtlistingid" value="<?php echo $_GET["view"]?>">
                                  <input type="text" style="width: 100%" name="CourtShortName" id="CourtShortName" class="form-control CourtShortName" placeholder="for eg: Short Name" value="<?php echo $courtshortname?>">
                                </div>
                              </div>
                              <div class="span2">
                                <div class="control-group">
                                  <label>Court Name</label>
                                  <input type="text" style="width: 100%" name="CourtFullName" id="CourtFullName" class="form-control CourtFullName" placeholder="Enter Court Name" value="<?php echo $courtfullname?>">
                                </div>
                              </div>

                              <div class="span2">
                                <div class="control-group">
                                  <label>Court Establised Date</label>
                                  <input type="text" style="width: 100%" name="courtestablisheddate" id="courtestablisheddate" class="form-control courtestablisheddate" placeholder="Establised Date" value="<?php echo $courtesablish?>">
                                </div>
                              </div>

                              <div class="span2">
                                <div class="control-group">
                                  <label>Court Location</label>
                                  <input type="text" style="width: 100%" name="courtlocation" id="courtlocation" class="form-control courtlocation" placeholder="Location.." value="<?php echo $courtlocation?>">
                                </div>
                              </div>


                              <div class="span2">
                                <div class="control-group">
                                  <label>Contact No</label>
                                  <input type="text" style="width: 100%" name="courtcontactno" id="courtcontactno" class="form-control courtcontactno" placeholder="Contact No.." value="<?php echo $courtcontact?>">
                                </div>
                              </div>

                              <div class="span2">
                                <div class="control-group">
                                  <label>Email ID</label>
                                  <input type="text" style="width: 100%" name="courtemailid" id="courtemailid" class="form-control courtemailid" placeholder="Email ID" value="<?php echo $courtemail?>">
                                </div>
                              </div>
                            </div>
                            <div class="row-fluid">
                              <div class="span12">
                                <div class="control-group">
                                  <label>About Court</label>
                                  <textarea style="width: 100%" rows="7" class="form-control aboutcourt" name="aboutcourt" id="aboutcourt" placeholder="About Court...">
                                    <?php echo $aboutcourt?>
                                  </textarea>
                                </div>
                              </div>
                            </div>

                            <div class="row-fluid">
                              <div class="span6">
                              </div>
                              <button type="submit" name="btnsubmitchapterdetails" id="btnsubmitchapterdetails" class="btn btn-primary btnsubmitchapterdetails">
                                          Submit Details
                                        </button>
                            </div>
                          </div>
                      </form>                   
                       
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
      
    </div>

  </div>
</div>
<?php include("footer.php");?>