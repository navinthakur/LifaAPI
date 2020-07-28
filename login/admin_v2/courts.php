<?php include("header.php");?>
<?php
if (isset($_GET["del"])) {
  $courtlistingid = $_GET["del"];
  $delc = mysql_query("delete from courtslisting where courtlistingid='$courtlistingid'");
  if ($delc) {
    echo '<script>window.location = "courts.php?current=courts&status=1&msg=Enter Deleted Successfully!!"</script>';
  }else{
    echo '<script>window.location = "courts.php?current=courts&status=0&msg=Sorry Something went wrong!!"</script>';
  }
}
    $msg = '';
    date_default_timezone_set("Asia/Kolkata");
    if (isset($_POST["btnsubmitchapterdetails"])) {
        
        $courtrefid  = $_POST["courtrefid"];
        $courtrefstate = $_POST["courtrefstate"];
        $CourtShortName  = $_POST["CourtShortName"];
        $CourtFullName  = $_POST["CourtFullName"];
        $courtestablisheddate  = $_POST["courtestablisheddate"];
        $courtlocation  = $_POST["courtlocation"];
        $courtcontactno  = $_POST["courtcontactno"];
        $courtemailid  = $_POST["courtemailid"];
        $aboutcourt  = $_POST["aboutcourt"];

        $courtquery = mysql_query("INSERT INTO `courtslisting`(`courtrefstate`,`courtshortname`, `courtfullname`, `courtesablish`, `courtlocation`, `courtcontact`, `courtemail`, `aboutcourt`, `courtlistrefid`) VALUES ('$courtrefstate','$CourtShortName','$CourtFullName','$courtestablisheddate','$courtlocation','$courtcontactno','$courtemailid','$aboutcourt','$courtrefid')");
        if ($courtquery) {
          echo '<script>window.location = "courts.php?current=courts&status=1&msg=Details Saved Successfully!!"</script>';
        }else{
          echo '<script>window.location = "courts.php?current=courts&status=0&msg=Sorry Something went wrong!!"</script>';
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
                         <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="btn btn-primary btn-md" id="" name="" style="margin-top: -5px;">Add Court Details</a>
                          <div id="collapseOne" class="panel-collapse collapseOne collapse">
                            <br>
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
                                        <option value="<?php echo $getcourtrows["courtid"]?>"><?php echo $getcourtrows["courtname"]?></option>
                                        <?php
                                          }
                                        ?>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="span3">
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
                                  </div>
                                </div>
                            </div>
                            <div class="row-fluid">
                              <div class="span12">
                                <div class="span2">
                                  <div class="control-group">
                                    <label>Court Short Name</label>
                                    <input type="text" style="width: 100%" name="CourtShortName" id="CourtShortName" class="form-control CourtShortName" placeholder="for eg: Short Name">
                                  </div>
                                </div>
                                <div class="span2">
                                  <div class="control-group">
                                    <label>Court Name</label>
                                    <input type="text" style="width: 100%" name="CourtFullName" id="CourtFullName" class="form-control CourtFullName" placeholder="Enter Court Name">
                                  </div>
                                </div>

                                <div class="span2">
                                  <div class="control-group">
                                    <label>Court Establised Date</label>
                                    <input type="text" style="width: 100%" name="courtestablisheddate" id="courtestablisheddate" class="form-control courtestablisheddate" placeholder="Establised Date">
                                  </div>
                                </div>

                                <div class="span2">
                                  <div class="control-group">
                                    <label>Court Location</label>
                                    <input type="text" style="width: 100%" name="courtlocation" id="courtlocation" class="form-control courtlocation" placeholder="Location..">
                                  </div>
                                </div>


                                <div class="span2">
                                  <div class="control-group">
                                    <label>Contact No</label>
                                    <input type="text" style="width: 100%" name="courtcontactno" id="courtcontactno" class="form-control courtcontactno" placeholder="Contact No..">
                                  </div>
                                </div>

                                <div class="span2">
                                  <div class="control-group">
                                    <label>Email ID</label>
                                    <input type="text" style="width: 100%" name="courtemailid" id="courtemailid" class="form-control courtemailid" placeholder="Email ID">
                                  </div>
                                </div>
                              </div>
                              <div class="row-fluid">
                                <div class="span12">
                                  <div class="control-group">
                                    <label>About Court</label>
                                    <textarea style="width: 100%" rows="7" class="form-control aboutcourt" name="aboutcourt" id="aboutcourt" placeholder="About Court..."></textarea>
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
                          </div>
                        </form>
                      <br>
                      <div class="box-tab">
                        <div class="tabbable"> 
                          <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1" data-toggle="tab">High Courts</a></li>
                            <li><a href="#tab2" data-toggle="tab">District Courts</a></li>
                          </ul>
                          <div class="tab-content">
                            <div class="tab-pane active" id="tab1">
                               <table class="table table-bordered text-center data-tbl-inbox">
                                  <thead>
                                    <tr>
                                      <th class="center">Court Name</th>
                                      <th class="center">Contact No</th>
                                      <th class="center">Email Address</th>
                                      <th class="center">Location</th>
                                      <th class="center">Establish Date</th>
                                      <th class="center">Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                      $getcourtdetails = mysql_query("select * from courtslisting where courtlistrefid='1'");
                                      while($getcourtdetailsrows = mysql_fetch_array($getcourtdetails)){

                                    ?>
                                    <tr>
                                      <td class="center"><?php echo $getcourtdetailsrows["courtfullname"]?></td>
                                      <td class="center"><?php echo $getcourtdetailsrows["courtcontact"]?></td>
                                      <td class="center"><?php echo $getcourtdetailsrows["courtemail"]?></td>
                                      <td class="center"><?php echo $getcourtdetailsrows["courtlocation"]?></td>
                                      <td class="center"><?php echo $getcourtdetailsrows["courtesablish"]?></td>
                                      <td class="center">
                                        <div class="btn-group">
                                            <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-cog "></i><span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                              <li><a href="courtsdetails.php?view=<?php echo $getcourtdetailsrows["courtlistingid"]?>" target="_blank"><i class="icon-file"></i> Edit Details</a></li>
                                              <li><a href="courts.php?del=<?php echo $getcourtdetailsrows["courtlistingid"]?>"><i class="icon-trash"></i> Remove Post</a></li>
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
                            <div class="tab-pane" id="tab2">
                              <table class="table table-bordered text-center data-tbl-inbox">
                                  <thead>
                                    <tr>
                                      <th class="center">Court Name</th>
                                      <th class="center">Contact No</th>
                                      <th class="center">Email Address</th>
                                      <th class="center">Location</th>
                                      <th class="center">Establish Date</th>
                                      <th class="center">Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                      $getcourtdetails = mysql_query("select * from courtslisting where courtlistrefid='2'");
                                      while($getcourtdetailsrows = mysql_fetch_array($getcourtdetails)){

                                    ?>
                                    <tr>
                                      <td class="center"><?php echo $getcourtdetailsrows["courtfullname"]?></td>
                                      <td class="center"><?php echo $getcourtdetailsrows["courtcontact"]?></td>
                                      <td class="center"><?php echo $getcourtdetailsrows["courtemail"]?></td>
                                      <td class="center"><?php echo $getcourtdetailsrows["courtlocation"]?></td>
                                      <td class="center"><?php echo $getcourtdetailsrows["courtesablish"]?></td>
                                      <td class="center">
                                        <div class="btn-group">
                                            <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-cog "></i><span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                              <li><a href="courtsdetails.php?view=<?php echo $getcourtdetailsrows["courtlistingid"]?>" target="_blank"><i class="icon-file"></i> Edit Details</a></li>
                                              <li><a href="courts.php?del=<?php echo $getcourtdetailsrows["courtlistingid"]?>"><i class="icon-trash"></i> Remove Post</a></li>
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