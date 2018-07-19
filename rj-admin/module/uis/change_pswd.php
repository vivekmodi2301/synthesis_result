<?php
	if(isset($_POST['uname'])){
		extract($_POST);
		$pswd=md5($opswd);
		//echo "select id,uname,pswd from login_admin where uname='$uname' and pswd='$pswd'";
		$qry="select id,uname,pswd from login_admin where uname='$uname' and pswd='$pswd'";
		$data=fetchOne($qry);
		if ($data) {
			if($npswd==$cpswd){
				$npswd=md5($npswd);
				$sdata = array('pswd' => $npswd );
				addUpdate('login_admin',$sdata,1);
				$_SESSION['epswd']="Password change successfully";
			}else{
				$_SESSION['epswd']="New password and confirm password dose not match";
			}
		}else{
			$_SESSION['epswd']="Enter correct username and password";
		}
	}
 ?>
 <?php if(isset($_SESSION['epswd'])){echo $_SESSION['epswd'];unset($_SESSION['epswd']);}?>
	<div class="col-lg-12" style="border-left:1px solid #CCC;">
    <form role="form" class="form-horizontal" method="post" >
            	<div class="form-group">
                	<label class="col-lg-4 control-label">User Name</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="uname" name="uname" style="text-transform:capitalize;">
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Old Password</label>
                    <div class="col-lg-8">
                    <input type="password" class="form-control" id="pswd" name="opswd" style="text-transform:capitalize;">
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">New Password</label>
                    <div class="col-lg-8">
                    <input type="password" class="form-control" id="pswd" name="npswd" style="text-transform:capitalize;">
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Confirm New Password</label>
                    <div class="col-lg-8">
                    <input type="password" class="form-control" id="pswd" name="cpswd" style="text-transform:capitalize;">
                    </div>
                </div>

                <div class="form-group">
                	<div class="col-lg-8 col-lg-offset-4">
                    <button type="submit" name="send" id="send" class="btn btn-danger btn-sm btn-block" style="font-family:'Century Gothic'; font-size:14px; font-weight:bold;">SUBMIT</button>
                    </div>
                </div>
            </form>
      </div>
