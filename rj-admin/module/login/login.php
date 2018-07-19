<?php
$phpfiles=glob("include/php/*.php");
foreach($phpfiles as $phpfile){
	include_once($phpfile); 	
}

?>
<!--A Design by Raj Verma 
Author: Raj Verma
Author URL: http://facebook.com/rajverma827
License: Version 1.0.1
License URL: 
-->
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Syn Admin Panel</title>
<!-- fonts starts -->
<link href="//fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900" rel="stylesheet">
<!-- /fonts ends -->

<!-- css starts -->
<link rel="stylesheet" href="<?php echo ROOT."css/bootstrap.min.css";?>"/>
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
        	<div align="center">
        	<a href="" class="logo-hover"><img src="images/logo_building.jpg" class="img-rounded img-radius" height="140" width="140" /></a>
         </div>   
        <form role="form" class="form-vertical form-text" name="searchfrm" action="index.php?mod=profile&do=see_all_profile" method="post">
        <div class="form-group">
          <label for="name">Username</label>
          <input type="text" class="form-control form-input-type-username" id="roll" name="roll" required value="Username" onFocus="this.value = '';" onBlur="if (this.value == '') {this.value = 'Username';}" pattern=".{5}" maxlength="5" onKeyUp="this.value=this.value.replace(/[^0-9]/g,'');" />
        </div>
        <div class="form-group">
          <label for="mob">Password</label>
          <input type="password" class="form-control form-input-type-username form-input-type-password" id="f_mobile" name="f_mobile" required value="Password" onFocus="this.value = '';" onBlur="if (this.value == '') {this.value = 'Username';}" />
        </div>
        <div class="form-group" align="center">
        	<input type="checkbox" id="remember" value="" class="checks">
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
		<p>© 2017 Student Progress Report. All Rights Reserved | Design by <a href="https://facebook.com/rajverma827/" target="_blank">Raj Verma</a></p>
	</div>
</div>
</body>
</html>