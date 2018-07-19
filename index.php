<?php

 session_start();
 ob_start();
 date_default_timezone_set('Asia/Kolkata');
 if(isset($_GET['p'])){
 // print_r($_SESSION);exit
 	//echo "hi";exit;?>
 		<script>
 			location.href="forgot_pswd2.php";
 		</script>
 	<?php
	exit;
 }
 $phpfiles=glob("include/php/*.php");
 foreach($phpfiles as $phpfile){
 	include_once($phpfile);
 }
 //echo md5(1234);
//error_reporting(false);
if(isset($_SESSION['udetail']['id'])){
	$usersessionid=$_SESSION['udetail']['id'];
  $userroll=$_SESSION['udetail']['roll'];
  $userpass=$_SESSION['udetail']['pswd'];
}
 ?>

<?php
// echo md5("1234");exit;
error_reporting(0);
//include_once("connection.php");
include_once('header.php');
$mod="login";
$do="login_redirect";
if(isset($_SESSION['udetail']) ){
  if(isset($_GET['mod']))
  {
    $mod=$_GET['mod'];
    $do=$_GET['do'];
  }
}
else {
  //echo "hi";exit;
}
include("module/$mod/$do.php");
include_once('footer.php');
?>
