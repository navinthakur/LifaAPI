<?php include("header.php");?>
<?php 
  if (isset($_GET["del"])) {
    $collegeid = $_GET["del"];
    $categoryid = $_GET["categoryid"];
    $subcategoryllistid = $_GET["subcategoryid"];
    $delquery = mysql_query("delete from collegedetails where collegeid='$collegeid'");
    if ($delquery) {
      echo '<script>window.location = "clatfindcollege.php?categoryid='.$categoryid.'&subcategoryid='.$subcategoryid.'&status=1&msg=Details Deleted Successfully!!"</script>';
    }else{
      echo '<script>window.location = "clatfindcollege.php?categoryid='.$categoryid.'&subcategoryid='.$subcategoryid.'&status=0&msg=Sorry Something went Wrong!!"</script>';
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

 <form class="form-horizontal" method="post" action="">

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
                  <div class="widget-content well">
                    <a href="addnewcollege.php?categoryid=<?php echo $_GET["categoryid"]?>&subcategoryid=<?php echo $_GET["subcategoryid"]?>" class="btn btn-info">Add New College</a>
                    <table class="data-tbl-inbox table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th class="center"> College Name </th>
                          <th class="center"> University Name </th>
                          <th class="center"> Contact No </th>
                          <th class="center"> Email ID </th>
                          <th class="center"> Location </th>
                          <th class="center"> Status </th>
                          <th class="center"> Action </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $getcollege = mysql_query("select * from collegedetails");
                        while($getcollegerows = mysql_fetch_array($getcollege)){


                        ?>
                        <tr>
                          <td><a href="updatecollegedetails.php?view=<?php echo $getcollegerows["collegeid"]?>"><?php echo $getcollegerows["collegename"]?></a></td>
                          <td><?php echo $getcollegerows["universityname"]?></td>
                          <td class="center"> <?php echo $getcollegerows["collegecontactno"]?> </td>
                          <td class="center"><?php echo $getcollegerows["collegeemailid"]?></td>
                          <td class="center"><?php echo $getcollegerows["collegestaterefname"]?></td>
                          <td class="center"><?php echo $getcollegerows["collegestatus"]?></td>
                          <td>
                            <div class="btn-group pull-right">
                              <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-cog "></i><span class="caret"></span></button>
                              <ul class="dropdown-menu">
                                <li><a href="updatecollegedetails.php?categoryid=<?php echo $_GET["categoryid"]?>&subcategoryid=<?php echo $_GET["subcategoryid"]?>&view=<?php echo $getcollegerows["collegeid"]?>"><i class="icon-file"></i> View/Edit Details</a></li>
                                <li><a href="clatfindcollege.php?categoryid=<?php echo $_GET["categoryid"]?>&subcategoryid=<?php echo $_GET["subcategoryid"]?>&del=<?php echo $getcollegerows["collegeid"]?>"><i class="icon-trash"></i> Remove College</a></li>
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
  </form>
  </div>
</div>
<?php include("footer.php");?>