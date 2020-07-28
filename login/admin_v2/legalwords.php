<?php include("header.php");?>
<?php
  if (isset($_GET["del"])) {
    $legalwordid = $_GET["del"];
    $delq = mysql_query("delete from tbllegalwords where legalwordid='$legalwordid'");
    if ($delq) {
     echo '<script>window.location = "legalwords.php?status=1&msg=Legal Term Deleted Successfully!!"</script>';
    }else{
      echo '<script>window.location = "legalwords.php?status=0&msg=Sorry Something went Wrong!!"</script>';
    }
  }
  if (isset($_GET["delmaxims"])) {
    $legalmaximsid = $_GET["delmaxims"];
    $delq = mysql_query("delete from tbllegalmaxims where legalmaximsid='$legalmaximsid'");
    if ($delq) {
     echo '<script>window.location = "legalwords.php?status=1&msg=Legal Term Deleted Successfully!!"</script>';
    }else{
      echo '<script>window.location = "legalwords.php?status=0&msg=Sorry Something went Wrong!!"</script>';
    }
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
      
      
      $legalwordsalphabet = $_POST["legalwordsalphabet"];    
      // Owner Count
      $itemcount = count($_POST["item_no"]);
      $ChapterTitle = $_POST["ChapterTitle"];
      $ChapterExplanation = $_POST["ChapterExplanation"];
      $languagetype = $_POST["languagetype"];
      
       for($i = 0; $i < $itemcount; $i++){
           $PropertyQuery = mysql_query("INSERT INTO `tbllegalwords`(`alphabettype`,`wordlanguagetype`, `wordtitle`, `worddescription`) VALUES ('$legalwordsalphabet','$languagetype','$ChapterTitle[$i]','$ChapterExplanation[$i]')");
        }
      
        if ($PropertyQuery) {
         // $msg =  '<label class="label label-success">Details Saved Successfully!!</label><br><br>';
          echo '<script>window.location = "legalwords.php?current=legalwords&legalwordsalphabet='.$legalwordsalphabet.'&languagetype='.$languagetype.'&status=1&msg=Legal Terms Details Saved Successfully!!"</script>';

        }else{
          //$msg = '<label class="label label-danger">Sorry Something Went Wrong!!</label><br><br>';

          echo '<script>window.location = "legalwords.php?current=legalwords&legalwordsalphabet='.$legalwordsalphabet.'&languagetype='.$languagetype.'&status=0&msg=Sorry Something went Wrong!!"</script>';
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
                  <!-- Only required for left/right tabs -->
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab1" data-toggle="tab">Legal Terms</a></li>
                    <li><a href="#tab2" data-toggle="tab">Legal Maxims</a></li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="btn btn-primary btn-md" id="" name="" style="margin-top: -5px;">Add New Legal Term</a>

                      <div id="collapseOne" class="panel-collapse collapseOne collapse">
                        <form class="" method="post" action="">
                        <div class="">
                            <br>
                            <div class="">
                              <div class="span3">
                                <div class="control-group">
                                  <select class="form-control legalwordsalphabet" name="legalwordsalphabet" id="legalwordsalphabet" style="width: 100%">
                                          <?php
                                          if (isset($_GET["legalwordsalphabet"])) {
                                            $legalwordsalphabet = $_GET["legalwordsalphabet"];
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
                                          }else{
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
                                      if (isset($_GET["languagetype"])) {
                                        $languagetype = $_GET["languagetype"];
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
                                      }else{
                                        $nolang = 'selected';
                                        $englang = '';
                                        $hinlang = '';
                                        $marlang = '';
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
                                  <input type="hidden" class="form-control ino" id="ino_0" name="item_no[]" style="width:50px" value="1">
                                            
                                  <input type="text" style="width: 100%" name="ChapterTitle[]" required="" id="ChapterTitle_0" class="ChapterTitle form-control" placeholder="Enter Title here.." />
                                </div>
                              </div>
                              <div class="span7">
                                <div class="control-group">
                                  <label>Paragraph</label>
                                  <input type="text" style="width: 100%" class="form-control" name="ChapterExplanation[]" id="ChapterExplanation_0" placeholder="Place some text here"/>
                                </div>
                              </div>

                              <div class="span2" style="margin-top: 20px">
                                <div class="control-group">
                                  <button type="button" class="BtnAddLegalwords btn btn-danger btn-md" id="BtnAddLegalwords" name="BtnAddLegalwords">Add More</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div id="legalworddiv"></div>
                          <div class="row-fluid">
                            <div class="span12">
                              <div class="span5"></div>
                              <button type="submit" name="BtnSubmitDetailsLegalTerms" id="BtnSubmitDetailsLegalTerms" class="btn btn-primary BtnSubmitDetailsLegalTerms">Submit Details</button>
                            </div>
                          </div>
                        </form>
                      </div>

                      <table class="table table-bordered text-center data-tbl-inbox">
                        <thead>
                          <tr>
                            <th class="center">SrNo</th>
                            <th class="center">Title</th>
                            <th class="center">Description</th>
                            <th class="center">
                              Action
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $count = 1;
                            $getlegalterm = mysql_query("select * from tbllegalwords");
                            while($getlegaltermrows = mysql_fetch_array($getlegalterm)){

                          ?>
                          <tr>
                            <td style="width: 10%"><?php echo $count++?></td>
                            <td style="width: 30%"><?php echo $getlegaltermrows["wordtitle"]?></td>
                            <td style="width: 50%"><?php echo $getlegaltermrows["worddescription"]?></td>
                            <td style="width: 10%">
                              <div class="btn-group">
                                <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-cog "></i><span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                  <li><a href="legaltermsview.php?view=<?php echo $getlegaltermrows["legalwordid"]?>" target="_blank"><i class="icon-file"></i> Edit Details</a></li>
                                  <li><a href="legalwords.php?del=<?php echo $getlegaltermrows["legalwordid"]?>"><i class="icon-trash"></i> Remove Post</a></li>
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
                    <div class="tab-pane" id="tab2">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="btn btn-primary btn-md" id="" name="" style="margin-top: -5px;">Add New Legal Term</a>
                      <div id="collapseTwo" class="panel-collapse collapseOne collapse">
                         <form class="" method="post" action="">
                        <br>
                        <div class="row-fluid">
                          <div class="span12">
                            <div class="span3">
                              <div class="control-group">
                                <select class="form-control select2 legalmaximssalphabet" name="legalmaximssalphabet" id="legalmaximssalphabet" style="width: 100%">
                                  <?php
                                  if (isset($_GET["legalmaximsalphabet"])) {
                                    $legalwordsalphabet = $_GET["legalmaximsalphabet"];
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
                                  }else{
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
                                <select class="form-control select2 legalmaximslanguagetype" name="legalmaximslanguagetype" id="legalmaximslanguagetype" style="width: 100%">
                                  <?php
                                    if (isset($_GET["legalmaximslanguagetype"])) {
                                      $languagetype = $_GET["legalmaximslanguagetype"];
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
                                    }else{
                                      $nolang = 'selected';
                                      $englang = '';
                                      $hinlang = '';
                                      $marlang = '';
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
                                  <input type="hidden" class="form-control ino" id="LMino_0" name="LMitem_no[]" style="width:50px" value="1">
                                            
                                  <input type="text" style="width: 100%" name="LMChapterTitle[]" required="" id="LMChapterTitle_0" class="ChapterTitle form-control" placeholder="Enter Title here.." />
                                </div>
                              </div>
                              <div class="span7">
                                <div class="control-group">
                                  <label>Paragraph</label>
                                  <input type="text" style="width: 100%" class="form-control" name="LMChapterExplanation[]" id="LMChapterExplanation_0" placeholder="Place some text here"/>
                                </div>
                              </div>

                              <div class="span2" style="margin-top: 20px">
                                <div class="control-group">
                                  <button type="button" class="BtnAddLegalMaxims btn btn-danger btn-md" id="BtnAddLegalMaxims" name="BtnAddLegalMaxims">Add More</button>
                                </div>
                              </div>
                            </div>
                          </div>                       

                          <div id="legalmaximsdiv"></div>

                          <div class="row-fluid">
                            <div class="span12">
                              <div class="span5"></div>
                              <button type="submit" name="BtnSubmitDetailsLegalMaxims" id="BtnSubmitDetailsLegalMaxims" class="btn btn-primary BtnSubmitDetailsLegalMaxims">Submit Details</button>
                            </div>
                          </div>
                      </form>
                      </div>
                      <table class="table table-bordered text-center data-tbl-inbox">
                        <thead>
                          <tr>
                            <th class="center">SrNo</th>
                            <th class="center">Title</th>
                            <th class="center">Description</th>
                            <th class="center">
                              Action
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $count = 1;
                            $getlegalterm = mysql_query("select * from tbllegalmaxims");
                            while($getlegaltermrows = mysql_fetch_array($getlegalterm)){

                          ?>
                          <tr>
                            <td style="width: 10%"><?php echo $count++?></td>
                            <td style="width: 30%"><?php echo $getlegaltermrows["wordtitle"]?></td>
                            <td style="width: 50%"><?php echo $getlegaltermrows["worddescription"]?></td>
                            <td style="width: 10%">
                              <div class="btn-group">
                                <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-cog "></i><span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                  <li><a href="legalmaximsview.php?view=<?php echo $getlegaltermrows["legalmaximsid"]?>" target="_blank"><i class="icon-file"></i> Edit Details</a></li>
                                  <li><a href="legalwords.php?delmaxims=<?php echo $getlegaltermrows["legalmaximsid"]?>"><i class="icon-trash"></i> Remove Post</a></li>
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

            </div>
          </div>
        </div>
      </div>
      
    </div>

  </div>
</div>
<?php include("footer.php");?>