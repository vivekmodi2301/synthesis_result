<?php
session_start();
//echo md5('8947800330');
$phpfiles=glob("include/php/*.php");
foreach($phpfiles as $phpfile){
	include_once($phpfile);
}

if(!isset($_SESSION['alogindtl'])){
if(isset($_POST['uname'])){
	if (isset($_POST['remember'])) {
setcookie('Username', $_POST['uname'],time()+60*60*24*365);
setcookie('Password', $_POST['pswd'],time()+60*60*24*365);
	}
	//print_r($_COOKIE);exit;
	$uname=addslashes($_POST['uname']);
	$pswd=addslashes($_POST['pswd']);
	$pswd=md5($pswd);
	$qry="select id from login_admin where uname='$uname' and pswd='$pswd'";
	$frow=fetchRow($qry);
	if($frow){
		$_SESSION['alogindtl']=fetchOne($qry);
		header("location:index.php?mod=profile&do=see_all_profile");
	}else{
		$_SESSION['elogin']="Enter correct username and password";
	}

}
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Syn Admin Panel</title>
<!-- fonts starts -->
<link href="//fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900" rel="stylesheet">
<!-- /fonts ends -->

<!-- css starts --><link rel="stylesheet" href="<?php echo ROOT."css/bootstrap.min.css";?>"/>
<link rel="stylesheet" href="<?php echo ROOT."css/bootstrap-glyphicons.css";?>"/>
<link rel="stylesheet" href="<?php echo ROOT."css/bootstrap-theme.min.css";?>"/>
<link rel="stylesheet" href="<?php echo ROOT."css/style2_loginPage.css";?>"/>
<!-- css ends -->

<!-- js starts -->
<script src="<?php echo ROOT."js/jquery.min.js";?>"></script>
<script src="<?php echo ROOT."js/bootstrap.min.js";?>"></script>
<script src="<?php echo ROOT."js/jquery.js";?>"></script>
<!-- js ends -->

</head>
<body>

<div class="container">
  <div class="row">
  		<h1 class="" style="color:#000; font-family:'Comic Sans MS', cursive;">Synthesis Admin Panel</h1>
    	<div class="col-lg-4">&nbsp;</div>
        <div class="col-lg-4" style="background:#fff;">
        	<div style="height:40px;">&nbsp;</div>
        	<div align="center" style="color:#930;">

							<?php
								if(isset($_SESSION['elogin'])){
									echo $_SESSION['elogin'];
									unset($_SESSION['elogin']);
								}
							?>
        	<a href="" class="logo-hover"><img src="<?php echo ROOT."images/logo_building.jpg";?>" class="img-rounded img-radius" height="140" width="140" /></a>
         </div>
        <form role="form" class="form-vertical form-text" name="searchfrm"  method="post">
        <div class="form-group">
          <label for="name">Username</label>
          <input type="text" class="form-control form-input-type-username"
					  id="roll" name="uname" required placeholder="Enter Username"
						value="<?php if (isset($_COOKIE['Username'])) {echo $_COOKIE['Username'];} ?>" />
        </div>
        <div class="form-group">
          <label for="mob">Password</label>
          <input type="password" class="form-control form-input-type-username form-input-type-password" id="f_mobile" name="pswd" required
					value="<?php if (isset($_COOKIE['Password'])) {echo $_COOKIE['Password'];} ?>" placeholder="Enter Password"  />
        </div>
        <div class="form-group" align="center">
        	<input type="checkbox" name="remember" id="remember" value="yes" class="checks">
				<label for="remember">Keep Me Logged In?</label>
        </div>
        <div class="form-group" align="center">
        <input type="submit" value="LOG IN" class="">
        </div>
      </form>
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
<?php }else {
	header("location:".URL);
}
