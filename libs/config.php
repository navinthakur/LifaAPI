<?php

ob_start();
require_once("constants.php");
require_once("common_functions.php");
date_default_timezone_set("Asia/Kolkata"); 
$mysqli = new mysqli(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD,DB_DATABASE);

// check connection
  if ($mysqli->connect_errno){
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
  }
/*

if you make login section for admin 

use session here otherwise no need

session_start();

*/



require_once("constants.php");

require_once("common_functions.php");



/*

 * turn off magic-quotes support, for runtime e, as it will cause problems if enabled

 */

if (version_compare(PHP_VERSION, 5.3, '<') && function_exists('set_magic_quotes_runtime')) set_magic_quotes_runtime(0);



// set currentPage in the local scope

$currentPage = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);





//connect with the server

$conn = mysql_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD) or die("Sorry! could not connect <br><b>". mysql_error()."</b>");

if ($conn) {

	mysql_select_db(DB_DATABASE) or die("Sorry! could not connect with database <br><b>". mysql_error()."</b>");

}

?>

<?php



?>