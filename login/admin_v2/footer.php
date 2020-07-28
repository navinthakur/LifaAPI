<!-- javascript
================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
<script src="js/jquery.js"></script> 
<script src="js/jquery-ui-1.8.16.custom.min.js"></script> 
<script src="js/jquery.ui.touch-punch.js"></script> 
<script src="js/bootstrap.js"></script> 
<script src="js/prettify.js"></script> 
<script src="js/jquery.sparkline.min.js"></script> 
<script src="js/jquery.nicescroll.min.js"></script> 
<script src="js/accordion.jquery.js"></script> 
<script src="js/smart-wizard.jquery.js"></script> 
<script src="js/vaidation.jquery.js"></script> 
<script src="js/jquery-dynamic-form.js"></script> 
<script src="js/fullcalendar.js"></script> 
<script src="js/raty.jquery.js"></script> 
<script src="js/jquery.noty.js"></script> 
<script src="js/jquery.cleditor.min.js"></script> 
<script src="js/data-table.jquery.js"></script> 
<script src="js/TableTools.min.js"></script> 
<script src="js/ColVis.min.js"></script> 
<script src="js/plupload.full.js"></script> 
<script src="js/elfinder/elfinder.min.js"></script> 
<script src="js/chosen.jquery.js"></script> 
<script src="js/uniform.jquery.js"></script> 
<script src="js/jquery.tagsinput.js"></script> 
<script src="js/jquery.colorbox-min.js"></script> 
<script src="js/check-all.jquery.js"></script> 
<script src="js/inputmask.jquery.js"></script> 
<script src="js/plupupload/jquery.plupload.queue/jquery.plupload.queue.js"></script> 
<script src="js/excanvas.min.js"></script> 
<script src="js/jquery.jqplot.min.js"></script> 
<script src="js/chart/jqplot.highlighter.min.js"></script> 
<script src="js/chart/jqplot.cursor.min.js"></script> 
<script src="js/chart/jqplot.dateAxisRenderer.min.js"></script> 
<script src="js/custom-script.js"></script> 
<!-- html5.js for IE less than 9 --> 
<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]--> 
<script>
$(function(){



	$("#UpdateCompanyLogo").change(function(){
		var UpdateCompanyLogo = $(this).val();
		if (UpdateCompanyLogo == "") {
			$("#iscompanylogoselected").val("0");
		}else{
			$("#iscompanylogoselected").val("1");
		}
	});

	$("#CompanyLogo").change(function(){
		var CompanyLogo = $(this).val();
		if (CompanyLogo == "") {
			$("#iscompanylogoselected").val("0");
		}else{
			$("#iscompanylogoselected").val("1");
		}
	});

	$("#VideoThumbnail").change(function(){
		var VideoThumbnail = $(this).val();
		if (VideoThumbnail == "") {
			$("#VideoThumbnailSelected").val("0");
		}else{
			$("#VideoThumbnailSelected").val("1");
		}
	});


	$("#ServerVideofile").change(function(){
		var ServerVideofile = $(this).val();
		if (ServerVideofile == "") {
			$("#isservervideoselected").val("0");
		}else{
			$("#isservervideoselected").val("1");
		}
	});

	$('textarea').each(function(){
            $(this).val($(this).val().trim());
        }
    );

	$(".crpcsubtypeappuniqueid").change(function(){
		var crpcsubtypeappuniqueid = $(this).val();
		if (crpcsubtypeappuniqueid) {
				$.ajax({
	                type:'POST',
	                url:'update.php',
	                data:'crpcsubtypeappuniqueid='+crpcsubtypeappuniqueid,
	                beforeSend: function(){
						$("div#divLoading").addClass('show');
					},
	                success:function(html){
	                    $('#subtypesectionno').html(html);
	                    $("div#divLoading").removeClass('show');
	                },error: function(){

					  	alert("Sorry Something Went Wrong!!");
					  	$("div#divLoading").removeClass('show');
					}
	            });
			}else{
				$('#subtypesectionno').html('<option value="">Select Chapter First</option>');
			}
	});

	$(".subtypeappuniqueid").change(function(){
		var subtypeappuniqueid = $(this).val();
		if (subtypeappuniqueid) {
				$.ajax({
	                type:'POST',
	                url:'update.php',
	                data:'subtypeappuniqueid='+subtypeappuniqueid,
	                beforeSend: function(){
						$("div#divLoading").addClass('show');
					},
	                success:function(html){
	                    $('#subtypesectionno').html(html);
	                    $("div#divLoading").removeClass('show');
	                },error: function(){

					  	alert("Sorry Something Went Wrong!!");
					  	$("div#divLoading").removeClass('show');
					}
	            });
			}else{
				$('#subtypesectionno').html('<option value="">Select Chapter First</option>');
			}
	});

		$(".refsubjectid").change(function(){
			var refsubjectid = $(this).val();
			if (refsubjectid) {
				$.ajax({
	                type:'POST',
	                url:'update.php',
	                data:'refsubjectid='+refsubjectid,
	                beforeSend: function(){
						$("div#divLoading").addClass('show');
					},
	                success:function(html){
	                    $('#refpatternid').html(html);
	                    $("div#divLoading").removeClass('show');
	                },error: function(){

					  	alert("Sorry Something Went Wrong!!");
					  	$("div#divLoading").removeClass('show');
					}
	            });
			}else{
				$('#refpatternid').html('<option value="">Select Course First</option>');
			}
		});

		
		    	

		$(".refcourseid").change(function(){
			var refcourseid = $(this).val();			
			if (refcourseid) {
				$.ajax({
	                type:'POST',
	                url:'update.php',
	                data:'refcourseid='+refcourseid,
	                beforeSend: function(){
						$("div#divLoading").addClass('show');
					},
	                success:function(html){
	                	console.log(html);
	                    $('#refsemesterid').html(html);
	                    $("div#divLoading").removeClass('show');
	                },error: function(){

					  	alert("Sorry Something Went Wrong!!");
					  	$("div#divLoading").removeClass('show');
					}
	            });
			}else{
				$('#refsemesterid').html('<option value="">Select Course First</option>');
			}
		});


		$(".refsemesterid").change(function(){
			var refsemesterid = $(this).val();
			var refcourseid = $("#refcourseid").val();

			if (refsemesterid != "" && refcourseid != "") {
				$.ajax({
	                type:'POST',
	                url:'update.php',
	                data:{refsemesterid:refsemesterid,getrefcourseid:refcourseid},
	                beforeSend: function(){
						$("div#divLoading").addClass('show');
					},
	                success:function(html){
	                    $('#refsubjectid').html(html);
	                    $('#syllabusrefsubjectid').html(html);
	                    $("div#divLoading").removeClass('show');
	                },error: function(){

					  	alert("Sorry Something Went Wrong!!");
					  	$("div#divLoading").removeClass('show');
					}
	            }); 
			}else if(refsemesterid == ""){
				 $('#refsubjectid').html('<option value="">Select Semester First</option>');
				 $('#syllabusrefsubjectid').html('<option value="">Select Semester First</option>');
			}else if (refcourseid == "") {
				alert("Select Course first");
			}
		});

		$(".VideoUploadType").change(function(){
			var VideoUploadType = $(this).val();

			if (VideoUploadType == "Youtube") {
				$(".videoextradivyoutube").removeClass("hidden");
				$(".videoextradiv").addClass("hidden");
			}else if(VideoUploadType == "Server"){
				$(".videoextradivyoutube").addClass("hidden");
				$(".videoextradiv").removeClass("hidden");
				
			}else{
				$(".videoextradivyoutube").addClass("hidden");
				$(".videoextradiv").addClass("hidden");
			}
		})
		var actcount = 1;
		var actcounti = 2;
		$(document).on("click",".addmoreact",function(e){
			$("#actdiv").append('<div class="row-fluid"><div class="span3"><div class="control-group"><label>Act Name</label><input type="hidden" name="actitem_no[]" id="actitem_no_'+actcount+'" value="'+actcounti+'"><input type="text" style="width: 100%" name="actname[]" id="actname_'+actcount+'" class="form-control actname" placeholder="For Ex: Indian partnership act, 1932"></div></div><div class="span3" style="margin-top: 20px"><div class="control-group"><button type="button" id="addmoreact" class="btn btn-info addmoreact">Add More</button></div></div></div>');
		});

		
		var syllabuscount = 1;
		var syllabuscounti = 2;
		$(document).on("click",".btnaddmoresyllabus",function(e){
			$("#clatsyllabusdiv").append('<div class="row-fluid"><div class="span12"><div class="span3"><div class="control-group"><label>Short Name</label><input type="hidden" class="form-control item_no" id="item_no_'+syllabuscount+'" name="item_no[]" style="width:50px" value="'+syllabuscounti+'"><input type="text" class="form-control" name="Shortname[]" id="Shortname'+syllabuscount+'" placeholder="Eg: EIC"></div></div><div class="span7"><div class="control-group"><label>Heading Name</label><input style="width: 100%" type="text" class="form-control" name="FullName[]" id="FullName_'+syllabuscount+'" placeholder="Eg: English Including Comprehension"></div></div><div class="span2" style="margin-top: 20px"><div class="control-group"><label></label><button type="button" name="btnaddmoresyllabus" id="btnaddmoresyllabus" class="btn btn-info btnaddmoresyllabus">Add More</button></div></div></div></div>');
			syllabuscount++;
			syllabuscounti++;

		});

		var syllabuscount = 1;
		var syllabuscounti = 2;		
		$(document).on("click",".BtnAddMoreIndexSyllabus",function(e){
			$("#SyllabusDiv").append('<div class="row-fluid"><div class="span12"><div class="span2"><div class="control-group"><label>Chapter</label><input type="text" style="width: 100%" name="actchapter[]" id="actchapter_'+syllabuscount+'" class="form-control actchapter" placeholder="for eg: Chapter - I"></div></div><div class="span2"><div class="control-group"><label>From </label><input type="text" style="width: 100%" name="chapterstartfrom[]" id="chapterstartfrom_'+syllabuscount+'" class="form-control chapterstartfrom" placeholder="Enter Serial Number"></div></div><div class="span2"><div class="control-group"><label>To </label><input type="text" style="width: 100%" name="chapterendfrom[]" id="chapterendfrom_'+syllabuscount+'" class="form-control chapterendfrom" placeholder="Enter Serial Number"></div></div><div class="span4"><div class="control-group"><label>Index Title </label><input type="hidden" class="form-control ino" id="ino_0" name="item_no[]" style="width:50px" value="'+syllabuscounti+'"><input type="text" style="width: 100%" name="PrimaryTitle[]" required="" id="PrimaryTitle_'+syllabuscount+'" class="PrimaryTitle form-control" placeholder="Title here.."/></div></div><div class="span2" style="margin-top: 18px"><div class="control-group"><label> </label><button type="button"style="width: 100%" class="BtnAddMoreIndexSyllabus btn btn-danger btn-md" id="BtnAddMoreIndexSyllabus" name="BtnAddMoreIndexSyllabus">Add More Index</button></div></div></div></div>');
			syllabuscount++;
			syllabuscounti++;

		});

		var legalcount = 1;
		var legalcounti = 2;		
		$(document).on("click",".BtnAddLegalwords",function(e){
			$("#legalworddiv").append('<div class="row-fluid"><div class="span12"><div class="span3"><div class="control-group"><label>Title</label><input type="hidden" class="form-control ino" id="ino_'+legalcount+'" name="item_no[]" style="width:50px" value="'+legalcounti+'"><input type="text" style="width: 100%" name="ChapterTitle[]" required="" id="ChapterTitle_'+legalcount+'" class="ChapterTitle form-control" placeholder="Enter Title here.." /></div></div><div class="span7"><div class="control-group"><label>Paragraph</label><input type="text" style="width: 100%" class="form-control" name="ChapterExplanation[]" id="ChapterExplanation_'+legalcount+'" placeholder="Place some text here"/></div></div><div class="span2" style="margin-top: 20px"><div class="control-group"><button type="button" class="BtnAddLegalwords btn btn-danger btn-md" id="BtnAddLegalwords" name="BtnAddLegalwords">Add More</button></div></div></div></div>');
			legalcount++;
			legalcounti++;

		});


		$(document).on("click",".BtnAddLegalMaxims",function(e){
			$("#legalmaximsdiv").append('<div class="row-fluid"><div class="span12"><div class="span3"><div class="control-group"><label>Title</label><input type="hidden" class="form-control ino" id="LMino_'+legalcount+'" name="LMitem_no[]" style="width:50px" value="'+legalcounti+'"><input type="text" style="width: 100%" name="LMChapterTitle[]" required="" id="LMChapterTitle_'+legalcount+'" class="ChapterTitle form-control" placeholder="Enter Title here.." /></div></div><div class="span7"><div class="control-group"><label>Paragraph</label><input type="text" style="width: 100%" class="form-control" name="LMChapterExplanation[]" id="LMChapterExplanation_'+legalcount+'" placeholder="Place some text here"/></div></div><div class="span2" style="margin-top: 20px"><div class="control-group"><button type="button" class="BtnAddLegalwords btn btn-danger btn-md" id="BtnAddLegalwords" name="BtnAddLegalwords">Add More</button></div></div></div></div>');
			legalcount++;
			legalcounti++;

		});

		var nipccount = 1;
		var nipc = 2;		
		$(document).on("click",".btnaddmorechapter",function(e){
			$("#extrachapter").append('<div class="row-fluid"><div class="span12"><div class="span3"><div class="control-group"><label>Chapter</label><input type="hidden" class="form-control chapteritem_no" id="chapteritem_no_'+nipccount+'" name="chapteritem_no[]" style="width:50px" value="'+nipc+'"><input type="text" style="width: 100%" name="actchapter[]" id="actchapter_'+nipccount+'" class="form-control actchapter" placeholder="for eg: Chapter - I"></div></div><div class="span3"><div class="control-group"><label>Chapter Introduction</label><input type="text" style="width: 100%" name="chapterintro[]" id="chapterintro_'+nipccount+'" class="form-control chapterintro" placeholder="Enter Chapter Introduction"></div></div><div class="span2"><div class="control-group"><label>From</label><input type="text" style="width: 100%" name="chapterstartfrom[]" id="chapterstartfrom_'+nipccount+'" class="form-control chapterstartfrom" placeholder="Enter Serial Number"></div></div><div class="span2"><div class="control-group"><label>To</label><input type="text" style="width: 100%" name="chapterendfrom[]" id="chapterendfrom_'+nipccount+'" class="form-control chapterendfrom" placeholder="Enter Serial Number"></div></div><div class="span2" style="margin-top: 20px"><div class="control-group"><button type="button" class="btn btn-info btnaddmorechapter" id="btnaddmorechapter" name="btnaddmorechapter">Add More</button></div></div></div></div>');
			nipccount++;
			nipc++;
		});

		var ipccount = 1 	;
		var ipc = 2;	
		$(document).on("click",".BtnAddMoreIPC",function(e){
			$("#ipcdiv").append('<div class="col-md-12"><div class="col-md-1"><div class="form-group"><label for="ddlPartners" style="margin-left: -15px" class="col-md-12 control-label">No</label><input name="Sectionno[]" required="" id="Sectionno_'+count+'" class="Sectionno form-control" placeholder="Enter Section no.." /></div></div><div class="col-md-3"><div class="form-group"><label for="ddlPartners" style="margin-left: -15px" class="col-md-12 control-label">Chapter Title</label><input type="hidden" class="form-control ino" id="ino_'+count+'" name="item_no[]" style="width:50px" value="'+ipc+'"><input name="ChapterTitle[]" required="" id="ChapterTitle_'+count+'" class="ChapterTitle form-control" placeholder="Enter Title here.."  /></div></div><div class="col-md-7"><div class="form-group"><label for="ddlPartners" style="margin-left: -15px" class="col-md-12 control-label">Chapter Explanation</label><input name="ChapterExplanation[]" id="ChapterExplanation_'+count+'" required="" class="ChapterExplanation form-control" placeholder="Enter Explanation.."  /></div></div><div class="col-md-1"><div class="form-group"><div style="margin-top: 24px"></div><button type="button" class="BtnAddMoreIPC btn btn-danger btn-md" id="BtnAddMoreIPC" name="BtnAddMoreIPC">Add More</button></div></div></div>');
			ipccount++;
			ipc++;
		});

		var count = 1 	;
		var i = 2;
		$(document).on("click",".BtnAddMoreOwner",function(e){

			$("#Ownerdiv").append('<div class="row-fluid"><div class="span12"><div class="span3"><div class="control-group"><label>Question</label><input type="hidden" class="form-control ino" id="ino_'+count+'" name="item_no[]" style="width:50px" value="'+i+'"><input type="text" style="width: 100%" name="PrimaryQuestion[]" required="" id="PrimaryQuestion_'+count+'" class="PrimaryQuestion" placeholder="Enter Question here.."/></div> </div><div class="span7"><div class="control-group"><label>Answer</label><input type="text" style="width: 100%" name="PrimaryAnswer[]" id="PrimaryAnswer_'+count+'" required="" class="PrimaryAnswer span7" placeholder="Enter Answer here.."/></div></div><div class="span2" style="margin-top: 19px"><div class="control-group"><button type="button" class="BtnAddMoreOwner btn btn-danger btn-md" id="BtnAddMoreOwner" name="BtnAddMoreOwner">Add More Question</button></div></div></div></div>');

			count++;
			i++;
		});


		var Tagcount = 1;
		var Tagcounti = 2;
		$(document).on("click",".btnAddMoreTag",function(e){

			$("#tagdiv").append('<div class="row-fluid"><div class="span12"><div class="span4"><div class="control-group"><label>Exam Tags</label><input type="hidden" class="form-control ino" id="ino_'+Tagcount+'" name="item_no[]" value="'+Tagcounti+'"><input type="text" name="txtTags[]" id="txtTags_'+Tagcount+'" placeholder="Eg: Maths Aptitude"  style="width: 100%" /></div></div><div class="span4"><div class="control-group"><button class="btn btn-success btnAddMoreTag" id="btnAddMoreTag" style="margin-top: 20px">Add More Tags</button></div></div></div></div>');

			Tagcount++;
			Tagcounti++;
		});


	});
</script>
<script src="js/respond.min.js"></script>
<script src="js/ios-orientationchange-fix.js"></script>
</body>

<!-- Mirrored from www.lab.westilian.com/srabon-admin/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 18 Apr 2020 14:42:28 GMT -->
</html>