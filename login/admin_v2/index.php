<?php include("header.php");?>
<?php include("../../encrypte.php")?>
<style type="text/css">
  tr.odd td.sorting_1{
    background-color: #ffffff;
  }
</style>
<?php
  $message = '';
  /* on form submission */
  if(isset($_POST['do_submit']))  {
    /* split the value of the sortation */
    $ids = explode(',',$_POST['sort_order']);
    /* run the update query for each id */
    foreach($ids as $index=>$id) {
      $id = (int) $id;
      if($id != '') {
        $query = 'UPDATE mobileappcategorieslist SET categoryorder = '.($index + 1).' WHERE categoryid = '.$id;
        $result = mysql_query($query) or die(mysql_error().': '.$query);
      }
    }
    
    /* now what? */
    if($_POST['byajax']) { die(); } else { $message = 'Sortation has been saved.'; }
  }


  $query = 'SELECT categoryid, categoryname,categorypagelink FROM mobileappcategorieslist order by cast(categoryorder as unsigned) ASC';
  $result = mysql_query($query) or die(mysql_error().': '.$query);
  if(mysql_num_rows($result)) {

  if (isset($_GET["del"])) {
    $categoryid = $_GET["del"];
    $delque = mysql_query("DELETE FROM `mobileappcategorieslist` WHERE categoryid='$categoryid'");
    if ($delque) {
      echo '<script>window.location = "index.php?current=videos&status=1&msg=Details Deleted Successfully!!"</script>';
    }else{
      echo '<script>window.location = "index.php?current=videos&status=0&msg=Sorry Something went Wrong!!"</script>';
    }
  }

    if (isset($_POST["BtnSubmitDetails"])) {
      $VideoHeading = $_POST["VideoHeading"];
      $characters = 'abc123';
      $string = '';
      $string1 = '';
      $string2 = '';
      $string6 = '';
      $date = date("d-m-Y");
      $AgreementUrl = $_FILES["VideoThumbnail"]["name"];
      if($AgreementUrl <> "")
      {
        for($j = 0; $j < count($AgreementUrl); $j++)
        {
        for($i = 0; $i < 0; $i++) {
          $string .= $characters[rand(0, strlen($characters) - 1)];
        } 
        $AgreementPath1 = "../../mobileapi/uploads/" . $string . $AgreementUrl[$j];
        $VideoThumbnailPath = "uploads/" . $string . $AgreementUrl[$j];
          move_uploaded_file($_FILES["VideoThumbnail"]["tmp_name"][$j], $AgreementPath1);
        }
      }

      $addvideo = mysql_query("INSERT INTO `mobileappcategorieslist`(`categorytype`, `categoryname`, `categoryimage`, `categoryorder`, `categorystatus`) VALUES ('student','$VideoHeading','$VideoThumbnailPath','1','1')");
      if ($addvideo) {
          echo '<script>window.location = "index.php?current=videos&status=1&msg=Details Saved Successfully!!"</script>';

        }else{
          echo '<script>window.location = "index.php?current=videos&status=0&msg=Sorry Something went Wrong!!"</script>';
        }
      }

?>
<div id="main-content">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li><a href="index.php">Dashboard</a></li>
    </ul>
    <div class="dashboard-widget">
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
          <?php
          if (isset($_POST["BtnUpdateDetails"])) {
           $categoryid = $_POST["categoryid"];
           $UpdateVideoHeading = $_POST["UpdateVideoHeading"];
           $iscompanylogoselected = $_POST["iscompanylogoselected"];

           if ($iscompanylogoselected == "1") {
             $characters = 'abc123';
              $string = '';
              $string1 = '';
              $string2 = '';
              $string6 = '';
              $date = date("d-m-Y");
              $AgreementUrl = $_FILES["UpdateCompanyLogo"]["name"];
              if($AgreementUrl <> "")
              {
                for($j = 0; $j < count($AgreementUrl); $j++)
                {
                for($i = 0; $i < 0; $i++) {
                  $string .= $characters[rand(0, strlen($characters) - 1)];
                } 
                $AgreementPath1 = "../../mobileapi/uploads/" . $string . $AgreementUrl[$j];
                $VideoThumbnailPath = "uploads/" . $string . $AgreementUrl[$j];
                  move_uploaded_file($_FILES["UpdateCompanyLogo"]["tmp_name"][$j], $AgreementPath1);
                }
              }
              // Update Icon
              mysql_query("UPDATE `mobileappcategorieslist` SET `categoryimage`='$VideoThumbnailPath' WHERE `categoryid`='$categoryid'");
           }

            $updatevideo = mysql_query("UPDATE `mobileappcategorieslist` SET `categoryname`='$UpdateVideoHeading' WHERE `categoryid`='$categoryid'");


              if ($updatevideo) {
                  echo '<script>window.location = "index.php?current=videos&status=1&msg=Details Saved Successfully!!"</script>';

                }else{
                  echo '<script>window.location = "index.php?current=videos&status=0&msg=Sorry Something went Wrong!!"</script>';
                }
          }
            if (isset($_GET["view"])) {
              $categoryid = $_GET["view"];
              $getdetails = mysql_query("select * from mobileappcategorieslist where categoryid='$categoryid'");
              $getdetailsrows = mysql_fetch_assoc($getdetails);
            ?>
              <form method="post" action="" enctype="multipart/form-data">
              <div class="row-fluid">
                  <div class="span12">
                    <div class="span3">
                      <div class="control-group">
                        <label>Heading</label>
                        <input type="hidden" name="categoryid" value="<?php echo $_GET["view"]?>">
                        <input type="text" style="width: 100%" name="UpdateVideoHeading" id="UpdateVideoHeading" class="UpdateVideoHeading" placeholder="Heading here.." value="<?php echo $getdetailsrows["categoryname"]?>" >
                      </div>
                    </div>
                    <div class="span4">
                      <div class="control-group">
                        <label>Upload Icon</label>
                        <input type="file" style="width: 100%" name="UpdateCompanyLogo[]" id="file" class="file">
                        <a href="../../mobileapi/<?php echo $getdetailsrows["categoryimage"]?>" target="_blank" >View Icon</a>
                        <input type="hidden" name="iscompanylogoselected" id="iscompanylogoselected" value="0">
                      </div>
                    </div>                       
                  </div>
                </div>
                <div class="row-fluid">
                  <button type="Submit" name="BtnUpdateDetails" id="BtnUpdateDetails" class="btn btn-info">Submit Details</button>
                </div>
              </form>
          <?php
            }
          ?>
           <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="btn btn-primary btn-md" id="" name="" style="margin-top: -5px;">Add New Option</a>
          <div id="collapseOne" class="panel-collapse collapseOne collapse">
                <br>      
            <form method="post" action="" enctype="multipart/form-data">
              <div class="row-fluid">
                  <div class="span12">
                    <div class="span3">
                      <div class="control-group">
                        <label>Heading</label>
                        <input type="text" style="width: 100%" name="VideoHeading" id="VideoHeading" class="VideoHeading" placeholder="Heading here.." >
                      </div>
                    </div>
                    <div class="span3">
                      <div class="control-group">
                        <label>Upload Icon</label>
                        <input type="file" style="width: 100%" name="VideoThumbnail[]" id="file" class="file">
                      </div>
                    </div>                       
                  </div>
                </div>
                <div class="row-fluid">
                  <button type="Submit" name="BtnSubmitDetails" id="BtnSubmitDetails" class="btn btn-info">Submit Details</button>
                </div>
              </form>
          </div>



                  <style type="text/css">
                #sortable-list    { padding:0; }
                #sortable-list li { padding:22px 8px; color:#000; cursor:move; list-style:none; width:300px; background:#ddd; margin:10px 0; border:1px solid #999;display: inline-block; }
                #message-box    { background:#fffea1; border:2px solid #fc0; padding:4px 8px; margin:0 0 14px 0; width:500px; }
                #sortable-list span{
                  cursor:default; 
                }
                </style>
                <div class="row-fluid">
                    <form id="dd-form" method="post" action="" >
                <p>Drag and drop the elements below.  The database gets updated on every drop.</p>
                <div id="message-box"><?php echo $message; ?> Waiting for sortation submission...</div>
                <div class="row-fluid">
                  <div class="span6">
                    <div class="span10">
                    <div class="control-group">
                        
                        <div class="controls">
                          <label class="checkbox" for="autoSubmit">
                          <input type="checkbox" value="1" name="autoSubmit" id="autoSubmit" <?php if(isset($_POST['autoSubmit'])) { echo 'checked="checked"'; }?> >
                          Automatically submit on drop event</label>
                         
                        </div>
                      </div>
                  </div>
                  <div class="span2">
                    <div class="pull-right">
                      <input type="submit" name="do_submit" value="Submit Sortation" class="btn btn-info" />
                    </div>
                  </div>
                    
                  </div>
                </div>

                   
                    <ul id="sortable-list">

                    <?php 
                        $order = array();
                        while($item = mysql_fetch_assoc($result)) {
                          $order[] = $item['categoryid'];
                      ?>
                        <li  title="<?php echo $item['categoryid']?>" >
                          <a href="<?php echo $item['categorypagelink']?>?edit=<?php echo $item['categoryid']?>">
                            <b>  <?php echo $item['categoryname']?></b>
                          </a>
                            <div class="btn-group pull-right">
                              <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-cog"></i><span class="caret"></span></button>
                              <ul class="dropdown-menu">
                                <li style="padding:0px;background: none;border: none;width: 100%;cursor: auto;margin: 2px 0px;display: block;"><a href="index.php?view=<?php echo $item["categoryid"]?>"><i class="icon-edit"></i> View/Edit Details</a></li>
                                <li style="padding:0px;background: none;border: none;width: 100%;cursor: auto;margin: 2px 0px;display: block;"><a href="index.php?del=<?php echo $item["categoryid"]?>"><i class="icon-trash"></i> Remove </a></li>
                              </ul>

                            </div>
                          
                        </li>
                       <?php 
                     }
                      ?>
                    </ul>
                <br />
                  <input type="hidden" name="sort_order" id="sort_order" value="<?php echo implode(',',$order); ?>" />
                  <?php } else { ?>
  
                      <p>Sorry!  There are no items in the system.</p>
                      
                    <?php } ?>

                    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
                    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
                    <script type="text/javascript">
                    /* when the DOM is ready */
                    jQuery(document).ready(function() {
                      /* grab important elements */
                      var sortInput = jQuery('#sort_order');
                      var submit = jQuery('#autoSubmit');
                      var messageBox = jQuery('#message-box');
                      var list = jQuery('#sortable-list');
                      /* create requesting function to avoid duplicate code */
                      var request = function() {
                        jQuery.ajax({
                          beforeSend: function() {
                            messageBox.text('Updating the sort order in the database.');
                          },
                          complete: function() {
                            messageBox.text('Database has been updated.');
                          },
                          data: 'sort_order=' + sortInput[0].value + '&ajax=' + submit[0].checked + '&do_submit=1&byajax=1', //need [0]?
                          type: 'post',
                          url: 'appdashboardlist.php'
                        });
                      };
                      /* worker function */
                      var fnSubmit = function(save) {
                        var sortOrder = [];
                        list.children('li').each(function(){
                          sortOrder.push(jQuery(this).data('id'));
                        });
                        sortInput.val(sortOrder.join(','));
                        console.log(sortInput.val());
                        if(save) {
                          request();
                        }
                      };
                      /* store values */
                      list.children('li').each(function() {
                        var li = jQuery(this);
                        li.data('id',li.attr('title')).attr('title','');
                      });
                      /* sortables */
                      list.sortable({
                        opacity: 0.7,
                        update: function() {
                          fnSubmit(submit[0].checked);
                        }
                      });
                      list.disableSelection();
                      /* ajax form submission */
                      jQuery('#dd-form').bind('submit',function(e) {
                        if(e) e.preventDefault();
                        fnSubmit(true);
                      });
                    });
                    </script>
                  </form>
                  </div>
                </div>
    <div class="nonboxy-widget">
      <div class="widget-head">
        <h5> Contact Form Response</h5>
      </div>
    </div>
    <div class="well" style="background: #ffffff">

    <table class="table table-bordered text-center data-tbl-inbox">
        <thead>
          <tr>
            <th class="center">SrNo</th>
            <th class="center">Name</th>
            <th class="center">Mobile No</th>
            <th class="center">Email ID</th>
            <th class="center">Message</th>
            <th class="center">Request Date</th>
            
          </tr>
        </thead>
        <tbody>
          <?php 
          $count = 1;
          $getjoblist = mysql_query("select * from tblcontactform order by contactid desc");
          while($getjoblistrows = mysql_fetch_array($getjoblist)){

          ?>
          <tr>
            <td class="center"><?php echo $count++?></td>
            <td class="center"><?php echo Decrypt($getjoblistrows["contactpersonname"])?></td>
            <td class="center"><?php echo Decrypt($getjoblistrows["contactmobileno"])?></td>
            <td class="center"><?php echo Decrypt($getjoblistrows["contactemail"])?></td>
            <td class="center"><?php echo Decrypt($getjoblistrows["contactcomments"])?></td>
            <td class="center"><?php echo $getjoblistrows["requestsubmitdate"]?></td>
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
<?php include("footer.php");?>