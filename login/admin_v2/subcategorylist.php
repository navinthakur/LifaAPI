<?php include("header.php");?>
<?php include("../../encrypte.php")?>
<style type="text/css">
  tr.odd td.sorting_1{
    background-color: #ffffff;
  }
</style>
<?php

if (isset($_GET["delsubcategoryid"])) {
  $delsubcategoryid = $_GET["delsubcategoryid"];
  $edit = $_GET["edit"];

  $delquery = mysql_query("DELETE from subcategorylist where subcategoryllistid='$delsubcategoryid'");
  if ($delquery) {
      echo '<script>window.location = "subcategorylist.php?edit='.$edit.'&status=1&msg=Details Deleted Successfully!!"</script>';
    }else{
      echo '<script>window.location = "subcategorylist.php?edit='.$edit.'&status=0&msg=Sorry Something went Wrong!!"</script>';
    }

}

    if (isset($_POST["BtnSubmitDetails"])) {

      $categoryid = $_POST["categoryid"];
      $SubCategoryTitle = $_POST["SubCategoryTitle"];
      $tableref = str_replace(" ", "",$SubCategoryTitle);
      $pagenameref  = $tableref.".php";
      mysql_query("CREATE TABLE tbl$tableref (
            id INT(11) NOT NULL  AUTO_INCREMENT PRIMARY KEY,
            content text
            )ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1");

      mysql_query("INSERT INTO tbl$tableref (content) values('')");
      copy('defaultpage.php',$pagenameref);  


      $addcategory = mysql_query("INSERT INTO `subcategorylist`(`subcategoryname`, `subcategoryimage`,`subcategorypagename`,`subcategorytablename`, `categoryrefid`, `subcategorytype`, `subcategorystatus`) VALUES ('$SubCategoryTitle','images/subcategory.jpg','$pagenameref','tbl$tableref','$categoryid','student','1')");
      if ($addcategory) {
        echo '<script>window.location = "subcategorylist.php?edit='.$categoryid.'&status=1&msg=Details Saved Successfully!!"</script>';
      }else{
        echo '<script>window.location = "subcategorylist.php?edit='.$categoryid.'&status=0&msg=Sorry Something went Wrong!!"</script>';
      }
    }
?>
<div id="main-content">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li><a href="index.php">Dashboard</a><span class="divider">&raquo;</span></li>
      <?php
        $categoryid = $_GET["edit"];
        $getcategoryname = mysql_query("select * from mobileappcategorieslist where categoryid='$categoryid'");
        $getcategorynamerows = mysql_fetch_assoc($getcategoryname);

      ?>
      <li class="active"><?php echo $getcategorynamerows["categoryname"]?></li>
    </ul>
    <form method="post" class="well" style="background: #ffffff" action="" enctype="multipart/form-data">
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
       <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="btn btn-primary btn-md" id="" name="" style="margin-top: -5px;">Add New SubCategory</a>
         <div id="collapseOne" class="panel-collapse collapseOne collapse">
          <br>


          <div class="row-fluid">
              <div class="span12">
                <div class="span3">
                  <div class="control-group">
                    <label>Sub Cateogory Title</label>
                    <input type="hidden" name="categoryid" value="<?php echo $_GET["edit"]?>"/>
                    <input type="text" style="width: 100%" name="SubCategoryTitle" id="SubCategoryTitle" class="SubCategoryTitle" placeholder="Sub-Category Title here.." >
                  </div>
                </div>                      
              </div>
            </div>
            <div class="row-fluid">
              <button type="Submit" name="BtnSubmitDetails" id="BtnSubmitDetails" class="btn btn-info">Submit Details</button>
            </div>
          </div>

          <?php
            if (isset($_POST["BtnUpdateDetails"])) {
              $subcategoryid  = $_POST["subcategoryid"];
              $edit = $_POST["edit"];
              $UpdateSubCategoryTitle = $_POST["UpdateSubCategoryTitle"];

              $updatequery = mysql_query("UPDATE `subcategorylist` SET `subcategoryname`='$UpdateSubCategoryTitle' WHERE `subcategoryllistid`='$subcategoryid'");
              if ($updatequery) {
                echo '<script>window.location = "subcategorylist.php?edit='.$edit.'&status=1&msg=Details Updated Successfully!!"</script>';
              }else{
                echo '<script>window.location = "subcategorylist.php?edit='.$edit.'&status=0&msg=Sorry Something went Wrong!!"</script>';
              }
            }

            if (isset($_GET["subcategoryid"])) {
              $subcategoryid = $_GET["subcategoryid"];
              $getdetails = mysql_query("select * from subcategorylist where subcategoryllistid='$subcategoryid'");
              $getdetailsrows = mysql_fetch_assoc($getdetails);

          ?>
          <bR>
          <div class="row-fluid">
              <div class="span12">
                <div class="span3">
                  <div class="control-group">
                    <label>Sub Cateogory Title</label>
                    <input type="hidden" name="subcategoryid" value="<?php echo $_GET["subcategoryid"]?>"/>
                    <input type="hidden" name="edit" value="<?php echo $_GET["edit"]?>"/>
                    <input type="text" style="width: 100%" name="UpdateSubCategoryTitle" id="UpdateSubCategoryTitle" class="UpdateSubCategoryTitle" placeholder="Sub-Category Title here.." value="<?php echo $getdetailsrows["subcategoryname"]?>" >
                  </div>
                </div>                      
              </div>
            </div>
            <div class="row-fluid">
              <button type="Submit" name="BtnUpdateDetails" id="BtnUpdateDetails" class="btn btn-info">Submit Details</button>
            </div>

          <?php
            }
          ?>
          
          </div>
       </form>   
       <div class="dashboard-widget">
        <div class="">
          <?php 
            $categoryid = $_GET["edit"];
            if ($categoryid == "1") {
              ?>
              <div class="span2">
                <div class="dashboard-wid-wrap">
                  <div class="dashboard-wid-content"> <a href="clatsliders.php?categoryid=<?php echo $_GET["edit"]?>"> <i class="dashboard-icons-colors graphic_design_sl"></i>  <span class="dasboard-icon-title">SLIDER</span> </a> </div>
                </div>
              </div>
          <?php
            }else if ($categoryid == "2") {
            ?>
            <div class="span2">
              <div class="dashboard-wid-wrap">
                <div class="dashboard-wid-content"> <a href="collegeslider.php?categoryid=<?php echo $_GET["edit"]?>"> <i class="dashboard-icons-colors graphic_design_sl"></i> <span class="dasboard-icon-title">SLIDER</span> </a> </div>
              </div>
            </div>
            <?php
            }
          ?>
          <?php
              $categoryid = $_GET["edit"];
              $getfaq = mysql_query("select * from subcategorylist where (categoryrefid='$categoryid')");
              $getfaqcount = mysql_num_rows($getfaq);
              if ($getfaqcount > 0) {
                while($getfaqrows = mysql_fetch_array($getfaq)){
          ?>
          <div class="span2">
            <div class="dashboard-wid-wrap">
              <div class="dashboard-wid-content"> 
                 <div class="btn-group pull-right">
                    <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-cog"></i><span class="caret"></span></button>
                    <ul class="dropdown-menu">
                      <li><a href="subcategorylist.php?subcategoryid=<?php echo $getfaqrows["subcategoryllistid"]?>&edit=<?php echo  $_GET["edit"]?>" style="padding: 5px"><i class="icon-edit"></i> View/Edit Details</a></li>
                      <li><a href="subcategorylist.php?delsubcategoryid=<?php echo $getfaqrows["subcategoryllistid"]?>&edit=<?php echo  $_GET["edit"]?>" style="padding: 5px"><i class="icon-trash"></i> Remove </a></li>
                    </ul>

                  </div>
                <a href="<?php echo $getfaqrows["subcategorypagename"]?>?categoryid=<?php echo $_GET["edit"]?>&subcategoryid=<?php echo $getfaqrows["subcategoryllistid"]?>"> 
                  <i class="dashboard-icons-colors graphic_design_sl"></i> 
                  <span class="dasboard-icon-title"><?php echo $getfaqrows["subcategoryname"]?></span> 
                </a> 

              </div>

             
            </div>
          </div>
          <?php
              }
            }else{
          ?>
          <div class="alert alert-error fade in">
            <button data-dismiss="alert" class="close" type="button">×</button>
            <strong>Oh snap!</strong> No Sub - Category Found!!.
          </div>
          <?php
            }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include("footer.php");?>