<?php
session_start();
ob_start();
//print_r($_SESSION);
	 $phpfiles=glob("include/php/*.php");
	 foreach($phpfiles as $phpfile){
	 	include_once($phpfile);
	 }
	if(isset($_POST['roll'])){
		$qry="select id,f_mobile from student_biodata where roll=$_POST[roll] and f_mobile=$_POST[fmobile]";
		//echo $qry;
		$success=1;
		if(fetchRow($qry)){
			$data=fetchOne($qry);
			if($_POST['n_pswd']==$_POST['c_pswd']){
				$npswd=md5($_POST['n_pswd']);
				$ndata=array('pswd'=>$npswd);
				addUpdate('student_biodata',$ndata,$data['id']);
			}else{
				$_SESSION['elogin']="Your new and confirm password doesn't match";
				$success=0;
			}
		}else{
		//echo "hi";exit;
			$_SESSION['elogin']="Your data is incorrect";
			//echo $_SESSION['elogin'];exit;
			$success=0;
		}
		if($success){
			//echo "hii";exit;
			$_SESSION['slogin']="Your password is successfully changed";
			?>
				<script>
					location.href="index.php";
				</script>
			<?php
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Profile Page | Synthesis</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="include/css/bootstrap.min.css" />
  <link rel="stylesheet" href="include/css/bootstrap-theme.min.css" />
  <link rel="stylesheet" href="include/css/style2.css" />

</head>
<body>
	<div class="container">
  <div class="row">
  	<div class="row" style="background:#F60; height:4px;">&nbsp;</div>
    <div class="col-lg-12" style="margin-top:6px;">
        <nav class="navbar navbar-default" style="background:none; border:none; box-shadow:none; font-family:'Century Gothic';">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="#"><img src="include/images/logo_synthesis.png" /></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="#">Change Password</span></a></li>
        <li class=""><a href="login.php">Back</span></a></li>
      </ul>
    </div>
  </div>
</nav>


</div>
      <div class="col-lg-12 text-center">
        <h6>&nbsp;</h6>
        <div class="col-md-12">
        <table class="table table-bordered">
            	<tr class="content_page_heading" align="justify">
                    <td style="background:#DA251D; color:#fff;">Welcome, Reset your password here </td>
                </tr>
         </table>








	<div class="col-lg-12" style="border-left:1px solid #CCC;">
	<?php if(isset($_SESSION['elogin'])){echo $_SESSION['elogin']; unset($_SESSION['elogin']);}?>
    <form role="form" class="form-horizontal" method="post" >
            	<div class="form-group">
                	<label class="col-lg-4 control-label">Roll No.</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="roll" name="roll" required onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" placeholder="Enter Roll No." maxlength="5">
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Father Mobile No.</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="roll" name="fmobile" required onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" placeholder="Enter your father mobile no." >
                    </div>
                </div>
                <!--
                <div class="form-group">
                	<label class="col-lg-4 control-label">Class</label>
                    <div class="col-lg-8">
                    <select class="form-control" id="cat" name="cat">
                        <option>Select Your Class</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                    </select>
                    </div>
                </div>
                -->
                <div class="form-group">
                	<label class="col-lg-4 control-label">New Password</label>
                    <div class="col-lg-8">
                    <input type="password" class="form-control" id="n_pswd" name="n_pswd" placeholder="Enter New Password">
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Confirm New Password</label>
                    <div class="col-lg-8">
                    <input type="password" class="form-control" id="n_pswd" name="c_pswd" placeholder="Confirm Enter New Password">
                    </div>
                </div>

                <div class="form-group">
                	<div class="col-lg-8 col-lg-offset-4">
                    <button type="submit" name="send" id="send" class="btn btn-danger btn-sm btn-block" style="font-family:'Century Gothic'; font-size:14px; font-weight:bold;">SUBMIT</button>
                    </div>
                </div>
            </form>
      </div>
<div class="col-lg-12" align="right">
    	<div class="row table_style2" style="color:#000;">
        <hr />
        <p>Copyright © 2017. All rights reserved. Design by Synthesis!</p>
        </div>
    </div>
    </div></div>      
</body></html>