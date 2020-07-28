<?php include("header.php");?>


<?php
	if (isset($_POST["BtnSubmitDetails"])) {

		$seriestitle = $_POST["seriestitle"];
		$seriesdetails = $_POST["seriesdetails"];
		
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

	    $TestSeriesQuery = mysql_query("INSERT INTO `tbl_testseries`(`seriestitle`, `seriesdetails`, `seriesicon`) VALUES ('$seriestitle','$seriesdetails','$AgreementPath')");
	    if ($TestSeriesQuery) {
        echo '<script>window.location = "testseries.php?status=1&msg=Details Saved Successfully!!"</script>';

      }else{
        echo '<script>window.location = "testseries.php?status=0&msg=Sorry Something went Wrong!!"</script>';
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
      <li class="active">Test Series</li>
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


                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="btn btn-primary btn-md" id="" name="" style="margin-top: -5px;">Add New Test Series</a>
                <div id="collapseOne" class="panel-collapse collapseOne collapse">
                	<br>
	                <div class="row-fluid">
	                	<div class="span12">
	                		<div class="span4">
	                			<div class="control-group">
	                				<label>Series Title</label>
	                				<input type="text" name="seriestitle" id="seriestitle" placeholder="Series Title" style="width: 100%">
	                			</div>
	                		</div>

	                		<div class="span4">
	                			<div class="control-group">
	                				<label>Series Details</label>
	                				<input type="text" name="seriesdetails" id="seriesdetails" placeholder="Short Details about Series.."style="width: 100%">
	                			</div>
	                		</div>


	                		<div class="span4">
	                			<div class="control-group">
	                				<label>Icon</label>
	                				<input type="file" name="CompanyLogo[]" id="CompanyLogo" style="width: 100%">
	                			</div>
	                		</div>
	                	</div>
	                </div>
	                
	                <div class="row-fluid">
	                  <button type="Submit" name="BtnSubmitDetails" class="btn btn-info">Submit Details</button>
	                </div>
	            </div>
	            <br>

	            <ul id="sortable-list">
	            	<?php
	            		$getserieslist = mysql_query("select * from tbl_testseries");
	            		while($getserieslistrows = mysql_fetch_array($getserieslist)){

	            	?>
	            		<li>
	                		<a href="testseries.php?edit=<?php echo $getserieslistrows["examid"]?>"><span class="black-icons pencil pull-right"></span></a>
	                		<img src="../../mobileapi/<?php echo $getserieslistrows["seriesicon"]?>" style="width: 60px;float: left;padding: 10px">
	                		<a href="addtestseries.php?edit=<?php echo $getserieslistrows["examid"]?>" target="_blank"><h4><?php echo $getserieslistrows["seriestitle"]?></h4></a>
		            		<p><?php echo $getserieslistrows["seriesdetails"]?></p>
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