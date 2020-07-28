
        <!-- javascript -->
        <script src="js/jquery-3.4.1.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/jquery.easing.min.js"></script>
        <script src="js/scrollspy.min.js"></script>
        <!-- Comingsoon -->
        <script src="js/jquery.countdown.min.js"></script>
        <script src="js/countdown.init.js"></script>
        <!-- Icons -->
        <script src="js/feather.min.js"></script>
        <script src="js/unicons-monochrome.js"></script>
        <!-- Switcher -->
        <script src="js/switcher.js"></script>
        <!-- Main Js -->
        <script src="js/app.js"></script>

        <script>
            $(document).ready(function(){
                $("#btnSubmitContactForm").click(function(){
                    var contactpersonname = $("#contactpersonname").val();
                    var contactmobileno = $("#contactmobileno").val();
                    var contactemail = $("#contactemail").val();
                    var contactcomments = $("#contactcomments").val();
                    $.ajax({
                        type:'POST',
                        url:'ajaxrequest.php',
                        data:{contactpersonname:contactpersonname,contactmobileno:contactmobileno,contactemail:contactemail,contactcomments:contactcomments},
                            beforeSend: function(){
                                $("div#divLoading").addClass('show');
                            },
                            success:function(html){
                                $("div#divLoading").removeClass('show');
                                var finaldata = $.trim(html);
                                if (finaldata == "1" || finaldata == 1) {
                                    $("#contactpersonname").val('');
                                    $("#contactmobileno").val('');
                                    $("#contactemail").val('');
                                    $("#contactcomments").val('');
                                    $(".alertmsgdiv").addClass("alert alert-success fade show");
                                    $(".alertmsgdiv").empty();
                                    $(".alertmsgdiv").append("<strong>Well Done!</strong> Than You for Submitting your Details!! Our Team Will Contact You Soon!!");    

                                }else{


                                }
                                
                            },error: function(){
                                $(".alertmsgdiv").addClass("alert alert-danger fade show");
                                $(".alertmsgdiv").empty();
                                $(".alertmsgdiv").append("<strong>Error!</strong> Oops Looks Like internal Server Error! Please Contact Administrator");
                            }
                        }); 
                        return false;

                    
                });

                function IsEmail(email) {
                  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                  if(!regex.test(email)) {
                    return false;
                  }else{
                    return true;
                  }
                }
            })
        </script>
    </body>

<!-- Mirrored from www.shreethemes.in/landrick/layouts/page-comingsoon.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 10 May 2020 08:26:04 GMT -->
</html>