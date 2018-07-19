<?php

session_start();
ob_start();
?>
<?php
//echo md5(1234);
$phpfiles=glob("include/php/*.php");
foreach($phpfiles as $phpfile){
	include_once($phpfile);
}
if (isset($_POST['roll'])) {
	if (isset($_POST['remember'])) {
setcookie('Uusername', $_POST['roll'],time()+60*60*24*365);
setcookie('Upassword', $_POST['pswd'],time()+60*60*24*365);
	}
//print_r($_COOKIE);exit;
//echo $_POST['pswd'];exit;
  $pswd=md5($_POST['pswd']);
  $qry="select id,roll,pswd,s_name from student_biodata where roll='$_POST[roll]' and pswd='$pswd'";
  $row=fetchRow($qry);
  if($row){
    $_SESSION['udetail']=fetchOne($qry);
    //print_r($_SESSION['udetail']);exit;
    ?>
      <script>
        location.href="index.php?mod=spr&do=spr";
      </script>
    <?php
  }
  else {
		$_SESSION['wup']="Enter correct username and password";
  }
} ?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SPR | Synthesis</title>
<!-- fonts starts -->
<link href="//fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900" rel="stylesheet">
<!-- /fonts ends -->

<!-- css starts -->
<link rel="stylesheet" href=<?php echo ROOT."css/bootstrap.min.css";?> />
<link rel="stylesheet" href=<?php echo ROOT."css/bootstrap-glyphicons.css";?> />
<link rel="stylesheet" href=<?php echo ROOT."css/bootstrap-theme.min.css";?> />
<link rel="stylesheet" href=<?php echo ROOT."css/style2_loginPage.css";?> />
<!-- css ends -->

<!-- js starts -->
<script src=<?php echo ROOT."js/jquery.min.js";?>></script>
<script src=<?php echo ROOT."js/bootstrap.min.js";?>></script>
<script src=<?php echo ROOT."js/jquery.js";?>></script>
<!-- js ends -->
</head>
<body>
<?php /*?><video autoplay loop id="video-background" poster="" muted>
  <source src=<?php echo ROOT."videos/city.mp4";?> type="video/mp4">
</video><?php */?>

<div class="container">
  <div class="row">
  		<h1 class="">Student Report, 2017</h1>
    	<div class="col-lg-4">&nbsp;</div>
        <div class="col-lg-4" style="background:#fff;">
        	<div style="height:40px;">&nbsp;</div>
        	<div align="center" style="color:#930;">
						<?php
							if(isset($_SESSION['wup'])){
								echo $_SESSION['wup'];
								unset($_SESSION['wup']);
							}if(isset($_SESSION['slogin'])){
								echo $_SESSION['slogin'];
								unset($_SESSION['slogin']);
							}
						 ?>
        	<a href="" class="logo-hover"><img src=<?php echo ROOT."images/logo_building.jpg";?> class="img-rounded img-radius" height="140" width="140" /></a>
         </div>
        <form role="form" class="form-vertical form-text" name="searchfrm"  method="post">
					<div class="form-group">
						<label for="name">Roll No.</label>
						<input type="text" class="form-control form-input-type-username"
							id="roll" name="roll" required onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" placeholder="Enter Roll No." maxlength="5" value="<?php if (isset($_COOKIE['Uusername'])) {echo $_COOKIE['Uusername'];} ?>" />
					</div>
					<div class="form-group">
						<label for="mob">Password</label>
						<input type="password" class="form-control form-input-type-username form-input-type-password" id="f_mobile" name="pswd" required
						value="<?php if (isset($_COOKIE['Upassword'])) {echo $_COOKIE['Upassword'];} ?>" placeholder="Enter Password"  />
					</div>

        <div class="form-group" align="center">
        	<input type="checkbox" name="remember" id="remember" value="" class="checks">
				<label for="remember">Keep Me Logged In?</label> <br />
				<label for="remember"><a href="forgot_pswd2.php" style="color:#333; text-decoration:none;">Forgot Password?</a></label>
			</div><!--
				<div class="form-group" align="center">
				<label for="remember"><a href="forget_pswd.php">Forget Password</a></label>
			</div>-->

        <div class="form-group" align="center">
        <input type="submit" value="LOG IN" class="">
        </div>
      </form>
      <div align="center">
      <a href="https://www.facebook.com/synthesis.ac.in" target="_blank" class="facebook"><img src=<?php echo ROOT."images/fb_icon.png";?> height="30" width="30"> <span style="padding-left:25px;">Facebook</span></a>
		<a href="https://www.youtube.com/channel/UCd8NHH9JrSAQc36hbfpoT-w/feed" class="facebook youtube" target="_blank"><img src=<?php echo ROOT."images/yt_icon.png";?> height="30" width="30"> <span style="padding-left:25px;">You tube</span></a>
       </div>
        </div>
        <div class="col-lg-4">&nbsp;</div>
  </div>
  <br/>
	<div class="footer footer-text">
		<p>© 2017 Student Progress Report. All Rights Reserved | Design by Vivek Modi</p>
	</div>
</div>
</body>
</html>
