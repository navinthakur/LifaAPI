<?php
    include("libs/config.php");
?>
<!DOCTYPE html>
    <html lang="en">

    
<!-- Mirrored from www.shreethemes.in/landrick/layouts/page-comingsoon.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 10 May 2020 08:25:58 GMT -->
<head>
        <meta charset="utf-8" />
        <title>LIFA || Law in First Attempt</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="author" content="" />
        <meta name="Version" content="1.0" />
        <!-- favicon 
        <link rel="shortcut icon" href="images/favicon.ico">-->
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Icons -->
        <link href="css/materialdesignicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Main Css -->
        <link href="css/style.css" rel="stylesheet" type="text/css" id="theme-opt" />
        <link href="css/colors/default.css" rel="stylesheet" id="color-opt">

    </head>

    <body>
        <!-- Loader -->
        <div id="preloader">
            <div id="status">
                <div class="spinner">
                    <div class="double-bounce1"></div>
                    <div class="double-bounce2"></div>
                </div>
            </div>
        </div>
        <!-- Loader -->

       <!--  <div class="back-to-home rounded d-none d-sm-block">
            <a href="index.html" class="text-white title-dark rounded d-inline-block text-center"><i data-feather="home" class="fea icon-sm"></i></a>
        </div> -->
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
</style>
<div id="divLoading" style="margin: 0px; padding: 0px; position: fixed; right: 0px; top: 0px; width: 100%; height: 100%; background-color: rgb(102, 102, 102); z-index: 30001; opacity: 0.8;">
<p style="position: absolute; color: White; top: 60%; left: 45%;">
Loading, please wait...

</p>
</div>
