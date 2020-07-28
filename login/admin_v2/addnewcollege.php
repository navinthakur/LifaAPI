<?php include("header.php");?>
<?php
  if (isset($_POST["btnSubmitColgDetails"])) {

    $categoryid = $_POST["categoryid"];
    $subcategoryid = $_POST["subcategoryid"];
    $collegename = $_POST["collegename"];
    $universityname = $_POST["universityname"];
    $collegecontactno = $_POST["collegecontactno"];
    $collegeemailid = $_POST["collegeemailid"];
    $collegelocation = $_POST["collegelocation"];
    $collegestaterefname = $_POST["collegestaterefname"];
    $collegecode = $_POST["collegecode"];
    $collegestatus = $_POST["collegestatus"];
    $collegegender = $_POST["collegegender"];
    $collegeminority = $_POST["collegeminority"];
    $collegeaddress = $_POST["collegeaddress"];

    $characters = 'abc123';
    $string = '';
    $string1 = '';
    $string2 = '';
    $string6 = '';
    $date = date("d-m-Y");

    $AgreementUrl = $_FILES["collegebannerimg"]["name"];
    if($AgreementUrl <> "")
    {
      for($j = 0; $j < count($AgreementUrl); $j++)
      {
      for($i = 0; $i < 0; $i++) {
        $string .= $characters[rand(0, strlen($characters) - 1)];
      } 
      $AgreementPath1 = "../../mobileapi/uploads/" . $string . $AgreementUrl[$j];
      $AgreementPath = "uploads/" . $string . $AgreementUrl[$j];
        move_uploaded_file($_FILES["collegebannerimg"]["tmp_name"][$j], $AgreementPath1);
      }
    }

    $addcolg = mysql_query("INSERT INTO `collegedetails`(`collegestaterefname`, `collegename`, `universityname`, `collegecontactno`, `collegeemailid`, `collegecode`, `collegelocation`, `collegeaddress`, `collegestatus`, `collegegender`, `collegeminority`, `collegebannerimg`) VALUES ('$collegestaterefname','$collegename','$universityname','$collegecontactno','$collegeemailid','$collegecode','$collegelocation','$collegeaddress','$collegestatus','$collegegender','$collegeminority','$AgreementPath')");
    if ($addcolg) {
      echo '<script>window.location = "addnewcollege.php?categoryid='.$categoryid.'&subcategoryid='.$subcategoryid.'&status=1&msg=Details Saved Successfully!!"</script>';
    }else{
      echo '<script>window.location = "addnewcollege.php?categoryid='.$categoryid.'&subcategoryid='.$subcategoryid.'&status=0&msg=Sorry Something went Wrong!!"</script>';
    }


  }
?>

<div id="main-content">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li><a href="#">Dashboard</a><span class="divider">&raquo;</span></li>
      <?php
        $categoryid = $_GET["categoryid"];
        $getcategoryname = mysql_query("select * from mobileappcategorieslist where categoryid='$categoryid'");
        $getcategorynamerows = mysql_fetch_assoc($getcategoryname);

        $subcategoryllistid = $_GET["subcategoryid"];
        $getfaq = mysql_query("select * from subcategorylist where (subcategoryllistid='$subcategoryllistid')");
        
        $getfaqrows = mysql_fetch_array($getfaq);

      ?>
      <li class=""><a href="subcategorylist.php?edit=<?php echo $_GET["categoryid"]?>"><?php echo $getcategorynamerows["categoryname"]?></a><span class="divider">&raquo;</span></li>

      <li class="active"><?php echo $getfaqrows["subcategoryname"]?></li>
      
    </ul>

 <form class="form-horizontal well" method="post" action="" enctype="multipart/form-data">

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
                        <div class="span3">
                          <div class="control-group">
                                <label>College Name</label>
                                <input type="hidden" name="categoryid" value="<?php echo $_GET["categoryid"]?>">
                                <input type="hidden" name="subcategoryid" value="<?php echo $_GET["subcategoryid"]?>">
                                <input type="text" style="width: 100%" name="collegename" id="collegename" class="collegename" placeholder="College Full Name">
                          </div>
                        </div>
                        <div class="span3">
                          <div class="control-group">
                                <label>University Name</label>
                                <input type="text" style="width: 100%" name="universityname" id="universityname" class="universityname" placeholder="College University Name">
                          </div>
                        </div>

                        <div class="span3">
                          <div class="control-group">
                                <label>Contact No</label>
                                <input type="text" style="width: 100%" name="collegecontactno" id="collegecontactno" class="collegecontactno" placeholder="Contact No">
                          </div>
                        </div>

                        <div class="span3">
                          <div class="control-group">
                                <label>Email ID</label>
                                <input type="text" style="width: 100%" name="collegeemailid" id="collegeemailid" class="collegeemailid" placeholder="Email ID">
                          </div>
                        </div>

                      </div>
                    </div>
                    <div class="row-fluid">

                      <div class="span12">
                        <div class="span3">
                          <div class="control-group">
                                <label>Location</label>
                                <input type="text" style="width: 100%" name="collegelocation" id="collegelocation" class="collegelocation" placeholder="Location">
                          </div>
                        </div>


                        <div class="span3">
                          <div class="control-group">
                                <label>State</label>
                                <input type="text" style="width: 100%" name="collegestaterefname" id="collegestaterefname" class="collegestaterefname" placeholder="State">
                          </div>
                        </div>

                        <div class="span3">
                          <div class="control-group">
                                <label>College Code</label>
                                <input type="text" style="width: 100%" name="collegecode" id="collegecode" class="collegecode" placeholder="College Code">
                          </div>
                        </div>
                        

                        <div class="span3">
                          <div class="control-group">
                                <label>College Status</label>
                                <input type="text" style="width: 100%" name="collegestatus" id="collegestatus" classs="collegestatus" placeholder="For Ex: Un-Aided">
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row-fluid">

                      <div class="span12">
                        <div class="span3">
                          <div class="control-group">
                                <label>College Gender</label>
                                <input type="text" style="width: 100%" name="collegegender" id="collegegender" class="collegegender" placeholder="Ex:- Co-Education">
                          </div>
                        </div>


                        <div class="span3">
                          <div class="control-group">
                                <label>College Minority</label>
                                <input type="text" style="width: 100%" name="collegeminority" id="collegeminority" class="collegeminority" placeholder="College Minority">
                          </div>
                        </div>

                        <div class="span3">
                          <div class="control-group">
                                <label>Address</label>
                                <input type="text" style="width: 100%" name="collegeaddress" id="collegeaddress" class="collegeaddress" placeholder="College Code">
                          </div>
                        </div>


                        <div class="span3">
                          <div class="control-group">
                                <label>Banner Photo</label>
                                <input type="file" style="width: 100%" name="collegebannerimg[]" id="collegebannerimg">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row-fluid">
                      <div class="span12">
                        <div class="span5"></div>
                        <button type="submit" class="btn btn-info" name="btnSubmitColgDetails">Submit Details</button>
                        <a href="clatfindcollege.php?categoryid=<?php echo $_GET["categoryid"]?>&subcategoryid=<?php echo $_GET["subcategoryid"]?>" class="btn btn-success">Back to List</a>
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
  </form>
  </div>
</div>
<?php include("footer.php");?>