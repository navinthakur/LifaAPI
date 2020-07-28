<?php include("header.php");?>

<style type="text/css">
  .breadcrumb
  {
    padding: 11px 14px;
  }
  tr.odd td.sorting_1{
    background-color: #fff;
  }
</style>
<div id="main-content">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li><a href="#">Home</a><span class="divider">&raquo;</span></li>
      <li class="active">Advocates

      </li>
    </ul>

 <form class="form-horizontal well" style="background: white" method="post" action="" enctype="multipart/form-data">

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
              Total No Of Advocates: <?php
                           $getlist = mysql_query("select * from logintbl where usertype='Advocate' order by logid desc");
                            $getlistcount = mysql_num_rows($getlist);
                            echo "<b>".$getlistcount."<b>";
                        ?>
              <table class="table table-bordered text-center data-tbl-inbox">
                <thead>
                  <tr>
                    <th class="">User</th>
                    <th class="center">Name</th>
                    <th class="center">Contact No</th>
                    <th class="center">Email Address</th>
                    <th class="center">Court</th>
                    <th class="center">Location</th>
                    <th class="center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $getlist = mysql_query("select * from logintbl where usertype='Advocate' order by logid desc");
                  $getlistcount = mysql_num_rows($getlist);
                 
                    while($getlistrows = mysql_fetch_array($getlist)){

                ?>
                  <tr>
                    <td>
                      <img src="http://35.194.40.144/agentbhai/law/mobileapi/<?php echo $getlistrows["profilepicpath"]?>" width="40" height="40" alt="User">
                      
                    </td>
                    <td class="center"><?php echo ucfirst($getlistrows["personname"])?> (<?php echo $getlistrows["courcename"]?>)</td>
                    <td class="center"><?php echo $getlistrows["mobilenumber"]?></td>
                    <td class="center"><?php echo $getlistrows["emailaddress"]?></td>
                    <td class="center"><?php echo $getlistrows["courttype"]?> </td>
                    <td class="center"> <?php echo $getlistrows["courtlocation"]?> </td>
                    <td class="center">
                      <div class="btn-group">
                          <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-cog "></i><span class="caret"></span></button>
                          <ul class="dropdown-menu">
                            <li><a href="advocatelistdetails.php?view=<?php echo $getlistrows["logid"]?>" target="_blank"><i class="icon-file"></i> Edit Details</a></li>
                            <li><a href="advocatelist.php?del=<?php echo $getlistrows["logid"]?>"><i class="icon-trash"></i> Remove Post</a></li>
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
  </form>
  </div>
</div>
<?php include("footer.php");?>