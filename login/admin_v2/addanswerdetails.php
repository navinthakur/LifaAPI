<?php include("header.php");?>
<?php
    $msg = '';
    if (isset($_GET["questionid"])) {
      $questionid = $_GET["questionid"];
      $getans = mysql_query("select * from questionlist where questionid='$questionid'");
      $getansrows = mysql_fetch_assoc($getans);
      $fullanswer = $getansrows["fullanswer"];
    }
    date_default_timezone_set("Asia/Kolkata");



    if (isset($_POST["BtnSubmitDetails"])) {
      
      
      $questionid = $_POST["questionid"];
      $PrimaryTitle = $_POST["PrimaryTitle"];
      
      $PropertyQuery =  mysql_query("UPDATE `questionlist` SET `fullanswer`='$PrimaryTitle' WHERE `questionid`='$questionid'");
         
      
      if ($PropertyQuery) {
       // $msg =  '<label class="label label-success">Details Saved Successfully!!</label><br><br>';
        echo '<script>window.location = "addanswerdetails.php?current=addanswer&status=1&msg=Details Saved Successfully!!&questionid='.$questionid.'"</script>';

      }else{
        //$msg = '<label class="label label-danger">Sorry Something Went Wrong!!</label><br><br>';

        echo '<script>window.location = "index.php?current=addanswer&status=0&msg=Sorry Something went Wrong!!&questionid='.$questionid.'"</script>';
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
              <form class="form-horizontal well" method="POST" action="">
                <div class="row-fluid">
                  <input type="hidden" name="questionid" value="<?php echo $_GET["questionid"]?>">
                  <textarea name="PrimaryTitle" required="" id="inbox-editor" class="PrimaryTitle form-control textarea" placeholder="Answer  here..">
                    <?php echo $fullanswer?>
                  </textarea>

                </div>
              
              <br>
              <div class="span5"></div>
      <button type="Submit" name="BtnSubmitDetails" id="BtnSubmitDetails" class="BtnSubmitDetails btn btn-success">Submit Details</button>
              </form>

            </div>
          </div>
        </div>
      </div>

      
      
    </div>
  </div>
</div>
<?php include("footer.php");?>