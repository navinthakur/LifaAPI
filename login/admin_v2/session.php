<?php
require("../../libs/config.php");                         
session_start();// Starting Session

//Storing session
$user_check = $_SESSION['login'];

//SQL query to fetch complete information of user   
$ses_sql=mysql_query("select * from logintbl where logid='$user_check'");
$row = mysql_fetch_assoc($ses_sql);

$login_session = $row['mobilenumber'];

if(!isset($login_session)){
echo '<script type="text/javascript">
window.location = "../index.php"
</script>';
}
?>