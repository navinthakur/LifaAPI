<?php include("header.php");?>
<?php
    if (isset($_POST["btnsubmitstream"])) {
      $PostTitle = $_POST["PostTitle"];
      $aboutpost = $_POST["aboutpost"];
      $characters = 'abc123';
      $string = '';
      $string1 = '';
      $string2 = '';
      $string6 = '';
      $date = date("d-m-Y");

      $AgreementUrl = $_FILES["bannerimage"]["name"];
      if($AgreementUrl <> "")
      {
        for($j = 0; $j < count($AgreementUrl); $j++)
        {
        for($i = 0; $i < 0; $i++) {
          $string .= $characters[rand(0, strlen($characters) - 1)];
        } 
        $AgreementPath1 = "../../mobileapi/uploads/" . $string . $AgreementUrl[$j];
        $AgreementPath = "uploads/" . $string . $AgreementUrl[$j];
          move_uploaded_file($_FILES["bannerimage"]["tmp_name"][$j], $AgreementPath1);
        }
      }

      $query = mysql_query("INSERT INTO `tblprincipaldesk`(`posttitle`, `postbannerimg`, `aboutpost`, `posteddate`) VALUES ('$PostTitle','$AgreementPath','$aboutpost','$date')");
      if ($query) {
        echo '<script>window.location = "principaldesk.php?status=1&msg=Details Saved Successfully!!"</script>';
      }else{
        echo '<script>window.location = "principaldesk.php?status=0&msg=Sorry Something went Wrong!!"</script>';
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
      <li class="active">Principal Desk</li>
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
              
              ?>
              <style type="text/css">
                .summary ul li .summary-icon
                {
                  width: 100px;
                  height: 80px;
                  padding: 0px;
                  background: none;
                  border: none;
                  -webkit-border-radius: none;
                  border-radius: 0%;
                }
                .summary ul li:hover .summary-icon
                {
                  background: none;
                  border: none;
                }
                .summary ul li .count{
                  padding-top: 10px;
                }
              </style>
          <div class="widget-content">
            <div class="widget-box">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="btn btn-primary btn-md" id="" name="" style="margin-top: -5px;">Add New Post</a>
              <a href="college.php" class="btn btn-success btn-md">Go Back</a>

               <div id="collapseOne" class="panel-collapse collapseOne collapse">
                  <br>
                  <form class="form-horizontal ucase" >
                    <fieldset>
                      <div class="control-group">
                        <label class="control-label" for="input01">Post Title</label>
                        <div class="controls">
                          <input type="text" name="PostTitle"  class="input-xlarge text-tip" id="input01" title="This is dummy Title">
                        </div>
                      </div>

                      <div class="control-group">
                        <label class="control-label" for="input01">Banner Image</label>
                        <div class="controls">
                          <input type="file" name="bannerimage[]" class="input-xlarge text-tip" id="input01" title="">
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">About Post</label>
                        <div class="controls">
                          <textarea id="post-editor" name="aboutpost" rows="10" cols="5"></textarea>
                        </div>
                      </div>
                      
                      <div class="form-actions">
                        <button type="submit" name="btnsubmitstream" class="btn btn-success">Post Now</button>
                      </div>
                    </fieldset>
                  </form>
              </div>
              <br>
              <div class="row-fluid">
                <?php 
                  $getlist = mysql_query("select * from tblprincipaldesk order by deskid desc");
                  $getlistcount = mysql_num_rows($getlist);
                  if ($getlistcount > 0) {
                    while($getlistrows = mysql_fetch_array($getlist)){

                ?>
                <div class="row-fluid">
                  <div class="span12">
                    <div class="span4 well">
                        <div class="summary">
                          <ul>
                            <li><span class="summary-icon"><img src="http://35.194.40.144/agentbhai/law/mobileapi/<?php echo $getlistrows["postbannerimg"]?>" style="height: 80px"  alt="New Accounts"></span><span class="count"><?php echo $getlistrows["posttitle"]?></span><span class="summary-title"> <?php echo $getlistrows["posteddate"]?></span></li>
                          </ul>
                        </div>
                    </div>
                  </div>
                </div>
                <br>
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