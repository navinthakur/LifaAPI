<?php include("header.php");?>

<?php
$casestudyid = $_GET["view"];
$getdetails = mysql_query("SELECT * from tblcasestudies where casestudyid='$casestudyid'");
$getdetailsrows = mysql_fetch_array($getdetails);

	if (isset($_POST["BtnSubmitDetails"])) {

		$casestudycourtname = $_POST["casestudycourtname"];
		$clientname = mysql_real_escape_string($_POST["clientname"]);
		$petitiondetails = mysql_real_escape_string($_POST["petitiondetails"]);
		$petitiondate = mysql_real_escape_string($_POST["petitiondate"]);
		$benchcontent = mysql_real_escape_string($_POST["benchcontent"]);
		$citationcontent = mysql_real_escape_string($_POST["citationcontent"]);
		$advocatescontent = mysql_real_escape_string($_POST["advocatescontent"]);
		$judgmentcontent = mysql_real_escape_string($_POST["judgmentcontent"]);

		

		$addquery = mysql_query("INSERT INTO `tblcasestudies`(`casestudycourtname`, `clientname`, `petitiondetails`, `petitiondate`, `benchcontent`, `citationcontent`, `advocatescontent`, `judgmentcontent`) VALUES ('$casestudycourtname','$clientname','$petitiondetails','$petitiondate','$benchcontent','$citationcontent','$advocatescontent','$judgmentcontent')");

		if ($addquery) {
	      echo '<script>window.location = "casestudiesdetails.php?status=1&msg=Details Saved Successfully!!"</script>';
	    }else{
	      echo '<script>window.location = "casestudiesdetails.php?status=0&msg=Sorry Something went Wrong!!"</script>';
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


<div id="main-content">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li><a href="#">Home</a><span class="divider">&raquo;</span></li>
      <li class="active">Case Law</li>


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
		                				<label>Court Name</label>
		                				<select name="casestudycourtname" id="casestudycourtname" style="width: 100%">
		                					<option value="Supreme Court">Supreme Court</option>
		                					<option value="High Court">High Court</option>
		                					<option value="District Court">District Court</option>
		                					<option value="Tribunal Court">Tribunal Court</option>
		                				</select>
		                			</div>
		                		</div>
		                		<div class="span3">
		                			<div class="control-group">
		                				<label>Client Name</label>
		                				<input type="text" name="clientname" placeholder="Client Name" style="width: 100%" value="<?php echo $getdetailsrows["clientname"]?>">
		                			</div>
		                		</div>

		                		<div class="span3">
		                			<div class="control-group">
		                				<label>Petition Details</label>
		                				<input type="text" name="petitiondetails" placeholder="Petition Details"style="width: 100%" value="<?php echo $getdetailsrows["petitiondetails"]?>">
		                			</div>
		                		</div>


		                		<div class="span3">
		                			<div class="control-group">
		                				<label>Petition Date</label>
		                				<input type="text" name="petitiondate" placeholder="Petition Date" style="width: 100%" value="<?php echo $getdetailsrows["petitiondate"]?>">
		                			</div>
		                		</div>
		                	</div>
		                </div>
		                <div class="row-fluid">
		                	<div class="span12">
		            			<div class="control-group">
		            				<label>Bench Details</label>
		            				<textarea name="benchcontent" id="tempalte">
		            					<?php echo $getdetailsrows["benchcontent"]?>
		            				</textarea>
		            			</div>
		                	</div>
		                </div>

		                <div class="row-fluid">
		                	<div class="span12">
		            			<div class="control-group">
		            				<label>Citation Details</label>
		            				<textarea name="citationcontent" id="tempalte">
		            					<?php echo $getdetailsrows["citationcontent"]?>
		            				</textarea>
		            			</div>
		                	</div>
		                </div>

		                <div class="row-fluid">
		                	<div class="span12">
		            			<div class="control-group">
		            				<label>Advocates Details</label>
		            				<textarea name="advocatescontent" id="tempalte">
		            					<?php echo $getdetailsrows["advocatescontent"]?>
		            				</textarea>
		            			</div>
		                	</div>
		                </div>

		                <div class="row-fluid">
		                  <div class="span12">
		                    <label>JUDGMENT </label>
		                     <textarea name="judgmentcontent" id="tempalte">
		                       <?php echo $getdetailsrows["judgmentcontent"]?>
		                     </textarea>
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