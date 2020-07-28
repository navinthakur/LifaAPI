<?php
include("../libs/config.php");
$Msg = '';

if(isset($_POST["signin"])) 	
{		
	session_start();// Starting Session
	  $secret = '6Lf64I8UAAAAAAew3hGu5TaPqT3pSWohn7yeY0Gv';
	  $response = $_POST['g-recaptcha-response'];
	  $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$response);
	  $responseData = json_decode($verifyResponse);
	  if($responseData->success)
	  {
	  	
	  	$error=''; //variable to store error message
	  								  
	  	// Define $username and $password 
	  	$login_username=$_POST['txtUserNameSSK']; 
	  	$login_password=$_POST['txtPasswordSSK']; 

	  	// To protect MySQL injection for Security purpose 
	  	$login_username = stripslashes($login_username);
	  	$login_password = stripslashes($login_password);
	  	$login_username = mysql_real_escape_string($login_username);
	  	$login_password = mysql_real_escape_string($login_password);
	  		
	  		
	  		
	  	//SQL query to fetch information of registerd users and finds user match.
	  	$query2 = "select * from logintbl where userpassword='".$login_password."' and mobilenumber='".$login_username."'";			
	  	
	  	$rows = mysql_num_rows(mysql_query($query2));
	  	$rowval = mysql_fetch_array(mysql_query($query2));
	  	if ($rows > 0) 
	  	{	
	  	  $_SESSION['login'] = $rowval["logid"];//Initializing Session
	      $TodayDate = date("d-m-Y");
	  	  if($rowval["usertype"] == "admin")
	  		{

	  		   echo '<script type="text/javascript">
	  		   window.location = "admin_v2/?current=dashboard";
	  		   </script>'; 
	  		}
	  	}
	  	else 
	     {
	  		   echo '<script>alert("Invalid Login Credentials")</script>';

	     }
	   }else{
	      $Msg = '<div class="row">Robot verification failed, please try again.</div>';
	   }

  
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    
<!-- Mirrored from serveseva.in/SODLogin.aspx by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 18 Jun 2018 05:51:01 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
        <meta charset="UTF-8" />
        <title>User Login :: ServeSeva</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="dist/css/SOD.min.css" rel="stylesheet" type="text/css" />
        <link href="plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
		<link rel="shortcut icon" href="favicon.png" type="image/x-icon" />  
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <script type="text/ecmascript">
            function trim(textBoxValue) {
                return textBoxValue.replace(/^\s+|\s+$/g, '');
            }

            function isNumberKey(evt) {
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;

                return true;
            }
        </script>

    </head>
  <body class="login-page">



  <form method="post" action="" id="formRegisterCustomer">



    <div class="register-box">
      <div class="register-logo">
        <img src="dist/img/ServeSevaLogo.png" alt="ServeSeva" style="width:40px; margin-right:15px" /><b>ServeSeva</b>
      </div>

      <div class="register-box-body">
        <p class="login-box-msg">User Login</p>
        <?php echo $Msg?>
		  
          <div class="form-group has-feedback">
           <input name="txtUserNameSSK" type="text" maxlength="10" id="txtUserNameSSK" tabindex="1" class="form-control" placeholder="Registered 10 Digit Mobile No" autocomplete="off" onkeypress="return isNumberKey(event)" />
            <span class="glyphicon glyphicon-phone form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
            <input name="txtPasswordSSK" type="password" maxlength="14" id="txtPasswordSSK" tabindex="2" class="form-control" placeholder="Password" autocomplete="off" />
            <span class="glyphicon glyphicon-asterisk form-control-feedback"></span>
          </div>
            <style type="text/css">
              .g-recaptcha {
                transform: scale(0.77);
                transform-origin: 0 0 0;
            }
            </style>
          <script src='https://www.google.com/recaptcha/api.js'></script>
          <div class="g-recaptcha" data-sitekey="6Lf64I8UAAAAAGWxAtzoh7chgMXWwVzGtulSbeYb"></div>
          <div class="row form-group has-feedback">
            <div class="col-xs-12">
                <input type="submit" name="signin" value="Login" id="signin" tabindex="4" class="btn btn-primary btn-block btn-flat" />
            </div>
          </div>


        <p>
        <a href="SODForgotPassword.php" class="text-center">I forgot my password</a><br />
        <a href="SODRegister.php" class="text-center">Register a new user</a><br>
        <a href="index.php" class="text-center">Back to Home</a>
        </p>
      </div><!-- /.form-box -->
    </div><!-- /.register-box -->


    <script src="plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

    </form>
  </body>

<!-- Mirrored from serveseva.in/SODLogin.aspx by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 18 Jun 2018 05:51:06 GMT -->
</html>
