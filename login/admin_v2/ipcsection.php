<?php include("header.php");?>
<?php
    $msg = '';
    date_default_timezone_set("Asia/Kolkata");
    if (isset($_POST["btnsubmitchapterdetails"])) {
       $chapteritemcount = count($_POST["chapteritem_no"]);
       $actchapter = $_POST["actchapter"];
       $chapterintro = $_POST["chapterintro"];
       $chapterstartfrom = $_POST["chapterstartfrom"];
       $chapterendfrom = $_POST["chapterendfrom"];
       $languagetype = $_POST["languagetype"];

       for($i = 0; $i < $chapteritemcount; $i++){
          $actuniqueid = mt_rand(10000, 99999);
            $PropertyQuery = mysql_query("INSERT INTO `lawsectionact`(`languagetype`,`actuniqueid`,`acttile`, `actchapter`, `sectionchapter`) VALUES ('$languagetype','$actuniqueid','$chapterintro[$i]','$actchapter[$i]','( $chapterstartfrom[$i] to $chapterendfrom[$i] )')");
       }
       if ($PropertyQuery) {
       // $msg =  '<label class="label label-success">Details Saved Successfully!!</label><br><br>';
        echo '<script>window.location = "ipcsection.php?current=ipcsection&status=1&msg=Details Saved Successfully!!"</script>';

      }else{
        //$msg = '<label class="label label-danger">Sorry Something Went Wrong!!</label><br><br>';

        echo '<script>window.location = "ipcsection.php?current=ipcsection&status=0&msg=Sorry Something went Wrong!!"</script>';
      }


     
    }


    if (isset($_POST["BtnSubmitDetails"])) {
      
      
      $selectedappuniqueid = $_POST["selectedappuniqueid"];    
      $sectionlanguagetype = $_POST["sectionlanguagetype"];
      // Owner Count
      $itemcount = count($_POST["item_no"]);
      $Sectionno = $_POST["Sectionno"];
      $ChapterTitle = $_POST["ChapterTitle"];
      $ChapterExplanation = $_POST["ChapterExplanation"];
      
       for($i = 0; $i < $itemcount; $i++){
           $PropertyQuery = mysql_query("INSERT INTO `sectionactintro`(`sectionlanguagetype`,`sectionactno`,`sectionacttitle`, `actintro`, `sectionrefid`) VALUES ('$sectionlanguagetype','$Sectionno[$i]','$ChapterTitle[$i]','$ChapterExplanation[$i]','$selectedappuniqueid')");
        }
      
        if ($PropertyQuery) {
         // $msg =  '<label class="label label-success">Details Saved Successfully!!</label><br><br>';
          echo '<script>window.location = "ipcsection.php?current=ipcsection&status=1&msg=Details Saved Successfully!!"</script>';

        }else{
          //$msg = '<label class="label label-danger">Sorry Something Went Wrong!!</label><br><br>';

          echo '<script>window.location = "ipcsection.php?current=ipcsection&status=0&msg=Sorry Something went Wrong!!"</script>';
        }
      
    }
    ?>
<div id="main-content">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li><a href="#">Home</a><span class="divider">&raquo;</span></li>
      <li class="active">Indian Panel Code ACT</li>
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

              <div class="box-tab">
                <div class="tabbable"> 
                  <!-- Only required for left/right tabs -->
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab1" data-toggle="tab">Add New Chapter</a></li>
                    <li><a href="#tab2" data-toggle="tab">Add New Section</a></li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
                      <form class="" method="post" action="">
                        <div class="">
                            <br>
                            <div class="">
                              <div class="span3">
                                <div class="control-group">
                                  <label class="">Language</label>
                                  <select class="form-control select2 languagetype" name="languagetype" id="languagetype" style="width: 100%">
                                    <option value="">Select Language Type</option>
                                    <option value="English">English</option>
                                    <option value="Hindi">Hindi</option>
                                    <option value="Marathi">Marathi</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row-fluid">
                            <div class="span12">
                              <div class="span3">
                                <div class="control-group">
                                  <label>Chapter</label>
                                  <input type="hidden" class="form-control chapteritem_no" id="chapteritem_no_0" name="chapteritem_no[]" style="width:50px" value="1">
                                  <input type="text" style="width: 100%" name="actchapter[]" id="actchapter_0" class="form-control actchapter" placeholder="for eg: Chapter - I">
                                </div>
                              </div>
                              <div class="span3">
                                <div class="control-group">
                                  <label>Chapter Introduction</label>
                                  <input type="text" style="width: 100%" name="chapterintro[]" id="chapterintro_0" class="form-control chapterintro" placeholder="Enter Chapter Introduction">
                                </div>
                              </div>

                              <div class="span2">
                                <div class="control-group">
                                  <label>From</label>
                                  <input type="text" style="width: 100%" name="chapterstartfrom[]" id="chapterstartfrom_0" class="form-control chapterstartfrom" placeholder="Enter Serial Number">
                                </div>
                              </div>

                              <div class="span2">
                                <div class="control-group">
                                  <label>To</label>
                                  <input type="text" style="width: 100%" name="chapterendfrom[]" id="chapterendfrom_0" class="form-control chapterendfrom" placeholder="Enter Serial Number">
                                </div>
                              </div>


                              <div class="span2" style="margin-top: 20px">
                                <div class="control-group">
                                  <button type="button" class="btn btn-info btnaddmorechapter" id="btnaddmorechapter" name="btnaddmorechapter">Add More</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div id="extrachapter"></div>
                          <div class="row-fluid">
                            <div class="span12">
                              <div class="span5"></div>
                              <button type="submit" name="btnsubmitchapterdetails" id="btnsubmitchapterdetails" class="btn btn-primary btnsubmitchapterdetails">Submit Details</button>
                            </div>
                          </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="tab2">
                      <form class="" method="post" action="">
                        <br>
                        <div class="row-fluid">
                          <div class="span12">
                            <div class="span3">
                              <div class="control-group">
                                <label>Select Chapter</label>
                                 <select class="form-control select2 selectedappuniqueid" name="selectedappuniqueid" id="selectedappuniqueid" style="width: 100%">
                                <option>Select Chapter</option>
                                <?php
                                  $getchapter = mysql_query("SELECT * FROM `lawsectionact`");
                                  while($getchapterrows = mysql_fetch_array($getchapter)){

                                ?>
                                <option value="<?php echo $getchapterrows["actuniqueid"]?>"><?php echo $getchapterrows["actchapter"]?> <?php echo $getchapterrows["sectionchapter"]?> </option>
                                <?php
                                    }
                                ?>
                              </select>
                              </div>
                            </div>
                            <div class="span3">
                              <div class="control-group">
                                <label class="">Language</label>
                                <select class="form-control select2 sectionlanguagetype" name="sectionlanguagetype" id="sectionlanguagetype" style="width: 100%">
                                  <option value="">Select Language Type</option>
                                  <option value="English">English</option>
                                  <option value="Hindi">Hindi</option>
                                  <option value="Marathi">Marathi</option>
                                </select>
                              </div>
                            </div>

                            <div class="span2">
                              <div class="control-group">
                                <label>Section  No</label>
                                <input type="text" style="width: 100%" name="Sectionno[]" required="" id="Sectionno_0" class="Sectionno form-control" placeholder="Enter Section no.." />
                              </div>
                            </div>

                            <div class="span4">
                              <div class="control-group">
                                <label>Heading</label>
                                <input type="hidden" class="form-control ino" id="ino_0" name="item_no[]" style="width:50px" value="1">
                                <input type="text" style="width: 100%" name="ChapterTitle[]" required="" id="ChapterTitle_0" class="ChapterTitle form-control" placeholder="Enter Title here.." />
                              </div>
                            </div>
                          </div>
                          <div class="">
                            <label>Paragraph</label>
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
                            <textarea id="tempalte" name="ChapterExplanation[]" rows="10" cols="5"></textarea>

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
                        <br><br>
                        <div class="span5"></div>
                          <button type="Submit" name="BtnSubmitDetails" id="BtnSubmitDetails" class="BtnSubmitDetails btn btn-success">Submit Details</button>
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
</div>
<?php include("footer.php");?>