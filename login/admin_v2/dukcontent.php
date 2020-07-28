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
        $contentanswer = $_POST["contentanswer"];
        $contentaddeddate = date("d-m-Y H:i:s");
       
        $testseries = mysql_query("INSERT INTO `tbldidyouknowcontent`(`contentheading`, `contentanswer`,`contentaddeddate`) VALUES ('$SeriesSection','$contentanswer','$contentaddeddate')");

        if ($testseries) {
          echo '<script>window.location = "dukcontent.php?status=1&msg=Details Saved Successfully!!"</script>';
        }else{
          echo '<script>window.location = "dukcontent.php?status=0&msg=Sorry Something went Wrong!!"</script>';
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
      <li class="active">Did you know </li>
    </ul>

 <form class="form-horizontal well" style="background: #ffffff" method="post" action="" enctype="multipart/form-data">

<?php
              if (isset($_POST["btnupdatestream"])) {
                $contentid = $_POST["contentid"];
                $UpdateSeriesSection = $_POST["UpdateSeriesSection"];
                $Updatecontentanswer = $_POST["Updatecontentanswer"];

                $updatequery = mysql_query("UPDATE `tbldidyouknowcontent` SET `contentheading`='$UpdateSeriesSection',`contentanswer`='$Updatecontentanswer' WHERE `contentid`='$contentid'");
                if ($updatequery) {
                  echo '<script>window.location = "dukcontent.php?status=1&msg=Details Updated Successfully!!"</script>';
                }else{
                  echo '<script>window.location = "dukcontent.php?status=0&msg=Sorry Something went Wrong!!"</script>';
                }
              }
                if (isset($_GET["edit"])) {
                  $contentid = $_GET["edit"];
                  $getcontent = mysql_query("select * from tbldidyouknowcontent where contentid='$contentid'");
                  $getcontentrows = mysql_fetch_assoc($getcontent);
                  $contentheading = $getcontentrows["contentheading"];
                  $contentanswer = $getcontentrows["contentanswer"];
              ?>
                
              <div class="row-fluid">
                <div class="span12">
                  <div class="span3">
                    <div class="control-group">
                      <label>Heading</label>
                      <input type="hidden" name="contentid" id="contentid" value="<?php echo $_GET["edit"]?>">
                      <input type="text" style="width: 100%" class="form-control UpdateSeriesSection" name="UpdateSeriesSection" id="UpdateSeriesSection_0" placeholder="Eg: Main heading here.." value="<?php echo $contentheading?>">
                      </div>
                  </div>
                  <div class="span3">
                    <div class="control-group">
                      <label>Answer (Optional)</label>
                      <input type="text" style="width: 100%" name="Updatecontentanswer" id="Updatecontentanswer" class="form-control Updatecontentanswer" placeholder="Enter Answer here.. (Optional)" value="<?php echo $contentanswer?>">
                      </div>
                  </div>
              </div>
              <div class="row-fluid">
                <button type="submit" id="btnupdatestream" name="btnupdatestream" class="btn btn-info">Submit Details</button>
              </div>
          </div>
          <?php
            }
          ?>
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
              <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="btn btn-primary btn-md" id="" name="" style="margin-top: -5px;">Add New Content</a>
              <a href="clattutorialsmain.php" class="btn btn-success btn-md">Go Back</a>

               <div id="collapseOne" class="panel-collapse collapseOne collapse">
                  <br>
                   <div class="row-fluid">
                      <div class="span12">

                        <div class="span3">
                          <div class="control-group">
                            <label>Heading</label>
                            <input type="text" style="width: 100%" class="form-control SeriesSection" name="SeriesSection" id="SeriesSection_0" placeholder="Eg: Main heading here..">
                            </div>
                        </div>
                        <div class="span3">
                          <div class="control-group">
                            <label>Answer (Optional)</label>
                            <input type="text" style="width: 100%" name="contentanswer" id="contentanswer" class="form-control contentanswer" placeholder="Enter Answer here.. (Optional)">
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
                    <th class="center">Heading</th>
                    <th class="center">Answer</th>
                    <th class="center">Added Date</th>
                    <th class="center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $count = 1;
                    $gettestseries = mysql_query("SELECT * FROM `tbldidyouknowcontent`");
                    while($gettestseriesrows = mysql_fetch_array($gettestseries)){

                  ?>
                  <tr>
                    <td class="center"><?php echo $count++?></td>
                    <td class="center"><?php echO $gettestseriesrows["contentheading"]?></td>
                    <td class="center">
                      <?php echo $gettestseriesrows["contentanswer"]?>
                    </td>
                    <td class="center">
                      <?php echo $gettestseriesrows["contentaddeddate"]?>
                    </td>

                    <td class="">
                      <div class="btn-group pull-right">
                        <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-cog"></i><span class="caret"></span></button>
                        <ul class="dropdown-menu">
                          <li><a href="dukcontent.php?edit=<?php echo $gettestseriesrows["contentid"]?>"><i class="icon-edit"></i> View/Edit Post</a></li>
                          <li><a href="dukcontent.php?del=<?php echo $gettestseriesrows["contentid"]?>"><i class="icon-trash"></i> Remove Content</a></li>
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
  </form>
  </div>
</div>
<?php include("footer.php");?>