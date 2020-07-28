<?php include("header.php");?>
  <?php

  if (isset($_GET["del"])) {
    $seriesid = $_GET["del"];
    $delquery = mysql_query("delete from tbldidyouknowcontent where contentid='$seriesid'");
    if ($delquery) {
       echo '<script>window.location = "dukcontent.php?status=1&msg=Image Deleted Successfully!!"</script>';
    }else{
       echo '<script>window.location = "dukcontent.php?status=0&msg=Sorry Something went Wrong!!"</script>';
    }
  }

    if (isset($_POST["btnsubmitstream"])) {
        date_default_timezone_set("Asia/Kolkata");
        $SeriesSection = $_POST["SeriesSection"];
        $contentaddeddate = date("d-m-Y H:i:s");
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
       
        $testseries = mysql_query("UPDATE `tbladvertisementbanner` SET `bannertitle`='$SeriesSection',`bannerurl`='$AgreementPath',`banneraddeddate`='$contentaddeddate'");

        if ($testseries) {
          echo '<script>window.location = "appbannerimage.php?status=1&msg=Details Saved Successfully!!"</script>';
        }else{
          echo '<script>window.location = "appbannerimage.php?status=0&msg=Sorry Something went Wrong!!"</script>';
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
      <li><a href="#">Home</a><span class="divider">&raquo;</span></li>
      <li class="active">App Banner Image </li>
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
              <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="btn btn-primary btn-md" id="" name="" style="margin-top: -5px;">Update Banner Image</a>
              

               <div id="collapseOne" class="panel-collapse collapseOne collapse">
                  <br>
                   <div class="row-fluid">
                      <div class="span12">

                        <div class="span3">
                          <div class="control-group">
                            <label>Title</label>
                            <input type="text" style="width: 100%" class="form-control SeriesSection" name="SeriesSection" id="SeriesSection_0" placeholder="Eg: Main heading here..">
                            </div>
                        </div>
                        <div class="span3">
                          <div class="control-group">
                            <label>Image</label>
                            <input type="file" style="width: 100%" name="bannerimage[]" id="bannerimage" class="form-control bannerimage">
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                      <button type="submit" id="btnsubmitstream" name="btnsubmitstream" class="btn btn-info">Submit Details</button>
                    </div>
                 </div>
                <br>
              </div>
              <table class="table table-bordered text-center data-tbl-inbox">
                <thead>
                  <tr>
                    <th class="center">SrNo</th>
                    <th class="center">Title</th>
                    <th class="center">Image</th>
                    <th class="center">Uploaded Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $count = 1;
                    $gettestseries = mysql_query("SELECT * FROM `tbladvertisementbanner`");
                    while($gettestseriesrows = mysql_fetch_array($gettestseries)){
                  ?>
                  <tr>
                    <td class="center"><?php echo $count++?></td>
                    <td class="center"><?php echO $gettestseriesrows["bannertitle"]?></td>
                    <td class="center">
                      
                      <a href="../mobileapi/<?php echo $gettestseriesrows["bannerurl"]?>" target="_blank"><span class="dashboard-icons-colors photography_sl"></span></a>
                    </td>
                    <td class="center">
                      <?php echo $gettestseriesrows["banneraddeddate"]?>
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
  </form>
  </div>
</div>
<?php include("footer.php");?>