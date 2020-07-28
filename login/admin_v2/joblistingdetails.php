<?php include("header.php");?>
<style type="text/css">
  tr.odd td.sorting_1{
    background-color: #ffffff;
  }
</style>
<?php
  if (isset($_GET["edit"])) {
    $joblistid = $_GET["edit"];

    $getdetails = mysql_query("select * from tbljoblisting where joblistid='$joblistid'");
    $getdetailsrows = mysql_fetch_assoc($getdetails);
    $jobtitle = $getdetailsrows["jobtitle"];
    $jobdesignation = $getdetailsrows["jobdesignation"];
    $joblocation = $getdetailsrows["joblocation"];
    $postreference = $getdetailsrows["postreference"];
    $jobrole = $getdetailsrows["jobrole"];
    $jobqualification = $getdetailsrows["jobqualification"];
    $jobindustry = $getdetailsrows["jobindustry"];
    $jobprofile = $getdetailsrows["jobprofile"];
    $companyname= $getdetailsrows["companyname"];
    $companyicon = $getdetailsrows["companyicon"];

    
  }

    $msg = '';
    date_default_timezone_set("Asia/Kolkata");



    if (isset($_POST["BtnSubmitDetails"])) {
        
        $joblistid = $_POST["joblistid"];
        $JobTitle = $_POST["JobTitle"];
        $JobDesignation = $_POST["JobDesignation"];
        $JobLocation = $_POST["JobLocation"];
        $JobReferenceName = $_POST["JobReferenceName"];
        $JobRole = $_POST["JobRole"];
        $JobQualification = $_POST["JobQualification"];
        $JobIndustry = $_POST["JobIndustry"];
        $CompanyName = $_POST["CompanyName"];
        $JobProfile = $_POST["JobProfile"];
        $jobposteddate = date("Y-m-d H:i:s");
        $characters = 'abc123';
        $string = '';
        $string1 = '';
        $string2 = '';
        $string6 = '';
        $date = date("d-m-Y");
        $iscompanylogoselected = $_POST["iscompanylogoselected"];
        if ($iscompanylogoselected == "1") {
          $AgreementUrl = $_FILES["CompanyLogo"]["name"];
          if($AgreementUrl <> "")
          {
            for($j = 0; $j < count($AgreementUrl); $j++)
            {
            for($i = 0; $i < 0; $i++) {
              $string .= $characters[rand(0, strlen($characters) - 1)];
            } 
            $AgreementPath1 = "../../mobileapi/uploads/" . $string . $AgreementUrl[$j];
            $AgreementPath = "uploads/" . $string . $AgreementUrl[$j];
              move_uploaded_file($_FILES["CompanyLogo"]["tmp_name"][$j], $AgreementPath1);
            }
          }
          // Update Logo
          mysql_query("UPDATE `tbljoblisting` SET `companyicon`='$AgreementPath' WHERE `joblistid`='$joblistid'");
        }

        $jobquery = mysql_query("UPDATE `tbljoblisting` SET `jobtitle`='$JobTitle',`jobdesignation`='$JobDesignation',`joblocation`='$JobLocation',`postreference`='$JobReferenceName',`jobrole`='$JobRole',`jobqualification`='$JobQualification',`jobindustry`='$JobIndustry',`jobprofile`='$JobProfile',`companyname`='$CompanyName' WHERE `joblistid`='$joblistid'");

        if ($jobquery) {
          echo '<script>window.location = "joblistingdetails.php?edit='.$joblistid.'&current=joblisting&status=1&msg=Details Saved Successfully!!"</script>';

        }else{
          echo '<script>window.location = "joblistingdetails.php?edit='.$joblistid.'&current=joblisting&status=0&msg=Sorry Something went Wrong!!"</script>';
        }
    }
    ?>

<div id="main-content">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li><a href="#">Home</a><span class="divider">&raquo;</span></li>
      <li class="active">Job Listings</li>
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


              <form class="well" style="background: #ffffff" method="post" action="" enctype="multipart/form-data">
                <div class="row-fluid">
                      <div class="span12">
                        <div class="span3">
                          <div class="control-group">
                            <label class="">Title</label>
                            <input type="hidden" name="joblistid"  value="<?php echo $_GET["edit"]?>">
                            <input type="text" style="width: 100%" class="form-control JobTitle" name="JobTitle" id="JobTitle" placeholder="Job Title" value="<?php echo $jobtitle?>">
                          </div>
                        </div>
                        <div class="span3">
                          <div class="control-group">
                            <label class="">Designation</label>
                            <input type="text" style="width: 100%" class="form-control JobDesignation" name="JobDesignation" id="JobDesignation" placeholder="Eg: Associate Legal" value="<?php echo $jobdesignation?>">
                          </div>
                        </div>


                        <div class="span3">
                          <div class="control-group">
                            <label class="">Location</label>
                            <input type="text" style="width: 100%" class="form-control JobLocation" name="JobLocation" id="JobLocation" placeholder="Eg: Mumbai Maharashtra" value="<?php echo $joblocation?>">
                          </div>
                        </div>


                        <div class="span3">
                          <div class="control-group">
                            <label class="">Reference Site Name</label>
                            <input type="text" style="width: 100%" class="form-control JobReferenceName" name="JobReferenceName" id="JobReferenceName" placeholder="Eg: https://www.domain.com" value="<?php echo $postreference?>">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row-fluid">
                      <div class="span12">
                        <div class="span3">
                          <div class="control-group">
                            <label class="">Job Role</label>
                            <select style="width: 100%" class="form-control select2 JobRole" name="JobRole" id="JobRole">
                              <?php
                              if ($jobrole == "" || $jobrole == null) {
                                $jobrolenone = 'selected';
                                $jobroleft = '';
                                $jobrolept = '';
                              }else if ($jobrole == "Full Time") {
                                $jobrolenone = '';
                                $jobroleft = 'selected';
                                $jobrolept = '';
                              }else if ($jobrole == "Part-Time") {
                                $jobrolenone = '';
                                $jobroleft = '';
                                $jobrolept = 'selected';
                              }
                              ?>
                              <option value="" <?php echo $jobrolenone?>>Select Role</option>
                              <option value="Full Time" <?php echo $jobroleft?>>Full-Time</option>
                              <option value="Part-Time" <?php echo $jobrolept?>>Part-Time</option>
                            </select>
                          </div>
                        </div>

                        <div class="span3">
                          <div class="control-group">
                            <label class="">Qualification Required</label>
                            <input type="text" style="width: 100%" name="JobQualification" id="JobQualification" placeholder="Eg: HSC / SSC / Graduate / Post Graduate" class="form-control JobQualification" value="<?php echo $jobqualification?>">
                          </div>
                        </div>

                        <div class="span3">
                          <div class="control-group">
                            <label class="">Industry</label>
                            <input type="text" style="width: 100%" name="JobIndustry" id="JobIndustry" placeholder="Eg: Financial Services" class="form-control JobIndustry" value="<?php echo $jobindustry?>">
                          </div>
                        </div>


                        <div class="span3">
                          <div class="control-group">
                             <label class="">Company Name</label>
                              <input type="text" style="width: 100%" name="CompanyName" id="CompanyName" placeholder="Eg: BNC Infotech PVT LTD" class="form-control CompanyName" value="<?php echo $companyname?>">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row-fluid">
                      <div class="span12">
                        <div class="span4">
                          <div class="control-group">
                             <label class="">Logo</label>
                              <input type="file" style="width: 100%" name="CompanyLogo[]" id="CompanyLogo" class="form-control CompanyLogo">
                              <input type="hidden" name="iscompanylogoselected" id="iscompanylogoselected" value="0">
                               <a href="../mobileapi/<?php echo $companyicon?>" target="_blank">View Photo</a>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row-fluid">
                      <div class="span12">
                        <label>Job Profile</label>
                        <script src="https://cdn.tinymce.com/4/tinymce.min.js"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.5.0/highlight.min.js"></script>
                            <style type="text/css">
                              pre {
                                    max-width: 900px;
                                    white-space: pre-wrap;       /* Since CSS 2.1 */
                                      white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
                                      white-space: -pre-wrap;      /* Opera 4-6 */
                                      white-space: -o-pre-wrap;    /* Opera 7 */
                                      word-wrap: break-word;       /* Internet Explorer 5.5+ */
                                  }
                            </style>
                            <textarea id="tempalte" name="JobProfile">
                              <?php echo $jobprofile?>
                            </textarea>

                            <script type="text/javascript">
                           tinymce.init({
                          selector: 'textarea',
                           theme:'modern',
                          plugins: [
                              'advlist autolink lists link image charmap preview hr anchor pagebreak','searchreplace wordcount visualblocks visualchars code','insertdatetime media nonbreaking table contextmenu directionality','template paste textcolor colorpicker textpattern imagetools codesample'
                          ],
                          toolbar: 'bold italic sizeselect fontselect fontsizeselect | hr alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | insertfile undo redo | forecolor backcolor emoticons | code',
                          fontsize_formats: "8pt 10pt 12pt 14pt 16pt 18pt 20pt 22pt 24pt 26pt 28pt 30pt 32pt 34pt 36pt",
                          height: "350",
                          menubar: true
                      });

                      $("button").click(function(){
                        var template = tinyMCE.activeEditor.getContent({format : 'raw'});
                        console.log(template);
                                          $("#show-me").text(template);
                        $('pre code').each(function(i, block) {
                          hljs.highlightBlock(block);
                        });
                                         });
                         </script>
                      </div>
                    </div>
                    <br>
                    <div class="row-fluid">
                      <div class="span6">
                      </div>
                      <button type="Submit" name="BtnSubmitDetails" class="btn btn-info">Submit Details</button>
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
<?php include("footer.php");?>