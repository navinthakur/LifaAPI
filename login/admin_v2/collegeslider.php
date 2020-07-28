<?php include("header.php");?>
  <?php

  if (isset($_GET["del"])) {
    $seriesid = $_GET["del"];
    $categoryid = $_GET["categoryid"];
    $delquery = mysql_query("delete from collegeslider where collegesliderid='$seriesid'");
    if ($delquery) {
       echo '<script>window.location = "collegeslider.php?categoryid='.$categoryid.'&status=1&msg=Image Deleted Successfully!!"</script>';
    }else{
       echo '<script>window.location = "collegeslider.php?categoryid='.$categoryid.'&status=0&msg=Sorry Something went Wrong!!"</script>';
    }
  }

    if (isset($_POST["btnsubmitstream"])) {
        date_default_timezone_set("Asia/Kolkata");
        $categoryid = $_POST["categoryid"];
        $SeriesSection = $_POST["SeriesSection"];
        $characters = 'abc123';
        $string = '';
        $string1 = '';
        $string2 = '';
        $string6 = '';
        $date = date("d-m-Y");

        $AgreementUrl = $_FILES["CompanyLogo"]["name"];
        if($AgreementUrl <> "")
        {
          for($j = 0; $j < count($AgreementUrl); $j++)
          {
          for($i = 0; $i < 0; $i++) {
            $string .= $characters[rand(0, strlen($characters) - 1)];
          } 
          $AgreementPath1 = "../../mobileapi/uploads/" . $string . $AgreementUrl[$j];
          $AgreementPath = "uploads/" . $string . $AgreementUrl[$j];
            move_uploaded_file($_FILES["CompanyLogo"]["tmp_name"][$j], $AgreementPath1);
          }
        }
      

      $testseries = mysql_query("INSERT INTO `collegeslider`(`slidertitle`, `collegesliderurl`) VALUES ('$SeriesSection','$AgreementPath')");

      if ($testseries) {
        echo '<script>window.location = "collegeslider.php?categoryid='.$categoryid.'&status=1&msg=Details Saved Successfully!!"</script>';
      }else{
        echo '<script>window.location = "collegeslider.php?categoryid='.$categoryid.'&status=0&msg=Sorry Something went Wrong!!"</script>';
      }
    }
  ?>
    <style type="text/css">
      tr.odd td.sorting_1
      {
        background: #ffffff;
      }
      .breadcrumb
      {
        padding: 11px 14px;
      }
    </style>
<div id="main-content">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li><a href="#">Dashboard</a><span class="divider">&raquo;</span></li>
      <?php
        $categoryid = $_GET["categoryid"];
        $getcategoryname = mysql_query("select * from mobileappcategorieslist where categoryid='$categoryid'");
        $getcategorynamerows = mysql_fetch_assoc($getcategoryname);

      ?>
      <li class=""><a href="subcategorylist.php?edit=<?php echo $_GET["categoryid"]?>"><?php echo $getcategorynamerows["categoryname"]?></a><span class="divider">&raquo;</span></li>

      <li class="active">Sliders</li>
    </ul>

 <form class="form-horizontal well" style="background: #ffffff" method="post" action="" enctype="multipart/form-data">

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
              <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="btn btn-primary btn-md" id="" name="" style="margin-top: -5px;">Add New Slider</a>
              <a href="subcategorylist.php?edit=<?php echo $_GET["categoryid"]?>" class="btn btn-success btn-md">Go Back</a>

               <div id="collapseOne" class="panel-collapse collapseOne collapse">
                  <br>
                   <div class="row-fluid">
                      <div class="span12">

                        <div class="span3">
                          <div class="control-group">
                            <label>Slider Title</label>
                            <input type="hidden" name="categoryid" value="<?php echo $_GET["categoryid"]?>">
                            <input type="text" style="width: 100%" class="form-control SeriesSection" name="SeriesSection" id="SeriesSection_0" placeholder="Eg: Slider title here">
                            </div>
                        </div>
                        <div class="span3">
                          <div class="control-group">
                            <label>Select File</label>
                            <input type="file" style="width: 100%" name="CompanyLogo[]" id="CompanyLogo" class="form-control CompanyLogo">
                            </div>
                        </div>
                        
                    </div>
                    <div class="row-fluid">
                      <button type="submit" id="btnsubmitstream" name="btnsubmitstream" class="btn btn-info">Upload Slider</button>
                    </div>
                 </div>
                <br>
              </div>
              <table class="table table-bordered text-center data-tbl-inbox">
                <thead>
                  <tr>
                    <th class="center">SrNo</th>
                    <th class="center">Slider Title</th>
                    <th class="center">URl</th>
                    <th class="center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $count = 1;
                    $gettestseries = mysql_query("SELECT * FROM `collegeslider`");
                    while($gettestseriesrows = mysql_fetch_array($gettestseries)){

                  ?>
                  <tr>
                    <td class="center"><?php echo $count++?></td>
                    <td class="center"><?php echO $gettestseriesrows["slidertitle"]?></td>
                    <td class="center">
                      <a href="http://35.194.40.144/agentbhai/law/mobileapi/<?php echO $gettestseriesrows["collegesliderurl"]?>" target="_blank">View Photo</a>
                    </td>

                    <td class="">
                      <div class="btn-group pull-right">
                        <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-cog"></i><span class="caret"></span></button>
                        <ul class="dropdown-menu">
                          <li><a href="clatsliders.php?categoryid=<?php echo $_GET["categoryid"]?>&del=<?php echo $gettestseriesrows["collegesliderid"]?>"><i class="icon-trash"></i> Remove Image</a></li>
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
  </form>
  </div>
</div>
<?php include("footer.php");?>