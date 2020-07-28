<?php include("../../libs/config.php");?>
<?php include("session.php");?>
<?php
  $query_user = mysql_query("select * from logintbl where logid='$user_check'");
  $row_user = mysql_fetch_assoc($query_user);
  $user_name = $row_user["personname"];
  $usertype = $row_user["usertype"];
  
  
  //$profile = $row_user["img_location"];
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
<meta charset="utf-8">
<title>LAW in First Attempt  - Admin Panel</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Law first Attempt Admin Panel">
<meta name="author" content="">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- styles -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/jquery-ui-1.8.16.custom.css" rel="stylesheet">
<link href="css/jquery.jqplot.css" rel="stylesheet">
<link href="css/prettify.css" rel="stylesheet">
<link href="css/elfinder.min.css" rel="stylesheet">
<link href="css/elfinder.theme.css" rel="stylesheet">
<link href="css/fullcalendar.css" rel="stylesheet">
<link href="js/plupupload/jquery.plupload.queue/css/jquery.plupload.queue.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<link href="css/bootstrap-responsive.css" rel="stylesheet">
<link href="css/icons-sprite.css" rel="stylesheet">
<link id="themes" href="css/themes.css" rel="stylesheet">
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="css/ie/ie7.css" />
<![endif]-->
<!--[if IE 8]>
<link rel="stylesheet" type="text/css" href="css/ie/ie8.css" />
<![endif]-->
<!--[if IE 9]>
<link rel="stylesheet" type="text/css" href="css/ie/ie9.css" />
<![endif]-->
<!--fav and touch icons -->
<!-- <link rel="shortcut icon" href="ico/favicon.ico">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png"> -->
</head>
<body>
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner top-nav">
    <div class="container-fluid">
      <div class="branding">
        <div class="logo"> <a href="index.php?current=dashboard"><h2 style="color: #ffffff">LIFA</h2></a> </div>
      </div>
      <ul class="nav pull-right">
       
        <li class="dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="#"><?php echo $user_name?> <i class="white-icons admin_user"></i><b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="logout.php"><i class="icon-off"></i><strong> Logout</strong></a></li>
          </ul>
        </li>
      </ul>
      
    </div>
  </div>
</div>
<div id="sidebar">
  <ul class="side-nav accordion_mnu collapsible">
     <li><a href="index.php"><span class="white-icons computer_imac"></span> Dashboard</a></li> 
    <li><a href="#"><span class="white-icons list"></span> Footer Pages</a>
      <ul class="acitem">
        <li><a href="joblisting.php"><span class="sidenav-icon"><span class="sidenav-link-color"></span></span>Job Listings</a></li>

        <li><a href="videos.php"><span class="sidenav-icon"><span class="sidenav-link-color"></span></span>Post Videos</a></li>
      </ul>
     </li>
     <li><a href="#"><span class="white-icons list"></span> Other Links</a>
      <ul class="acitem">
        <li><a href="dukcontent.php"><span class="sidenav-icon"><span class="sidenav-link-color"></span></span>Did You know Content</a></li>

        <li><a href="appbannerimage.php"><span class="sidenav-icon"><span class="sidenav-link-color"></span></span>Banner Image</a></li>

      </ul>
     </li>
  </ul>



  
</div>
<style>
#divLoading
{
display : none;
}
#divLoading.show
{
display : block;
position : fixed;
z-index: 100;
background-image : url('http://loadinggif.com/images/image-selection/3.gif');
background-color:#666;
opacity : 0.4;
background-repeat : no-repeat;
background-position : center;
left : 0;
bottom : 0;
right : 0;
top : 0;
}
#loadinggif.show
{
left : 50%;
top : 50%;
position : absolute;
z-index : 101;
width : 32px;
height : 32px;
margin-left : -16px;
margin-top : -16px;
}
div.content {
width : 1000px;
height : 1000px;
}
#country-list {
       float: left;
    margin-left: 2px;
    top: 60px;
    list-style: none;
    margin-top: -3px;
    padding: 0;
    width: 89%;
    position: absolute;
    text-align: left;
    z-index: 9999;
}
#country-list1 {
    float: left;
    top: 43px;
    list-style: none;
    margin-top: -3px;
    padding: 0;
    width:100%;
    position: absolute;
    text-align: left;
}
#rath-list {
    margin-left: 20%;
    width: 80%;
    float: left;
    top: 43px;
    list-style: none;
    margin-top: -3px;
    padding: 0;
    /*width: 88%;*/
    position: absolute;
    text-align: left;
}
#country-list li,#rath-list li{padding: 10px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;}
#country-list li:hover,#rath-list li:hover{background:#ece3d2;cursor: pointer;}
#country-list1 li,#rath-list li{padding: 10px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;}
#country-list1 li:hover,#rath-list li:hover{background:#ece3d2;cursor: pointer;}
#search_box{padding: 10px;border: #a8d4b1 1px solid;border-radius:4px;}
.select2-container .select2-selection--single
{
  height: 33px;
}
</style>
<div id="divLoading" style="margin: 0px; padding: 0px; position: fixed; right: 0px; top: 0px; width: 100%; height: 100%; background-color: rgb(102, 102, 102); z-index: 30001; opacity: 0.8;">
<p style="position: absolute; color: White; top: 60%; left: 45%;">
Loading, please wait...

</p>
</div>