<?php include("header.php");?>
<style type="text/css">
  tr.odd td.sorting_1{
    background-color: #ffffff;
  }
</style>

<?php
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
      $VideoHeading = $_POST["VideoHeading"];
      $VideoTitle = $_POST["VideoTitle"];
      $VideoLanguage = $_POST["VideoLanguage"];
      $includeintrending = $_POST["includeintrending"];
      $includeinlive = $_POST["includeinlive"];
      $VideoUploadType = $_POST["VideoUploadType"];

      if ($VideoUploadType == "Server") {
        
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
         }else{
          $VideoPath = '';
         }

         
      }
       $YoutubeVideoLink = $_POST["YoutubeVideoLink"];
      $VideoDescription = $_POST["VideoDescription"];
      $posteddate = date("Y-m-d H:i:s");

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
      }
    }

      $addvideo = mysql_query("INSERT INTO `tblpostvideos`(`VideoHeading`, `VideoTitle`, `VideoLanguage`, `VideoThumbnail`, `includeintrending`, `includeinlive`, `VideoUploadType`, `YoutubeVideoLink`, `YoutubeServerFile`, `VideoDescription`, `videoposteddate`) VALUES ('$VideoHeading','$VideoTitle','$VideoLanguage','$VideoThumbnailPath','$includeintrending','$includeinlive','$VideoUploadType','$YoutubeVideoLink','$VideoPath','$VideoDescription','$posteddate')");
      if ($addvideo) {
          echo '<script>window.location = "postvideos.php?current=videos&status=1&msg=Video Posted Successfully!!"</script>';

        }else{
          echo '<script>window.location = "postvideos.php?current=videos&status=0&msg=Sorry Something went Wrong!!"</script>';
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

              <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="btn btn-primary btn-md" id="" name="" style="margin-top: -5px;">Post New Video</a>
              <br>
              <div id="collapseOne" class="panel-collapse collapseOne collapse">
                <br>
                  <div class="row-fluid">
                      <div class="span12">
                        <div class="span3">
                          <div class="control-group">
                            <label>Video Heading</label>
                            <input type="text" style="width: 100%" name="VideoHeading" id="VideoHeading" class="VideoHeading" placeholder="Video Heading here.." required=""  tabindex="1">
                          </div>
                        </div>

                        <div class="span3">
                          <div class="control-group">
                            <label>Video Title</label>
                            <input type="text" style="width: 100%" name="VideoTitle" id="VideoTitle" class="VideoTitle" placeholder="Video Title here.."  required=""  tabindex="2">
                          </div>
                        </div>
                        <div class="span3">
                          <div class="control-group">
                            <label>Video Language</label>
                            <select style="width: 100%" name="VideoLanguage" id="VideoLanguage" class="VideoLanguage"  required=""  tabindex="3">
                              <option>Select Option</option>
                              <option>English</option>
                              <option>Hindi</option>
                              <option>Marathi</option>
                            </select>
                          </div>
                        </div>

                        <div class="span3">
                          <div class="control-group">
                            <label>Video Thumbnail/Cover Photo</label>
                            <input type="file" name="VideoThumbnail[]" id="VideoThumbnail"  required=""  tabindex="4">
                          </div>
                        </div>
                       
                      </div>
                    </div>
                    <div class="row-fluid">
                      <div class="span12">

                        <div class="span3">
                          <div class="control-group">
                            <label>Include this video in <b>Trending</b> Section?</label>
                            <select style="width: 100%" name="includeintrending" id="includeintrending" class="includeintrending"  required=""  tabindex="5">
                              <option>Select Option</option>
                              <option>Yes</option>
                              <option>No</option>
                            </select>
                          </div>
                        </div>


                        <div class="span3">
                          <div class="control-group">
                            <label>Want to Include this video in <b>LIVE</b> Section?</label>
                            <select style="width: 100%" name="includeinlive" id="includeinlive" class="includeinlive"  required=""  tabindex="6">
                              <option>Select Option</option>
                              <option>Yes</option>
                              <option>No</option>
                            </select>
                          </div>
                        </div>
                         <div class="span3">
                          <div class="control-group">
                            <label>Video Upload Type</label>
                            <select style="width: 100%" id="VideoUploadType" name="VideoUploadType" class="VideoUploadType"  required=""  tabindex="7">
                              <option value="">Select Option</option>
                              <option value="Youtube" selected="">Youtube</option>
                              <option value="Server">Server</option>
                            </select>
                          </div>
                        </div>
                        <div class="span3 videoextradivyoutube ">
                          <div class="control-group">
                            <label>Youtube Video Link</label>
                            <input type="text" style="width: 100%" name="YoutubeVideoLink" id="YoutubeVideoLink" class="YoutubeVideoLink" placeholder="Youtube Link Here.."    tabindex="8">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row-fluid videoextradiv hidden">
                      <div class="span12">

                        <div class="span3">
                          <div class="control-group">
                            <label>Upload Video</label>
                            <input type="file" style="width: 100%" name="file" id="file" class="file"   tabindex="8">
                          </div>
                        </div>

                      </div>
                    </div>
                    <div class="row-fluid">
                      <div class="span12">
                        <div class="control-group">
                          <label>Video Description</label>
                          <textarea name="VideoDescription" id="VideoDescription" class="VideoDescription" style="width: 100%" placeholder="Write about Video" rows="10"  required=""  tabindex="9">
                            
                          </textarea>
                        </div>
                      </div>
                    </div>
                    
                    <div class="row-fluid">
                      <div class="span6"></div>
                      <button type="Submit" name="BtnSubmitDetails" id="BtnSubmitDetails" class="btn btn-info">Submit Details</button>
                    </div>
                  </div>
                  <table class="table table-bordered text-center data-tbl-inbox">
                    <thead>
                      <tr>
                        <th class="center">Video Heading</th>
                        <th class="center">Video Title</th>
                        <th class="center">Language</th>
                        <th class="center">Posted Date</th>
                        <th class="center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $getvideo = mysql_query("SELECT * FROM `tblpostvideos` order by videoid desc");
                        while($getvideorows = mysql_fetch_array($getvideo)){

                      ?>
                      <tr>
                        <td class="center"><?php echo $getvideorows["VideoHeading"]?></td>
                        <td class="center"><?php echo $getvideorows["VideoTitle"]?></td>
                        <td class="center"><?php echo $getvideorows["VideoLanguage"]?></td>
                        <td class="center"><?php echo $getvideorows["videoposteddate"]?></td>
                        <td class="center">
                          <div class="btn-group">
                              <button data-toggle="dropdown" class="btn dropdown-toggle"><i class="icon-cog"></i><span class="caret"></span></button>
                              <ul class="dropdown-menu">
                                <li><a href="postvideosview.php?view=<?php echO $getvideorows["videoid"]?>" target="_blank"><i class="icon-edit"></i> View/Edit Post</a></li>
                                <li><a href="postvideos.php?del=<?php echo $getvideorows["videoid"]?>"><i class="icon-trash"></i> Remove Post</a></li>
                                
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