<?php include("header.php");?>
<script src="https://cdn.tinymce.com/4/tinymce.min.js"></script>
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.5.0/highlight.min.js"></script>



<style type="text/css">
  tr.odd td.sorting_1{
    background-color: #ffffff;
  }
  pre {
    max-width: 900px;
    white-space: pre-wrap;       /* Since CSS 2.1 */
      white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
      white-space: -pre-wrap;      /* Opera 4-6 */
      white-space: -o-pre-wrap;    /* Opera 7 */
      word-wrap: break-word;       /* Internet Explorer 5.5+ */
  }
</style>


<div id="main-content">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li><a href="#">Home</a><span class="divider">&raquo;</span></li>
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

              <?php
                $getclatabout = mysql_query("select * from clatsyllabus");
                $getclataboutrows = mysql_fetch_array($getclatabout);
                $clatcontent = $getclataboutrows["syllabusdetails"];

                if (isset($_POST["BtnSubmitDetails"])) {
                  $categoryid = $_POST["categoryid"];
                  $subcategoryid = $_POST["subcategoryid"];
                  $clatcontent = $_POST["clatcontent"];
                  $update = mysql_query("UPDATE `clatsyllabus` SET `syllabusdetails`='$clatcontent'");
                  if ($update) {
                    echo '<script>window.location = "clatsyllabus.php?categoryid='.$categoryid.'&subcategoryid='.$subcategoryid.'&status=1&msg=Details Saved Successfully!!"</script>';
                  }else{
                    echo '<script>window.location = "clatsyllabus.php?categoryid='.$categoryid.'&subcategoryid='.$subcategoryid.'&status=0&msg=Sorry Something went Wrong!!"</script>';
                  }
                }
              ?>
                <form class="well" style="background: #ffffff" method="post" action="" enctype="multipart/form-data">
                  

                      <div class="row-fluid">
                        <div class="span12">
                          <label>Details </label>
                          
                          <input type="hidden" name="categoryid" value="<?php echo $_GET["categoryid"]?>">
                          <input type="hidden" name="subcategoryid" value="<?php echo $_GET["subcategoryid"]?>">
                          <textarea name="clatcontent" id="tempalte">
                           <?php echo $clatcontent?>
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

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.6.0//js/froala_editor.pkgd.min.js"></script>
<script type="text/javascript">
  $(function() {
    $('textarea#froala-editor').froalaEditor()
  });
</script>