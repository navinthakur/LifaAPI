<?php include("header.php");?>
<?php
  if (isset($_GET["view"])) {
    $legalwordid = $_GET["view"];
    $getdetails = mysql_query("select * from tbllegalwords where legalwordid='$legalwordid'");
    $getdetailsrows = mysql_fetch_assoc($getdetails);

    $legalwordsalphabet = $getdetailsrows["alphabettype"];
    $languagetype = $getdetailsrows["wordlanguagetype"];
    $wordtitle = $getdetailsrows["wordtitle"];
    $worddescription = $getdetailsrows["worddescription"];

  }

    $msg = '';
    date_default_timezone_set("Asia/Kolkata");
   
    if (isset($_POST["BtnSubmitDetailsLegalMaxims"])) {
      
      
      $legalwordsalphabet = $_POST["legalmaximssalphabet"];    
      // Owner Count
      $itemcount = count($_POST["LMitem_no"]);
      $ChapterTitle = $_POST["LMChapterTitle"];
      $ChapterExplanation = $_POST["LMChapterExplanation"];
      $languagetype = $_POST["legalmaximslanguagetype"];
      
       for($i = 0; $i < $itemcount; $i++){
           $PropertyQuery = mysql_query("INSERT INTO `tbllegalmaxims`(`alphabettype`,`wordlanguagetype`, `wordtitle`, `worddescription`) VALUES ('$legalwordsalphabet','$languagetype','$ChapterTitle[$i]','$ChapterExplanation[$i]')");
        }
      
        if ($PropertyQuery) {
         // $msg =  '<label class="label label-success">Details Saved Successfully!!</label><br><br>';
          echo '<script>window.location = "legalwords.php?current=legalmaxims&legalmaximsalphabet='.$legalwordsalphabet.'&legalmaximslanguagetype='.$languagetype.'&status=1&msg=Details Saved Successfully!!"</script>';

        }else{
          //$msg = '<label class="label label-danger">Sorry Something Went Wrong!!</label><br><br>';

          echo '<script>window.location = "legalwords.php?current=legalmaxims&legalmaximsalphabet='.$legalwordsalphabet.'&legalmaximslanguagetype='.$languagetype.'&status=0&msg=Sorry Something went Wrong!!"</script>';
        }
      
    }
    ?>
<?php
    $msg = '';
    date_default_timezone_set("Asia/Kolkata");
   
    if (isset($_POST["BtnSubmitDetailsLegalTerms"])) {
      $legalwordid = $_POST["legalwordid"];
      $legalwordsalphabet = $_POST["legalwordsalphabet"];    
      $languagetype = $_POST["languagetype"];
      $ChapterTitle = $_POST["ChapterTitle"];
      $ChapterExplanation = $_POST["ChapterExplanation"];

      $PropertyQuery = mysql_query("UPDATE `tbllegalwords` SET `alphabettype`='$legalwordsalphabet',`wordlanguagetype`='$languagetype',`wordtitle`='$ChapterTitle',`worddescription`='$ChapterExplanation' WHERE `legalwordid`='$legalwordid'");
       
      
        if ($PropertyQuery) {
         // $msg =  '<label class="label label-success">Details Saved Successfully!!</label><br><br>';
          echo '<script>window.location = "legaltermsview.php?view='.$legalwordid.'&status=1&msg=Details Updated Successfully!!"</script>';

        }else{
          //$msg = '<label class="label label-danger">Sorry Something Went Wrong!!</label><br><br>';

          echo '<script>window.location = "legalwords.php?view='.$legalwordid.'&status=0&msg=Sorry Something went Wrong!!"</script>';
        }
      
    }
    ?>
<div id="main-content">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li><a href="#">Home</a><span class="divider">&raquo;</span></li>
      <li class="active">Legal Words</li>
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
                <strong>Oh snap!</strong> '.$msg.'.
              </div><br><br>';
                }

              }
              echo '';
              ?>
          <div class="widget-content">
            <div class="widget-box">

              <div class="box-tab">
                <div class="tabbable"> 
                  
                  <div class="tab-content">
                    
                    <form class="" method="post" action="">
                        <div class="">
                            <br>
                            <div class="">
                              <div class="span3">
                                <div class="control-group">
                                  <select class="form-control legalwordsalphabet" name="legalwordsalphabet" id="legalwordsalphabet" style="width: 100%">
                                          <?php
                                         
                                            if ($legalwordsalphabet == "" || $legalwordsalphabet == null) {
                                              $noalphabet = 'selected';
                                              $aalpha = '';
                                              $balpha = '';
                                              $calpha = '';
                                              $dalpha = '';
                                              $ealpha = '';
                                              $falpha = '';
                                              $galpha = '';
                                              $halpha = '';
                                              $ialpha = '';
                                              $jalpha = '';
                                              $kalpha = '';
                                              $lalpha = '';
                                              $malpha = '';
                                              $nalpha = '';
                                              $oaplha = '';
                                              $palpha = '';
                                              $qalpha = '';
                                              $ralpha = '';
                                              $salpha = '';
                                              $talpha = '';
                                              $ualpha = '';
                                              $valpha = '';
                                              $walpha = '';
                                              $xalpha = '';
                                              $yalpha = '';
                                              $zalpha = '';
                                            }else if ($legalwordsalphabet == "A") {
                                              $noalphabet = '';
                                              $aalpha = 'selected';
                                              $balpha = '';
                                              $calpha = '';
                                              $dalpha = '';
                                              $ealpha = '';
                                              $falpha = '';
                                              $galpha = '';
                                              $halpha = '';
                                              $ialpha = '';
                                              $jalpha = '';
                                              $kalpha = '';
                                              $lalpha = '';
                                              $malpha = '';
                                              $nalpha = '';
                                              $oaplha = '';
                                              $palpha = '';
                                              $qalpha = '';
                                              $ralpha = '';
                                              $salpha = '';
                                              $talpha = '';
                                              $ualpha = '';
                                              $valpha = '';
                                              $walpha = '';
                                              $xalpha = '';
                                              $yalpha = '';
                                              $zalpha = '';
                                            }else if ($legalwordsalphabet == "B") {
                                              $noalphabet = '';
                                              $aalpha = '';
                                              $balpha = 'selected';
                                              $calpha = '';
                                              $dalpha = '';
                                              $ealpha = '';
                                              $falpha = '';
                                              $galpha = '';
                                              $halpha = '';
                                              $ialpha = '';
                                              $jalpha = '';
                                              $kalpha = '';
                                              $lalpha = '';
                                              $malpha = '';
                                              $nalpha = '';
                                              $oaplha = '';
                                              $palpha = '';
                                              $qalpha = '';
                                              $ralpha = '';
                                              $salpha = '';
                                              $talpha = '';
                                              $ualpha = '';
                                              $valpha = '';
                                              $walpha = '';
                                              $xalpha = '';
                                              $yalpha = '';
                                              $zalpha = '';
                                            }else if ($legalwordsalphabet == "C") {
                                              $noalphabet = '';
                                              $aalpha = '';
                                              $balpha = '';
                                              $calpha = 'selected';
                                              $dalpha = '';
                                              $ealpha = '';
                                              $falpha = '';
                                              $galpha = '';
                                              $halpha = '';
                                              $ialpha = '';
                                              $jalpha = '';
                                              $kalpha = '';
                                              $lalpha = '';
                                              $malpha = '';
                                              $nalpha = '';
                                              $oaplha = '';
                                              $palpha = '';
                                              $qalpha = '';
                                              $ralpha = '';
                                              $salpha = '';
                                              $talpha = '';
                                              $ualpha = '';
                                              $valpha = '';
                                              $walpha = '';
                                              $xalpha = '';
                                              $yalpha = '';
                                              $zalpha = '';
                                            }else if ($legalwordsalphabet == "D") {
                                              $noalphabet = '';
                                              $aalpha = '';
                                              $balpha = '';
                                              $calpha = '';
                                              $dalpha = 'selected';
                                              $ealpha = '';
                                              $falpha = '';
                                              $galpha = '';
                                              $halpha = '';
                                              $ialpha = '';
                                              $jalpha = '';
                                              $kalpha = '';
                                              $lalpha = '';
                                              $malpha = '';
                                              $nalpha = '';
                                              $oaplha = '';
                                              $palpha = '';
                                              $qalpha = '';
                                              $ralpha = '';
                                              $salpha = '';
                                              $talpha = '';
                                              $ualpha = '';
                                              $valpha = '';
                                              $walpha = '';
                                              $xalpha = '';
                                              $yalpha = '';
                                              $zalpha = '';
                                            }else if ($legalwordsalphabet == "E") {
                                              $noalphabet = '';
                                              $aalpha = '';
                                              $balpha = '';
                                              $calpha = '';
                                              $dalpha = '';
                                              $ealpha = 'selected';
                                              $falpha = '';
                                              $galpha = '';
                                              $halpha = '';
                                              $ialpha = '';
                                              $jalpha = '';
                                              $kalpha = '';
                                              $lalpha = '';
                                              $malpha = '';
                                              $nalpha = '';
                                              $oaplha = '';
                                              $palpha = '';
                                              $qalpha = '';
                                              $ralpha = '';
                                              $salpha = '';
                                              $talpha = '';
                                              $ualpha = '';
                                              $valpha = '';
                                              $walpha = '';
                                              $xalpha = '';
                                              $yalpha = '';
                                              $zalpha = '';
                                            }else if ($legalwordsalphabet == "F") {
                                              $noalphabet = '';
                                              $aalpha = '';
                                              $balpha = '';
                                              $calpha = '';
                                              $dalpha = '';
                                              $ealpha = '';
                                              $falpha = 'selected';
                                              $galpha = '';
                                              $halpha = '';
                                              $ialpha = '';
                                              $jalpha = '';
                                              $kalpha = '';
                                              $lalpha = '';
                                              $malpha = '';
                                              $nalpha = '';
                                              $oaplha = '';
                                              $palpha = '';
                                              $qalpha = '';
                                              $ralpha = '';
                                              $salpha = '';
                                              $talpha = '';
                                              $ualpha = '';
                                              $valpha = '';
                                              $walpha = '';
                                              $xalpha = '';
                                              $yalpha = '';
                                              $zalpha = '';
                                            }else if ($legalwordsalphabet == "G") {
                                              $noalphabet = '';
                                              $aalpha = '';
                                              $balpha = '';
                                              $calpha = '';
                                              $dalpha = '';
                                              $ealpha = '';
                                              $falpha = '';
                                              $galpha = 'selected';
                                              $halpha = '';
                                              $ialpha = '';
                                              $jalpha = '';
                                              $kalpha = '';
                                              $lalpha = '';
                                              $malpha = '';
                                              $nalpha = '';
                                              $oaplha = '';
                                              $palpha = '';
                                              $qalpha = '';
                                              $ralpha = '';
                                              $salpha = '';
                                              $talpha = '';
                                              $ualpha = '';
                                              $valpha = '';
                                              $walpha = '';
                                              $xalpha = '';
                                              $yalpha = '';
                                              $zalpha = '';
                                            }else if ($legalwordsalphabet == "H") {
                                              $noalphabet = '';
                                              $aalpha = '';
                                              $balpha = '';
                                              $calpha = '';
                                              $dalpha = '';
                                              $ealpha = '';
                                              $falpha = '';
                                              $galpha = '';
                                              $halpha = 'selected';
                                              $ialpha = '';
                                              $jalpha = '';
                                              $kalpha = '';
                                              $lalpha = '';
                                              $malpha = '';
                                              $nalpha = '';
                                              $oaplha = '';
                                              $palpha = '';
                                              $qalpha = '';
                                              $ralpha = '';
                                              $salpha = '';
                                              $talpha = '';
                                              $ualpha = '';
                                              $valpha = '';
                                              $walpha = '';
                                              $xalpha = '';
                                              $yalpha = '';
                                              $zalpha = '';
                                            }else if ($legalwordsalphabet == "I") {
                                              $noalphabet = '';
                                              $aalpha = '';
                                              $balpha = '';
                                              $calpha = '';
                                              $dalpha = '';
                                              $ealpha = '';
                                              $falpha = '';
                                              $galpha = '';
                                              $halpha = '';
                                              $ialpha = 'selected';
                                              $jalpha = '';
                                              $kalpha = '';
                                              $lalpha = '';
                                              $malpha = '';
                                              $nalpha = '';
                                              $oaplha = '';
                                              $palpha = '';
                                              $qalpha = '';
                                              $ralpha = '';
                                              $salpha = '';
                                              $talpha = '';
                                              $ualpha = '';
                                              $valpha = '';
                                              $walpha = '';
                                              $xalpha = '';
                                              $yalpha = '';
                                              $zalpha = '';
                                            }else if ($legalwordsalphabet == "J") {
                                              $noalphabet = '';
                                              $aalpha = '';
                                              $balpha = '';
                                              $calpha = '';
                                              $dalpha = '';
                                              $ealpha = '';
                                              $falpha = '';
                                              $galpha = '';
                                              $halpha = '';
                                              $ialpha = '';
                                              $jalpha = 'selected';
                                              $kalpha = '';
                                              $lalpha = '';
                                              $malpha = '';
                                              $nalpha = '';
                                              $oaplha = '';
                                              $palpha = '';
                                              $qalpha = '';
                                              $ralpha = '';
                                              $salpha = '';
                                              $talpha = '';
                                              $ualpha = '';
                                              $valpha = '';
                                              $walpha = '';
                                              $xalpha = '';
                                              $yalpha = '';
                                              $zalpha = '';
                                            }else if ($legalwordsalphabet == "K") {
                                              $noalphabet = '';
                                              $aalpha = '';
                                              $balpha = '';
                                              $calpha = '';
                                              $dalpha = '';
                                              $ealpha = '';
                                              $falpha = '';
                                              $galpha = '';
                                              $halpha = '';
                                              $ialpha = '';
                                              $jalpha = '';
                                              $kalpha = 'selected';
                                              $lalpha = '';
                                              $malpha = '';
                                              $nalpha = '';
                                              $oaplha = '';
                                              $palpha = '';
                                              $qalpha = '';
                                              $ralpha = '';
                                              $salpha = '';
                                              $talpha = '';
                                              $ualpha = '';
                                              $valpha = '';
                                              $walpha = '';
                                              $xalpha = '';
                                              $yalpha = '';
                                              $zalpha = '';
                                            }else if ($legalwordsalphabet == "L") {
                                              $noalphabet = '';
                                              $aalpha = '';
                                              $balpha = '';
                                              $calpha = '';
                                              $dalpha = '';
                                              $ealpha = '';
                                              $falpha = '';
                                              $galpha = '';
                                              $halpha = '';
                                              $ialpha = '';
                                              $jalpha = '';
                                              $kalpha = '';
                                              $lalpha = 'selected';
                                              $malpha = '';
                                              $nalpha = '';
                                              $oaplha = '';
                                              $palpha = '';
                                              $qalpha = '';
                                              $ralpha = '';
                                              $salpha = '';
                                              $talpha = '';
                                              $ualpha = '';
                                              $valpha = '';
                                              $walpha = '';
                                              $xalpha = '';
                                              $yalpha = '';
                                              $zalpha = '';
                                            }else if ($legalwordsalphabet == "M") {
                                              $noalphabet = '';
                                              $aalpha = '';
                                              $balpha = '';
                                              $calpha = '';
                                              $dalpha = '';
                                              $ealpha = '';
                                              $falpha = '';
                                              $galpha = '';
                                              $halpha = '';
                                              $ialpha = '';
                                              $jalpha = '';
                                              $kalpha = '';
                                              $lalpha = '';
                                              $malpha = 'selected';
                                              $nalpha = '';
                                              $oaplha = '';
                                              $palpha = '';
                                              $qalpha = '';
                                              $ralpha = '';
                                              $salpha = '';
                                              $talpha = '';
                                              $ualpha = '';
                                              $valpha = '';
                                              $walpha = '';
                                              $xalpha = '';
                                              $yalpha = '';
                                              $zalpha = '';
                                            }else if ($legalwordsalphabet == "N") {
                                              $noalphabet = '';
                                              $aalpha = '';
                                              $balpha = '';
                                              $calpha = '';
                                              $dalpha = '';
                                              $ealpha = '';
                                              $falpha = '';
                                              $galpha = '';
                                              $halpha = '';
                                              $ialpha = '';
                                              $jalpha = '';
                                              $kalpha = '';
                                              $lalpha = '';
                                              $malpha = '';
                                              $nalpha = 'selected';
                                              $oaplha = '';
                                              $palpha = '';
                                              $qalpha = '';
                                              $ralpha = '';
                                              $salpha = '';
                                              $talpha = '';
                                              $ualpha = '';
                                              $valpha = '';
                                              $walpha = '';
                                              $xalpha = '';
                                              $yalpha = '';
                                              $zalpha = '';
                                            }else if ($legalwordsalphabet == "O") {
                                              $noalphabet = '';
                                              $aalpha = '';
                                              $balpha = '';
                                              $calpha = '';
                                              $dalpha = '';
                                              $ealpha = '';
                                              $falpha = '';
                                              $galpha = '';
                                              $halpha = '';
                                              $ialpha = '';
                                              $jalpha = '';
                                              $kalpha = '';
                                              $lalpha = '';
                                              $malpha = '';
                                              $nalpha = '';
                                              $oaplha = 'selected';
                                              $palpha = '';
                                              $qalpha = '';
                                              $ralpha = '';
                                              $salpha = '';
                                              $talpha = '';
                                              $ualpha = '';
                                              $valpha = '';
                                              $walpha = '';
                                              $xalpha = '';
                                              $yalpha = '';
                                              $zalpha = '';
                                            }else if ($legalwordsalphabet == "P") {
                                              $noalphabet = '';
                                              $aalpha = '';
                                              $balpha = '';
                                              $calpha = '';
                                              $dalpha = '';
                                              $ealpha = '';
                                              $falpha = '';
                                              $galpha = '';
                                              $halpha = '';
                                              $ialpha = '';
                                              $jalpha = '';
                                              $kalpha = '';
                                              $lalpha = '';
                                              $malpha = '';
                                              $nalpha = '';
                                              $oaplha = '';
                                              $palpha = 'selected';
                                              $qalpha = '';
                                              $ralpha = '';
                                              $salpha = '';
                                              $talpha = '';
                                              $ualpha = '';
                                              $valpha = '';
                                              $walpha = '';
                                              $xalpha = '';
                                              $yalpha = '';
                                              $zalpha = '';
                                            }else if ($legalwordsalphabet == "Q") {
                                              $noalphabet = '';
                                              $aalpha = '';
                                              $balpha = '';
                                              $calpha = '';
                                              $dalpha = '';
                                              $ealpha = '';
                                              $falpha = '';
                                              $galpha = '';
                                              $halpha = '';
                                              $ialpha = '';
                                              $jalpha = '';
                                              $kalpha = '';
                                              $lalpha = '';
                                              $malpha = '';
                                              $nalpha = '';
                                              $oaplha = '';
                                              $palpha = '';
                                              $qalpha = 'selected';
                                              $ralpha = '';
                                              $salpha = '';
                                              $talpha = '';
                                              $ualpha = '';
                                              $valpha = '';
                                              $walpha = '';
                                              $xalpha = '';
                                              $yalpha = '';
                                              $zalpha = '';
                                            }else if ($legalwordsalphabet == "R") {
                                              $noalphabet = '';
                                              $aalpha = '';
                                              $balpha = '';
                                              $calpha = '';
                                              $dalpha = '';
                                              $ealpha = '';
                                              $falpha = '';
                                              $galpha = '';
                                              $halpha = '';
                                              $ialpha = '';
                                              $jalpha = '';
                                              $kalpha = '';
                                              $lalpha = '';
                                              $malpha = '';
                                              $nalpha = '';
                                              $oaplha = '';
                                              $palpha = '';
                                              $qalpha = '';
                                              $ralpha = 'selected';
                                              $salpha = '';
                                              $talpha = '';
                                              $ualpha = '';
                                              $valpha = '';
                                              $walpha = '';
                                              $xalpha = '';
                                              $yalpha = '';
                                              $zalpha = '';
                                            }else if ($legalwordsalphabet == "S") {
                                              $noalphabet = '';
                                              $aalpha = '';
                                              $balpha = '';
                                              $calpha = '';
                                              $dalpha = '';
                                              $ealpha = '';
                                              $falpha = '';
                                              $galpha = '';
                                              $halpha = '';
                                              $ialpha = '';
                                              $jalpha = '';
                                              $kalpha = '';
                                              $lalpha = '';
                                              $malpha = '';
                                              $nalpha = '';
                                              $oaplha = '';
                                              $palpha = '';
                                              $qalpha = '';
                                              $ralpha = '';
                                              $salpha = 'selected';
                                              $talpha = '';
                                              $ualpha = '';
                                              $valpha = '';
                                              $walpha = '';
                                              $xalpha = '';
                                              $yalpha = '';
                                              $zalpha = '';
                                            }else if ($legalwordsalphabet == "T") {
                                              $noalphabet = '';
                                              $aalpha = '';
                                              $balpha = '';
                                              $calpha = '';
                                              $dalpha = '';
                                              $ealpha = '';
                                              $falpha = '';
                                              $galpha = '';
                                              $halpha = '';
                                              $ialpha = '';
                                              $jalpha = '';
                                              $kalpha = '';
                                              $lalpha = '';
                                              $malpha = '';
                                              $nalpha = '';
                                              $oaplha = '';
                                              $palpha = '';
                                              $qalpha = '';
                                              $ralpha = '';
                                              $salpha = '';
                                              $talpha = 'selected';
                                              $ualpha = '';
                                              $valpha = '';
                                              $walpha = '';
                                              $xalpha = '';
                                              $yalpha = '';
                                              $zalpha = '';
                                            }else if ($legalwordsalphabet == "U") {
                                              $noalphabet = '';
                                              $aalpha = '';
                                              $balpha = '';
                                              $calpha = '';
                                              $dalpha = '';
                                              $ealpha = '';
                                              $falpha = '';
                                              $galpha = '';
                                              $halpha = '';
                                              $ialpha = '';
                                              $jalpha = '';
                                              $kalpha = '';
                                              $lalpha = '';
                                              $malpha = '';
                                              $nalpha = '';
                                              $oaplha = '';
                                              $palpha = '';
                                              $qalpha = '';
                                              $ralpha = '';
                                              $salpha = '';
                                              $talpha = '';
                                              $ualpha = 'selected';
                                              $valpha = '';
                                              $walpha = '';
                                              $xalpha = '';
                                              $yalpha = '';
                                              $zalpha = '';
                                            }else if ($legalwordsalphabet == "V") {
                                              $noalphabet = '';
                                              $aalpha = '';
                                              $balpha = '';
                                              $calpha = '';
                                              $dalpha = '';
                                              $ealpha = '';
                                              $falpha = '';
                                              $galpha = '';
                                              $halpha = '';
                                              $ialpha = '';
                                              $jalpha = '';
                                              $kalpha = '';
                                              $lalpha = '';
                                              $malpha = '';
                                              $nalpha = '';
                                              $oaplha = '';
                                              $palpha = '';
                                              $qalpha = '';
                                              $ralpha = '';
                                              $salpha = '';
                                              $talpha = '';
                                              $ualpha = '';
                                              $valpha = 'selected';
                                              $walpha = '';
                                              $xalpha = '';
                                              $yalpha = '';
                                              $zalpha = '';
                                            }else if ($legalwordsalphabet == "W") {
                                              $noalphabet = '';
                                              $aalpha = '';
                                              $balpha = '';
                                              $calpha = '';
                                              $dalpha = '';
                                              $ealpha = '';
                                              $falpha = '';
                                              $galpha = '';
                                              $halpha = '';
                                              $ialpha = '';
                                              $jalpha = '';
                                              $kalpha = '';
                                              $lalpha = '';
                                              $malpha = '';
                                              $nalpha = '';
                                              $oaplha = '';
                                              $palpha = '';
                                              $qalpha = '';
                                              $ralpha = '';
                                              $salpha = '';
                                              $talpha = '';
                                              $ualpha = '';
                                              $valpha = '';
                                              $walpha = 'selected';
                                              $xalpha = '';
                                              $yalpha = '';
                                              $zalpha = '';
                                            }else if ($legalwordsalphabet == "X") {
                                              $noalphabet = '';
                                              $aalpha = '';
                                              $balpha = '';
                                              $calpha = '';
                                              $dalpha = '';
                                              $ealpha = '';
                                              $falpha = '';
                                              $galpha = '';
                                              $halpha = '';
                                              $ialpha = '';
                                              $jalpha = '';
                                              $kalpha = '';
                                              $lalpha = '';
                                              $malpha = '';
                                              $nalpha = '';
                                              $oaplha = '';
                                              $palpha = '';
                                              $qalpha = '';
                                              $ralpha = '';
                                              $salpha = '';
                                              $talpha = '';
                                              $ualpha = '';
                                              $valpha = '';
                                              $walpha = '';
                                              $xalpha = 'selected';
                                              $yalpha = '';
                                              $zalpha = '';
                                            }else if ($legalwordsalphabet == "Y") {
                                              $noalphabet = '';
                                              $aalpha = '';
                                              $balpha = '';
                                              $calpha = '';
                                              $dalpha = '';
                                              $ealpha = '';
                                              $falpha = '';
                                              $galpha = '';
                                              $halpha = '';
                                              $ialpha = '';
                                              $jalpha = '';
                                              $kalpha = '';
                                              $lalpha = '';
                                              $malpha = '';
                                              $nalpha = '';
                                              $oaplha = '';
                                              $palpha = '';
                                              $qalpha = '';
                                              $ralpha = '';
                                              $salpha = '';
                                              $talpha = '';
                                              $ualpha = '';
                                              $valpha = '';
                                              $walpha = '';
                                              $xalpha = '';
                                              $yalpha = 'selected';
                                              $zalpha = '';
                                            }else if ($legalwordsalphabet == "Z") {
                                              $noalphabet = '';
                                              $aalpha = '';
                                              $balpha = '';
                                              $calpha = '';
                                              $dalpha = '';
                                              $ealpha = '';
                                              $falpha = '';
                                              $galpha = '';
                                              $halpha = '';
                                              $ialpha = '';
                                              $jalpha = '';
                                              $kalpha = '';
                                              $lalpha = '';
                                              $malpha = '';
                                              $nalpha = '';
                                              $oaplha = '';
                                              $palpha = '';
                                              $qalpha = '';
                                              $ralpha = '';
                                              $salpha = '';
                                              $talpha = '';
                                              $ualpha = '';
                                              $valpha = '';
                                              $walpha = '';
                                              $xalpha = '';
                                              $yalpha = '';
                                              $zalpha = 'selected';
                                            }
                                          
                                          ?>
                                          <option value="" <?php echO $noalphabet?>>Select Alphabet</option>
                                          <option value="A" <?php echO $aalpha?>>A</option>
                                          <option value="B" <?php echO $balpha ?> >B</option>
                                          <option value="C" <?php echO $calpha ?> >C</option>
                                          <option value="D" <?php echO $dalpha ?> >D</option>
                                          <option value="E" <?php echO $ealpha ?>>E</option>
                                          <option value="F" <?php echO $falpha ?>>F</option>
                                          <option value="G" <?php echO $galpha ?>>G</option>
                                          <option value="H" <?php echO $halpha ?>>H</option>
                                          <option value="I" <?php echO $ialpha ?>>I</option>
                                          <option value="J" <?php echO $jalpha ?>>J</option>
                                          <option value="K" <?php echO $kalpha ?>>K</option>
                                          <option value="L" <?php echO $lalpha ?>>L</option>
                                          <option value="M" <?php echO $malpha ?>>M</option>
                                          <option value="N" <?php echO $nalpha ?>>N</option>
                                          <option value="O" <?php echO $oaplha ?>>O</option>
                                          <option value="P" <?php echO $palpha ?>>p</option>
                                          <option value="Q" <?php echO $qalpha ?>>Q</option>
                                          <option value="R" <?php echO $ralpha ?>>R</option>
                                          <option value="S" <?php echO $salpha ?>>S</option>
                                          <option value="T" <?php echO $talpha ?>>T</option>
                                          <option value="U" <?php echO $ualpha ?>>U</option>
                                          <option value="V" <?php echO $valpha ?>>V</option>
                                          <option value="W" <?php echO $walpha ?>>W</option>
                                          <option value="X" <?php echO $xalpha ?>>X</option>
                                          <option value="Y" <?php echO $yalpha ?>>Y</option>
                                          <option value="Z" <?php echO $zalpha ?>>Z</option>
                                        </select>
                                </div>
                              </div>
                              <div class="span3">
                                <div class="control-group">
                                  <select class="form-control select2 languagetype" name="languagetype" id="languagetype" style="width: 100%">
                                    <?php
                                      
                                        if ($languagetype == "" || $languagetype == null) {
                                          $nolang = 'selected';
                                          $englang = '';
                                          $hinlang = '';
                                          $marlang = '';
                                        }else if ($languagetype == "English") {
                                            
                                            $nolang = '';
                                            $englang = 'selected';
                                            $hinlang = '';
                                            $marlang = '';

                                        }else if ($languagetype == "Hindi") {
                                           
                                            $nolang = '';
                                            $englang = '';
                                            $hinlang = 'selected';
                                            $marlang = '';

                                        }else if ($languagetype == "Marathi") {
                                           
                                            $nolang = '';
                                            $englang = '';
                                            $hinlang = '';
                                            $marlang = 'selected';

                                        }
                                    ?>
                                    <option value="" <?php echo $nolang ?>>Select Language</option>
                                    <option value="English" <?php echo $englang ?>>English</option>
                                    <option value="Hindi" <?php echo $hinlang ?>>Hindi</option>
                                    <option value="Marathi" <?php echo $marlang ?>>Marathi</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row-fluid">
                            <div class="span12">
                              <div class="span3">
                                <div class="control-group">
                                  <label>Title</label>
                                  <input type="hidden" name="legalwordid" value="<?php echo $_GET["view"]?>">
                                  <input type="text" style="width: 100%" name="ChapterTitle" required="" id="ChapterTitle_0" class="ChapterTitle form-control" placeholder="Enter Title here.."  value="<?php echo $wordtitle?>" />
                                </div>
                              </div>
                              <div class="span9">
                                <div class="control-group">
                                  <label>Paragraph</label>
                                  <input type="text" style="width: 100%" class="form-control" name="ChapterExplanation" id="ChapterExplanation_0" placeholder="Place some text here" value="<?php echo $worddescription?>"/>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row-fluid">
                            <div class="span12">
                              <div class="span5"></div>
                              <button type="submit" name="BtnSubmitDetailsLegalTerms" id="BtnSubmitDetailsLegalTerms" class="btn btn-primary BtnSubmitDetailsLegalTerms">Update Details</button>
                            </div>
                          </div>
                        </form>  
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
          </div>
        </div>
      </div>
      
    </div>

  </div>
</div>
<?php include("footer.php");?>