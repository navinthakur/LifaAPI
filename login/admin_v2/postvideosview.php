<?php include("header.php");?>
<style type="text/css">
  tr.odd td.sorting_1{
    background-color: #ffffff;
  }
</style>

<?php
  if (isset($_GET["view"])) {
    $videoid = $_GET["view"];
    $getdetails = mysql_query("SELECT * FROM `tblpostvideos` where videoid='$videoid'");
    $getdetailsrows = mysql_fetch_assoc($getdetails);
    $VideoProfessorName = $getdetailsrows["VideoProfessorName"];
    $VideoProfessorDesignation = $getdetailsrows["VideoProfessorDesignation"];
    $VideoHeading = $getdetailsrows["VideoHeading"];
    $VideoTitle = $getdetailsrows["VideoTitle"];
    $VideoLanguage = $getdetailsrows["VideoLanguage"];
    $VideoThumbnail = $getdetailsrows["VideoThumbnail"];
    $includeslidersection = $getdetailsrows["includeslidersection"];
    $includebelowsection = $getdetailsrows["includebelowsection"];
    $includeintrending = $getdetailsrows["includeintrending"];
    $includeinlive = $getdetailsrows["includeinlive"];
    $VideoUploadType = $getdetailsrows["VideoUploadType"];
    $YoutubeVideoLink = $getdetailsrows["YoutubeVideoLink"];
    $YoutubeServerFile = $getdetailsrows["YoutubeServerFile"];
    $VideoDescription = $getdetailsrows["VideoDescription"];
  }

  if (isset($_GET["del"])) {
    $videoid  = $_GET["del"];
    $delq = mysql_query("delete from tblpostvideos where videoid='$videoid'");
    if ($delq) {
      echo '<script>window.location = "postvideos.php?current=videos&status=1&msg=Video Deleted Successfully!!"</script>';
    }else{
       echo '<script>window.location = "postvideos.php?current=videos&status=0&msg=Sorry Something went Wrong!!"</script>';
    }
  }

    if (isset($_POST["BtnSubmitDetails"])) {

      $videoid = $_POST["videoid"];
      $VideoProfessorName = $_POST["VideoProfessorName"];
      $VideoProfessorOccupation = $_POST["VideoProfessorOccupation"];
      $VideoHeading = $_POST["VideoHeading"];
      $VideoTitle = $_POST["VideoTitle"];
      $VideoLanguage = $_POST["VideoLanguage"];
      $includeslidersection = $_POST["includeslidersection"];
      $includebelowsection = $_POST["includebelowsection"];
      $includeintrending = $_POST["includeintrending"];
      $includeinlive = $_POST["includeinlive"];
      $VideoUploadType = $_POST["VideoUploadType"];
      $isservervideoselected = $_POST["isservervideoselected"];
      if ($VideoUploadType == "Server") {
        
        if ($isservervideoselected != "0") {
           $file = rand(1000,100000)."-".$_FILES['file']['name'];
           $file_loc = $_FILES['file']['tmp_name'];
           $file_size = $_FILES['file']['size'];
           $file_type = $_FILES['file']['type'];
           $folder="uploads/";
           
           // new file size in KB
           $new_size = $file_size/1024;  
           // new file size in KB
           
           // make file name in lower case
           $new_file_name = strtolower($file);
           // make file name in lower case
           
           $final_file=str_replace(' ','-',$new_file_name);
           if(move_uploaded_file($file_loc,$folder.$final_file))
           {
            $VideoPath = $folder.$new_file_name;
            // Write server video upload query
            mysql_query("UPDATE `tblpostvideos` SET YoutubeServerFile='$VideoPath' where videoid='$videoid'");

           }
        }
         
      }
       $YoutubeVideoLink = $_POST["YoutubeVideoLink"];
      $VideoDescription = $_POST["VideoDescription"];
      $posteddate = date("Y-m-d H:i:s");
      $VideoThumbnailSelected = $_POST["VideoThumbnailSelected"];
      if ($VideoThumbnailSelected != "0") {
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
            // write video thumbnail upload query
            mysql_query("UPDATE `tblpostvideos` SET VideoThumbnail='$VideoThumbnailPath' where videoid='$videoid'");
          }
        }
      }


      $addvideo = mysql_query("UPDATE `tblpostvideos` SET `VideoProfessorName`='$VideoProfessorName',`VideoProfessorDesignation`='$VideoProfessorOccupation',`VideoHeading`='$VideoHeading',`VideoTitle`='$VideoTitle',`VideoLanguage`='$VideoLanguage',`includeslidersection`='$includeslidersection',`includebelowsection`='$includebelowsection',`includeintrending`='$includeintrending',`includeinlive`='$includeinlive',`VideoUploadType`='$VideoUploadType',`YoutubeVideoLink`='$YoutubeVideoLink',`VideoDescription`='$VideoDescription' WHERE `videoid`='$videoid'");
      if ($addvideo) {
          echo '<script>window.location = "postvideosview.php?view='.$videoid.'&current=videos&status=1&msg=Details Updated Successfully!!"</script>';

        }else{
          echo '<script>window.location = "postvideosview.php?view='.$videoid.'&current=videos&status=0&msg=Sorry Something went Wrong!!"</script>';
        }


    }
?>
<div id="main-content">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li><a href="#">Home</a><span class="divider">&raquo;</span></li>
      <li class="active">Post Videos</li>
    </ul>

   
    <div class="row-fluid">
      <div class="span12">

        <div class="nonboxy-widget">
            
          <div class="widget-content">
            <div class="widget-box">

              <form class="well" style="background: #ffffff" method="post" action="" enctype="multipart/form-data">
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

               <div class="row-fluid">
                      <div class="span12">
                        <div class="span3">
                          <div class="control-group">
                            <label>Professor/Teacher Name</label>
                            <input type="text" style="width: 100%" name="VideoProfessorName" id="VideoProfessorName" class="VideoProfessorName" placeholder="Professor/Teacher Name here.." required=""  tabindex="1" value="<?php echo $VideoProfessorName?>">
                          </div>
                        </div>
                        <div class="span3">
                          <div class="control-group">
                            <label>Professor Occupation</label>
                            <input type="text" style="width: 100%" name="VideoProfessorOccupation" id="VideoProfessorOccupation" class="VideoProfessorOccupation" placeholder="Professor Occupation.." required=""  tabindex="1" value="<?php echo $VideoProfessorDesignation?>">
                          </div>
                        </div>


                        <div class="span3">
                          <div class="control-group">
                            <label>Video Title/Subject</label>
                            <input type="text" style="width: 100%" name="VideoTitle" id="VideoTitle" class="VideoTitle" placeholder="Video Title/Subject Name.."   tabindex="2" value="<?php echO $VideoTitle?>">
                          </div>
                        </div>
                        <div class="span3">
                          <div class="control-group">
                            <label>Video Heading</label>
                            <input type="hidden" name="videoid" id="videoid" value="<?php echo $_GET["view"]?>">
                            <input type="text" style="width: 100%" name="VideoHeading" id="VideoHeading" class="VideoHeading" placeholder="Video Heading here.."  tabindex="1" value="<?php echo $VideoHeading?>">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row-fluid">
                      <div class="span12">
                         <div class="span3">
                          <div class="control-group">
                            <label>Video Language</label>
                            <select style="width: 100%" name="VideoLanguage" id="VideoLanguage" class="VideoLanguage"  tabindex="3">
                              <?php
                                if ($VideoLanguage == "" || $VideoLanguage == null) {
                                  $VideoLanguagenone = 'selected';
                                  $VideoLanguageenglish = '';
                                  $VideoLanguagehindi = '';
                                  $VideoLanguagemarathi = '';
                                }else if ($VideoLanguage == "English") {
                                  $VideoLanguagenone = '';
                                  $VideoLanguageenglish = 'selected';
                                  $VideoLanguagehindi = '';
                                  $VideoLanguagemarathi = '';
                                }else if ($VideoLanguage == "Hindi") {
                                  $VideoLanguagenone = '';
                                  $VideoLanguageenglish = '';
                                  $VideoLanguagehindi = 'selected';
                                  $VideoLanguagemarathi = '';
                                }else if ($VideoLanguage == "Marathi") {
                                  $VideoLanguagenone = '';
                                  $VideoLanguageenglish = '';
                                  $VideoLanguagehindi = '';
                                  $VideoLanguagemarathi = 'selected';
                                }
                              ?>
                              <option value="" <?php echo $VideoLanguagenone?>>Select Option</option>
                              <option value="English"  <?php echo $VideoLanguageenglish ?>>English</option>
                              <option value="Hindi" <?php echo $VideoLanguagehindi ?>>Hindi</option>
                              <option value="Marathi" <?php echo $VideoLanguagemarathi ?>>Marathi</option>
                            </select>
                          </div>
                        </div>
                        <div class="span3">
                          <div class="control-group">
                            <label>Video Thumbnail/Cover Photo</label>
                            <input type="file" name="VideoThumbnail[]" id="VideoThumbnail"    tabindex="4">
                            <input type="hidden" name="VideoThumbnailSelected" id="VideoThumbnailSelected" value="0">
                            <a href="http://35.194.40.144/agentbhai/law/mobileapi/<?php echo $VideoThumbnail?>" target="_blank">View</a>
                          </div>
                        </div>

                        <div class="span3">
                          <div class="control-group">
                            <label>Include in <b>Slider</b> Section?</label>
                            <select style="width: 100%" name="includeslidersection" id="includeslidersection" class="includeslidersection"  required=""  tabindex="5">
                              <?php
                                if ($includeslidersection == "" || $includeslidersection == null) {
                                  $includeslidersectionnone = 'selected';
                                  $includeslidersectionyes = '';
                                  $includeslidersectionyesno = '';
                                }else if ($includeslidersection == "Yes") {
                                  $includeslidersectionnone = '';
                                  $includeslidersectionyes = 'selected';
                                  $includeslidersectionyesno = '';
                                }else if ($includeslidersection == "No") {
                                  $includeslidersectionnone = '';
                                  $includeslidersectionyes = '';
                                  $includeslidersectionyesno = 'selected';
                                }
                              ?>
                              <option <?php echo $includeslidersectionnone?>>Select Option</option>
                              <option <?php echo $includeslidersectionyes?>>Yes</option>
                              <option <?php echo $includeslidersectionyesno?>>No</option>
                            </select>
                          </div>
                        </div>


                        <div class="span3">
                          <div class="control-group">
                            <label>Include in <b>Below</b> Section?</label>
                            <select style="width: 100%" name="includebelowsection" id="includebelowsection" class="includebelowsection"  required=""  tabindex="5">
                              <?php
                                if ($includebelowsection == "" || $includebelowsection == null) {
                                  $includebelowsectionnone = 'selected';
                                  $includebelowsectionyes = '';
                                  $includebelowsectionno = '';
                                }else if ($includebelowsection == "Yes") {
                                  $includebelowsectionnone = '';
                                  $includebelowsectionyes = 'selected';
                                  $includebelowsectionno = '';
                                }else if ($includebelowsection == "No") {
                                  $includebelowsectionnone = '';
                                  $includebelowsectionyes = '';
                                  $includebelowsectionno = 'selected';
                                }
                              ?>
                              <option <?php echo $includebelowsectionnone?>>Select Option</option>
                              <option <?php echo $includebelowsectionyes?>>Yes</option>
                              <option <?php echo $includebelowsectionno?>>No</option>
                            </select>
                          </div>
                        </div>                      
                      </div>
                    </div>
                    <div class="row-fluid">
                      <div class="span12">
                        <div class="span3">
                          <div class="control-group">
                            <label>Include Post in <b>Trending</b> Section?</label>
                            <select style="width: 100%" name="includeintrending" id="includeintrending" class="includeintrending"    tabindex="5">
                              <?php
                                if ($includeintrending == "" || $includeintrending == null) {
                                  $includeintrendingnone = 'selected';
                                  $includeintrendingyes = '';
                                  $includeintrendingno = '';
                                }else if ($includeintrending == "Yes") {
                                  $includeintrendingnone = '';
                                  $includeintrendingyes = 'selected';
                                  $includeintrendingno = '';
                                }else if ($includeintrending == "No") {
                                  $includeintrendingnone = '';
                                  $includeintrendingyes = '';
                                  $includeintrendingno = 'selected';
                                }
                              ?>
                              <option value="" <?php echo $includeintrendingnone?>>Select Option</option>
                              <option value="Yes" <?php echo $includeintrendingyes?>>Yes</option>
                              <option value="No" <?php echo $includeintrendingno?>>No</option>
                            </select>
                          </div>
                        </div>   
                        <div class="span3">
                          <div class="control-group">
                            <label>Include Post in <b>LIVE</b> Section?</label>
                            <select style="width: 100%" name="includeinlive" id="includeinlive" class="includeinlive"    tabindex="6">
                              <?php
                                if ($includeinlive == "" || $includeinlive == null) {
                                  $includeinlivenone = 'selected';
                                  $includeinliveyes = '';
                                  $includeinliveno = '';
                                }else if ($includeinlive == "Yes") {
                                  $includeinlivenone = '';
                                  $includeinliveyes = 'selected';
                                  $includeinliveno = '';
                                }else if ($includeinlive == "No") {
                                  $includeinlivenone = '';
                                  $includeinliveyes = '';
                                  $includeinliveno = 'selected';
                                }
                              ?>
                              <option value="" <?php echo $includeinlivenone?>>Select Option</option>
                              <option value="Yes" <?php echo $includeinliveyes?>>Yes</option>
                              <option value="No" <?php echo $includeinliveno?>>No</option>
                            </select>
                          </div>
                        </div>
                        <div class="span3">
                          <div class="control-group">
                            <label>Video Upload Type</label>
                            <select style="width: 100%" id="VideoUploadType" name="VideoUploadType" class="VideoUploadType"    tabindex="7">
                              <?php
                                if ($VideoUploadType == "" || $VideoUploadType == null) {
                                  $VideoUploadTypenone = 'selected';
                                  $VideoUploadTypeyoutube = '';
                                  $VideoUploadTypeserver = '';
                                }else if ($VideoUploadType == "Youtube") {
                                  $VideoUploadTypenone = '';
                                  $VideoUploadTypeyoutube = 'selected';
                                  $VideoUploadTypeserver = '';
                                }else if ($VideoUploadType == "Server") {
                                  $VideoUploadTypenone = '';
                                  $VideoUploadTypeyoutube = '';
                                  $VideoUploadTypeserver = 'selected';
                                }
                              ?>
                              <option value="" <?php echo $VideoUploadTypenone?>>Select Option</option>
                              <option value="Youtube" <?php echo $VideoUploadTypeyoutube?>>Youtube</option>
                              <option value="Server" <?php echo $VideoUploadTypeserver?>>Server</option>
                            </select>
                          </div>
                        </div>
                        <div class="span3 videoextradivyoutube ">
                          <div class="control-group">
                            <label>Youtube Video Link</label>
                            <input type="text" style="width: 100%" name="YoutubeVideoLink" id="YoutubeVideoLink" class="YoutubeVideoLink" placeholder="Youtube Link Here.." value="<?php echo $YoutubeVideoLink?>"   tabindex="8">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row-fluid">
                      <div class="span12">
                        <div class="span3 videoextradiv hidden">
                          <div class="control-group">
                            <label>Upload Video</label>
                            <input type="file" style="width: 100%" name="file" id="ServerVideofile" class="file"   tabindex="8">
                            <input type="hidden" name="isservervideoselected" id="isservervideoselected" value="0">
                          </div>
                        </div>

                      </div>
                    </div>
                    <div class="row-fluid">
                      <div class="span12">
                        <div class="control-group">
                          <label>Video Description</label>
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
                            <textarea id="tempalte" name="VideoDescription" placeholder="Write about Video">
                              <?php echo $VideoDescription?>
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
                          height: "250",
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
                    </div>
                    
                    <div class="row-fluid">
                      <div class="span6"></div>
                      <button type="Submit" name="BtnSubmitDetails" id="BtnSubmitDetails" class="btn btn-info">Submit Details</button>
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