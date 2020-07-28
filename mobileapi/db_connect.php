<?php
/* define('HOST','10.2.1.30');
 define('USER','agent');
 define('PASS','agent@131');
 define('DB','law');*/

  define('HOST','localhost');
 define('USER','root');
 define('PASS','');
 define('DB','law');
 
 $con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect');
 ?>