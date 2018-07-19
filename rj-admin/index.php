<?php

 session_start();
//error_reporting(false);
ob_start();
ini_set('max_execution_time', 300);
if(isset($_SESSION['alogindtl']['id']))
	$adminsessionid=$_SESSION['alogindtl']['id'];


 ?>

<?php
//include_once("connection.php");
$phpfiles=glob("include/php/*.php");
foreach($phpfiles as $phpfile){
	include_once($phpfile);
}
$mod="login";
$do="login_redirect";
//print_r($_GET['do']);

if(isset($_SESSION['alogindtl'])){
include_once('header.php');
  if(isset($_GET['mod']))
  {
    $mod=$_GET['mod'];
    $do=$_GET['do'];
  }
}
//echo $mod.$do;exit;
include("module/$mod/$do.php");
include_once('footer.php');

?>
