<?php include("header.php");?>
<?php
  if (isset($_POST["BtnSubmitDetails"])) {

    date_default_timezone_set("Asia/Kolkata");
    $uniquekey = mt_rand(100000,999999);
    $examid = $_POST["examid"];
    $testtitle = $_POST["testtitle"];
    $testdescription = $_POST["testdescription"];
    $testtime = $_POST["testtime"];
    $testmarks = $_POST["testmarks"];
    $testlanguage = $_POST["testlanguage"];
    $item_no = count($_POST["item_no"]);
    $txtTags = $_POST["txtTags"];
    $seriesaddeddate = date("d-m-Y H:i:s");

    for($i =0; $i < $item_no; $i++) {
      mysql_query("INSERT INTO `tbl_testseriestag`(`tagname`, `seriesefid`) VALUES ('$txtTags[$i]','$uniquekey')");
    }

    $add = mysql_query("INSERT INTO `tbl_testserieslist`(`seriesseriesuniquekey`,`refexamid`, `testtitle`, `testdescription`, `testtime`, `testmarks`, `testlanguage`, `seriesaddeddate`) VALUES ('$uniquekey','$examid','$testtitle','$testdescription','$testtime','$testmarks','$testlanguage','$seriesaddeddate')");
    if ($add) {
      echo '<script>window.location = "addtestseries.php?edit='.$examid.'&status=1&msg=Details Saved Successfully!!"</script>';
    }else{
      echo '<script>window.location = "addtestseries.php?edit='.$examid.'&status=0&msg=Sorry Something went Wrong!!"</script>';
    }


  }
?>

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
  .label {
    padding: 6px 4px 6px;
  }
</style>
<style type="text/css">
#sortable-list    { padding:0; }
#sortable-list li { padding:22px 8px; color:#000; cursor:mouse; list-style:none; width:300px; background:#ddd; margin:10px 0; border:1px solid #999;display: inline-block; }
#message-box    { background:#fffea1; border:2px solid #fc0; padding:4px 8px; margin:0 0 14px 0; width:500px; }
#sortable-list span{
  cursor:default; 
}
</style>

<div id="main-content">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li><a href="#">Home</a><span class="divider">&raquo;</span></li>
      <li class="active">Test Series </li>
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


                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="btn btn-primary btn-md" id="" name="" style="margin-top: -5px;">Add New Test</a>
                <div id="collapseOne" class="panel-collapse collapseOne collapse">
                	<br>
	                <div class="row-fluid">
	                	<div class="span12">
	                		<div class="span4">
	                			<div class="control-group">
	                				<label>Test Title</label>
                          <input type="hidden" name="examid" value="<?php echo $_GET["edit"]?>">
	                				<input type="text" name="testtitle" id="testtitle" placeholder="Test Title" style="width: 100%">
	                			</div>
	                		</div>

	                		<div class="span8">
	                			<div class="control-group">
	                				<label>Short Description</label>
	                				<input type="text" name="testdescription" id="testdescription" placeholder="Short Details about Series.."style="width: 90%">
	                			</div>
	                		</div>

	                	</div>
	                </div>
                  <div class="row-fluid">
                    <div class="span12">
                      <div class="span4">
                        <div class="control-group">
                          <label>Test Time</label>
                          <input type="text" name="testtime" placeholder="Eg: 10 Mintutes"  style="width: 100%" />
                        </div>
                      </div>
                      <div class="span4">
                        <div class="control-group">
                          <label>Test Marks</label>
                          <input type="text" name="testmarks" placeholder="Eg: 10 Marks"  style="width: 100%" />
                        </div>
                      </div>

                      <div class="span4">
                        <div class="control-group">
                          <label>Languages</label>
                          <input type="text" name="testlanguage" placeholder="Eg: English/ Hindi / Marathi"  style="width: 80%" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row-fluid">
                    <div class="span12">
                      <div class="span4">
                        <div class="control-group">
                          <label>Exam Tags</label>
                          <input type="hidden" class="form-control ino" id="ino_0" name="item_no[]" value="1">
                          <input type="text" name="txtTags[]" id="txtTags_0" placeholder="Eg: Maths Aptitude"  style="width: 100%" />
                        </div>
                      </div>
                      <div class="span4">
                        <div class="control-group">
                          <button type="button" class="btn btn-success btnAddMoreTag" id="btnAddMoreTag" style="margin-top: 20px">Add More Tags</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div id="tagdiv">

                  </div>

	                
	                <div class="row-fluid">
	                  <button type="Submit" name="BtnSubmitDetails" class="btn btn-info">Submit Details</button>
	                </div>
	            </div>
	            <br>

	            <ul id="sortable-list">
	            	<?php
                $examid = $_GET["edit"];
	            		$getserieslist = mysql_query("select * from tbl_testserieslist where refexamid='$examid'");
	            		while($getserieslistrows = mysql_fetch_array($getserieslist)){

	            	?>
	            		<li>
	                		<a href="testseries.php?edit=<?php echo $getserieslistrows["seriesid"]?>"><span class="black-icons pencil pull-right"></span></a>
	                		<a href="addtestseries.php?edit=<?php echo $getserieslistrows["seriesid"]?>"><h4><?php echo $getserieslistrows["testtitle"]?></h4></a>
		            		<p><?php echo $getserieslistrows["testdescription"]?></p>
                    <h4><?php echo $getserieslistrows["testtime"]?></h4>
                    <h4><?php echo $getserieslistrows["testmarks"]?></h4>
                    <h4><?php echo $getserieslistrows["testlanguage"]?></h4>
                    <br>

                    <?php
                      $seriesseriesuniquekey = $getserieslistrows["seriesseriesuniquekey"];
                      $getseriestag = mysql_query("select * from tbl_testseriestag where seriesefid='$seriesseriesuniquekey'");
                      while($getseriestagrows = mysql_fetch_array($getseriestag)){
                      
                    ?>
                    <span class="label label-success"><?php echo $getseriestagrows["tagname"]?></span>
	                	<?php
                      }
                    ?>
                    </li>
                	<?php
                		}
                	?>

                </ul>

		            
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

<script type="text/javascript">
   tinymce.init({
  selector: 'textarea',
   theme:'modern',
  plugins: [
      'advlist autolink lists link image charmap preview hr anchor pagebreak','searchreplace wordcount visualblocks visualchars code','insertdatetime media nonbreaking table contextmenu directionality','template paste textcolor colorpicker textpattern imagetools codesample'
  ],
  toolbar: 'bold italic sizeselect fontselect fontsizeselect | hr alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | insertfile undo redo | forecolor backcolor emoticons | code',
  fontsize_formats: "8pt 10pt 12pt 14pt 16pt 18pt 20pt 22pt 24pt 26pt 28pt 30pt 32pt 34pt 36pt",
  height: "50",
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