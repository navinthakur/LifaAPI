<?php include("header.php");?>
<style type="text/css">
  tr.odd td.sorting_1{
    background-color: #ffffff;
  }
</style>
<?php
  if (isset($_GET["del"])) {
    $joblistid = $_GET["del"];
    $delq = mysql_query("delete from tbljoblisting where joblistid='$joblistid'");
    if ($delq) {
       echo '<script>window.location = "joblisting.php?current=joblisting&status=1&msg=Record Deleted Successfully!!"</script>';
    }else{
      echo '<script>window.location = "joblisting.php?current=joblisting&status=2&msg=Sorry Something Went Wrong!!"</script>';
    }
  }

    $msg = '';
    date_default_timezone_set("Asia/Kolkata");



    if (isset($_POST["BtnSubmitDetails"])) {
        
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

        $jobquery = mysql_query("INSERT INTO `tbljoblisting`(`jobtitle`, `jobdesignation`, `joblocation`, `postreference`, `jobrole`, `jobqualification`, `jobindustry`, `jobprofile`, `companyname`, `companyicon`, `jobposteddate`) VALUES ('$JobTitle','$JobDesignation','$JobLocation','$JobReferenceName','$JobRole','$JobQualification','$JobIndustry','$JobProfile','$CompanyName','$AgreementPath','$jobposteddate')");

        if ($jobquery) {
          echo '<script>window.location = "joblisting.php?current=joblisting&status=1&msg=Details Saved Successfully!!"</script>';

        }else{
          echo '<script>window.location = "joblisting.php?current=joblisting&status=0&msg=Sorry Something went Wrong!!"</script>';
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
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="btn btn-primary btn-md" id="" name="" style="margin-top: -5px;">Post New Job</a>
                <bR>
                <div id="collapseOne" class="panel-collapse collapseOne collapse">
                  <bR>
                  <div class="row-fluid">
                      <div class="span12">
                        <div class="span3">
                          <div class="control-group">
                            <label class="">Title</label>
                            <input type="text" style="width: 100%" class="form-control JobTitle" name="JobTitle" id="JobTitle" placeholder="Job Title">
                          </div>
                        </div>
                        <div class="span3">
                          <div class="control-group">
                            <label class="">Designation</label>
                            <input type="text" style="width: 100%" class="form-control JobDesignation" name="JobDesignation" id="JobDesignation" placeholder="Eg: Associate Legal">
                          </div>
                        </div>


                        <div class="span3">
                          <div class="control-group">
                            <label class="">Location</label>
                            <input type="text" style="width: 100%" class="form-control JobLocation" name="JobLocation" id="JobLocation" placeholder="Eg: Mumbai Maharashtra">
                          </div>
                        </div>


                        <div class="span3">
                          <div class="control-group">
                            <label class="">Reference Site Name</label>
                            <input type="text" style="width: 100%" class="form-control JobReferenceName" name="JobReferenceName" id="JobReferenceName" placeholder="Eg: https://www.domain.com">
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
                              <option value="">Select Role</option>
                              <option value="Full Time">Full-Time</option>
                              <option value="Part-Time">Part-Time</option>
                            </select>
                          </div>
                        </div>

                        <div class="span3">
                          <div class="control-group">
                            <label class="">Qualification Required</label>
                            <input type="text" style="width: 100%" name="JobQualification" id="JobQualification" placeholder="Eg: HSC / SSC / Graduate / Post Graduate" class="form-control JobQualification">
                          </div>
                        </div>

                        <div class="span3">
                          <div class="control-group">
                            <label class="">Industry</label>
                            <input type="text" style="width: 100%" name="JobIndustry" id="JobIndustry" placeholder="Eg: Financial Services" class="form-control JobIndustry">
                          </div>
                        </div>


                        <div class="span3">
                          <div class="control-group">
                             <label class="">Company Name</label>
                              <input type="text" style="width: 100%" name="CompanyName" id="CompanyName" placeholder="Eg: BNC Infotech PVT LTD" class="form-control CompanyName">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row-fluid">
                      <div class="span12">
                        <div class="span3">
                          <div class="control-group">
                             <label class="">Logo</label>
                              <input type="file" style="width: 100%" name="CompanyLogo[]" id="CompanyLogo" class="form-control CompanyLogo">
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
                            <textarea id="tempalte" name="JobProfile"></textarea>

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
                  </div>
                  <table class="table table-bordered text-center data-tbl-inbox">
                    <thead>
                      <tr>
                        <th class="center">Job Title</th>
                        <th class="center">Designation</th>
                        <th class="center">Location</th>
                        <th class="center">Role</th>
                        <th class="center">Qualification</th>
                        <th class="center">Industry</th>
                        <th class="center">Posted Date</th>
                        <th class="center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $getjoblist = mysql_query("select * from tbljoblisting order by joblistid desc");
                      while($getjoblistrows = mysql_fetch_array($getjoblist)){

                      ?>
                      <tr>
                        <td class="center"><?php echo $getjoblistrows["jobtitle"]?></td>
                        <td class="center"><?php echo $getjoblistrows["jobdesignation"]?></td>
                        <td class="center"><?php echo $getjoblistrows["joblocation"]?></td>
                        <td class="center"><?php echo $getjoblistrows["jobrole"]?></td>
                        <td class="center"><?php echo $getjoblistrows["jobqualification"]?></td>
                        <td class="center"><?php echo $getjoblistrows["jobindustry"]?></td>
                        <td class="center"><?php echo $getjoblistrows["jobposteddate"]?></td>
                        <td class="">
                          <div class="btn-group pull-right">
                              <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-cog"></i><span class="caret"></span></button>
                              <ul class="dropdown-menu">
                                <li><a href="joblistingdetails.php?edit=<?php echo $getjoblistrows["joblistid"]?>" target="_blank"><i class="icon-edit"></i> View/Edit Post</a></li>
                                <li><a href="joblisting.php?del=<?php echo $getjoblistrows["joblistid"]?>"><i class="icon-trash"></i> Remove Post</a></li>
                                
                              </ul>
                            </div>
                        </td>
                      </tr>
                      <?php
                         }
                      ?>

                    </tbody>
                  </table>
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